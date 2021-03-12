<?php

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
        return view('invoice.createinvoice');
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

        $customerPackage = ReceivedPackages::find($request->input('packageid'));

        //KW capture user inputs in variables
        $itemValue = $request->input('itemvalue');
        $shippingRate = $request->input('shippingrate');
        $customDutyRate = $request->input('customdutyrate');
        $shippingRate = $request->input('shippingrate');
        $packageWeight = $request->input('packageweight');
        
        $vatTax = $itemValue * 0.12;
        $customsTax = $itemValue * $customDutyRate;
        $shippingCost = ($itemValue * $shippingRate);
        $customsVAT = $customsTax * 0.12;
        
        $processingFee = 10;//KW constant
        $totalCost = $shippingCost + $customsTax + $customsVAT + $processingFee;    

        // $invoice = ThreeG_Invoices::find($request->input('invoiceid'));
        $invoice = new ThreeG_Invoices;
        $invoice->packageid = $request->input('packageid');
        $invoice->managerid = $customerPackage->managerid;
        $invoice->package_description = $customerPackage->packagedescription;
        $invoice->customer_name = $customerPackage->customername;
        $invoice->package_tracking_number = $customerPackage->newtrackingnumberbarcode;
        $invoice->shipping_cost = $shippingCost;
        $invoice->item_value = $request->input('itemvalue');
        $invoice->item_category = $request->input('itemcategory');
        $invoice->vat_tax = $vatTax;
        $invoice->customs_tax = $customsTax;
        $invoice->customs_vat = $customsVAT;
        $invoice->customs_tax_rate = $customDutyRate;
        $invoice->total_cost = $totalCost;
        $invoice->package_weight = $packageWeight;
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
        return view('invoice.showinvoice')->with('invoice',$invoice);

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
        return view('invoice.updateinvoice')->with('invoice',$invoice)->with('package',$package);
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

        $invoice = ThreeG_Invoices::find($id);
        $customerPackage = ReceivedPackages::find($request->input('packageid'));
        //KW capture user inputs in variables
        $itemValue = $request->input('itemvalue');
        $shippingRate = $request->input('shippingrate');
        $customDutyRate = $request->input('customdutyrate');
        $shippingRate = $request->input('shippingrate');
        $packageWeight = $request->input('packageweight');
        
        $vatTax = $itemValue * 0.12;
        $customsTax = $itemValue * $customDutyRate;
        $shippingCost = ($itemValue * $shippingRate);
        $customsVAT = $customsTax * 0.12;
        
        $processingFee = 10;//KW constant
        $totalCost = $shippingCost + $customsTax + $customsVAT + $processingFee;    
       
        $invoice->packageid = $request->input('packageid');
        $invoice->managerid = $customerPackage->managerid;
        $invoice->package_description = $customerPackage->packagedescription;
        $invoice->customer_name = $customerPackage->customername;
        $invoice->package_tracking_number = $customerPackage->newtrackingnumberbarcode;
        $invoice->shipping_cost = $shippingCost;
        $invoice->item_value = $request->input('itemvalue');
        $invoice->vat_tax = $vatTax;
        $invoice->customs_tax = $customsTax;
        $invoice->customs_vat = $customsVAT;
        $invoice->customs_tax_rate = $customDutyRate;
        $invoice->package_weight = $packageWeight;
        $invoice->total_cost = $totalCost;
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
