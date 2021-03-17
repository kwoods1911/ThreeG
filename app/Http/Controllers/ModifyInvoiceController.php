<?php
/**
 * Student: Khari Woods
 * Course CIS2261
 * Date: March 19, 2020
 * Controller Description: This controller is responsible for modifying the invoice.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivedPackages;
use App\Models\ThreeG_Invoices;
use DB;

class ModifyInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $package = ReceivedPackages::all();
        if(auth()->user()->user_role == 'customer'){
            return redirect('/home');
        }else{
        return view('invoice.createinvoice');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        //KW - adding logic to store information
        $this->validate($request,[
            'packageid' => 'required',
            'itemvalue' => 'required',
            'customdutyrate' => 'required',
            'itemcategory' => 'required',
            'shippingrate'=> 'required',
            'packageweight' => 'required',
            'itemvalue' => 'required'
        ]);

            define("VAT_TAX_RATE",0.012); 
            define("PROCESSING_FEE",10);

        $invoice = new ThreeG_Invoices;
        $customerPackage = ReceivedPackages::find($request->input('packageid'));

        //KW capture user inputs in variables
        $itemValue = $request->input('itemvalue');
        $shippingRate = $request->input('shippingrate');
        $customDutyRate = $request->input('customdutyrate');
        $shippingRate = $request->input('shippingrate');
        $packageWeight = $request->input('packageweight');
        
        //KW declare variables that need to be calculated.
        $shippingCost = $packageWeight * $shippingRate;
        $shippingCostVAT = $shippingCost * VAT_TAX_RATE;
        $shippingCostFinal = $shippingCost + $shippingCostVAT;

        //KW calculate customs_rate
        $customTaxAmount = $itemValue * ($customDutyRate/100);
        $customTaxAmountVat = $customTaxAmount * VAT_TAX_RATE;
        $customTaxFinal = $customTaxAmount + $customTaxAmountVat;

        $processingFee = PROCESSING_FEE;
        $processingFeeVat = PROCESSING_FEE * VAT_TAX_RATE;
        $processingFeeVatTotal = $processingFee + $processingFeeVat;

        $subTotal = $shippingCost + $customTaxAmount + $processingFee;
        $subTotalVat = $shippingCostVAT + $customTaxAmountVat + $processingFeeVat;
        $finalTotal = $shippingCostFinal + $customTaxFinal + $processingFeeVatTotal;


        $invoice->packageid = $request->input('packageid');
        $invoice->managerid = $customerPackage->managerid;
        $invoice->manager_name = $customerPackage->managername;
        $invoice->package_description = $customerPackage->packagedescription;
        $invoice->customer_id = $customerPackage->customerid;
        $invoice->customer_name = $customerPackage->customername;
        $invoice->package_tracking_number = $customerPackage->newtrackingnumberbarcode;

        $invoice->package_description = $customerPackage->packagedescription;
        $invoice->package_weight = $packageWeight;

        $invoice->item_category = $request->input('itemcategory');
        $invoice->shipping_cost = $shippingCost;
        $invoice->shipping_cost_vat = $shippingCostVAT;
        $invoice->shipping_cost_total = $shippingCostFinal;

        $invoice->item_value = $request->input('itemvalue');
        $invoice->customs_rate = $customDutyRate;
        $invoice->customs_tax_amount = $customTaxAmount;
        $invoice->customs_tax_amount_vat = $customTaxAmountVat;
        $invoice->customs_tax_total = $customTaxFinal;
        
        $invoice->processing_fee = $processingFee;
        $invoice->processing_fee_vat = $processingFeeVat;
        $invoice->processing_fee_total = $processingFeeVatTotal;

        $invoice->subtotal = $subTotal;
        $invoice->subtotal_vat = $subTotalVat;
        $invoice->final_total = $finalTotal;
        $invoice->save();
        return redirect('/inventorymanagement')->with('success',"Invoice Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $package = ReceivedPackages::find($id);
        //find invoice number
        // return view('invoice.showinvoice')->with('package',$package);

        $package = ReceivedPackages::find($id);
        $invoice = ThreeG_Invoices::where('packageid',$package->id)->firstOrFail();

        if(auth()->user()->user_role == 'customer'){
            return redirect('/home');
        }else{
            return view('invoice.showinvoice')->with('invoice',$invoice);
        }

        // return view('invoice.showinvoice');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //KW run query on threeg_invoice database to find invoice number that corresponds to package number
        // $invoice = ThreeG_Invoices::find($id);
        $invoice = DB::select("SELECT * FROM threeg_invoice WHERE packageid = $id");
        // fetch_assoc
        $package = ReceivedPackages::find($id);

        if(auth()->user()->user_role == 'customer'){
            return redirect('/home');
        }else{
            return view('invoice.updateinvoice')->with('invoice',$invoice)->with('package',$package);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //KW - adding logic to update information
        $this->validate($request,[
            'packageid' => 'required',
            'itemvalue' => 'required',
            'customdutyrate' => 'required',
            'itemcategory' => 'required',
            'shippingrate'=> 'required',
            'packageweight' => 'required',
            'itemvalue' => 'required'
        ]);

        define("VAT_TAX_RATE",0.012); 
        define("PROCESSING_FEE",10);

        $invoice = ThreeG_Invoices::find($id);
        $customerPackage = ReceivedPackages::find($request->input('packageid'));
        //KW capture user inputs in variables

        //KW capture user inputs in variables
        $itemValue = $request->input('itemvalue');
        $shippingRate = $request->input('shippingrate');
        $customDutyRate = $request->input('customdutyrate');
        $shippingRate = $request->input('shippingrate');
        $packageWeight = $request->input('packageweight');
        
        //KW declare variables that need to be calculated.
        $shippingCost = $packageWeight * $shippingRate;
        $shippingCostVAT = $shippingCost * VAT_TAX_RATE;
        $shippingCostFinal = $shippingCost + $shippingCostVAT;

        //KW calculate customs_rate
        $customTaxAmount = $itemValue * ($customDutyRate/100);
        $customTaxAmountVat = $customTaxAmount * VAT_TAX_RATE;
        $customTaxFinal = $customTaxAmount + $customTaxAmountVat;

        $processingFee = PROCESSING_FEE;
        $processingFeeVat = PROCESSING_FEE * VAT_TAX_RATE;
        $processingFeeVatTotal = $processingFee + $processingFeeVat;

        $subTotal = $shippingCost + $customTaxAmount + $processingFee;
        $subTotalVat = $shippingCostVAT + $customTaxAmountVat + $processingFeeVat;
        $finalTotal = $shippingCostFinal + $customTaxFinal + $processingFeeVatTotal;

        $invoice->packageid = $request->input('packageid');
        $invoice->managerid = $customerPackage->managerid;
        $invoice->manager_name = $customerPackage->managername;
        $invoice->package_description = $customerPackage->packagedescription;
        $invoice->customer_id = $customerPackage->customerid;
        $invoice->customer_name = $customerPackage->customername;
        $invoice->package_tracking_number = $customerPackage->newtrackingnumberbarcode;

        $invoice->package_description = $customerPackage->packagedescription;
        $invoice->package_weight = $packageWeight;

        $invoice->item_category = $request->input('itemcategory');
        $invoice->shipping_cost = $shippingCost;
        $invoice->shipping_cost_vat = $shippingCostVAT;
        $invoice->shipping_cost_total = $shippingCostFinal;

        $invoice->item_value = $request->input('itemvalue');
        $invoice->customs_rate = $customDutyRate;
        $invoice->customs_tax_amount = $customTaxAmount;
        $invoice->customs_tax_amount_vat = $customTaxAmountVat;
        $invoice->customs_tax_total = $customTaxFinal;
        
        $invoice->processing_fee = $processingFee;
        $invoice->processing_fee_vat = $processingFeeVat;
        $invoice->processing_fee_total = $processingFeeVatTotal;

        $invoice->subtotal = $subTotal;
        $invoice->subtotal_vat = $subTotalVat;
        $invoice->final_total = $finalTotal;
        $invoice->save();
        return redirect('/inventorymanagement')->with('success','Invoice Updated !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //KW find invoice number
        $invoice = ThreeG_Invoices::find($id);
        $invoice->delete();
        return redirect("/inventorymanagement")->with('success','Invoice Deleted!');
    }
}
