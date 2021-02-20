<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivedPackages;
use App\Models\CustomerPackage;

class ManagePackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * This controller is responsible for viewing the packages that the customer has uploaded.
     * Those packages need to be recorded as "Received" and stored in a another.
     * 
     */
    public function index()
    {
        //KW- import all records from customer_packages database.
        //KW send records to managepackages.index
        $customerPackages = CustomerPackage::all();
        return view('managepackages.index')->with('customerPackages',$customerPackages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //KW - invoke this function to create a record that the package has been received.
        //KW populate form with trackining number data.
        //KW store record of package in database.
        $customerPackages = CustomerPackage::all();
        return view('managepackages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'customerid' => 'required',
            'originaltrackingnumber' => 'required',
            'customername' => 'required',
            'packagedescription' => 'required',
            'packageweight' => 'required',
            'locationstatus' => 'required',
            'dateofarrival' => 'required',
            'dateofshipment' => 'required',
            'customer_invoice' => 'nullable|mimes:pdf,xlx,csv|max:2048',
        ]);

        if($request->hasFile('customer_invoice')){
            $fileNameToStore =$request->input('packagedescription').''. time().'.'.$request->file('customer_invoice')->extension();  
            $request->file('customer_invoice')->move(public_path('public/customer_invoices'), $fileNameToStore);
        }else{
            $fileNameToStore = 'noinvoice.pdf';//KW - default pdf file.
        }

        $package = new ReceivedPackages;
        $package->managerid = auth()->user()->id;
        $package->managername = auth()->user()->name;
        $package->newtrackingnumberbarcode = $request->input('originaltrackingnumber');
        $package->customerid = $request->input('customerid');
        $package->customername = $request->input('customername');
        $package->packagedescription = $request->input('packagedescription');
        $package->dateofarrival = $request->input('dateofarrival');
        $package->dateofdeparture = $request->input('dateofshipment');
        $package->locationstatus = $request->input('locationstatus');
        $package->originaltrackingnumber = $request->input('originaltrackingnumber');
        $package->deliverycustomercollection = $request->input('deliverycustomercollection');
        $package->customer_invoice = $fileNameToStore;

        $package->save();
        
        

        return redirect('/managepackages')->with('success', 'Package Record Created.');

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
