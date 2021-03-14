<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivedPackages;
use App\Models\CustomerPackage;
use DB;//KW - importing database class.


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
     * Basically this controller manages all incomming packages.
     * 
     */
    public function index()
    {
        //KW- import all records from customer_packages database.
        //KW send records to managepackages.index
        $customerPackages = CustomerPackage::all();
        //KW run a comparison to what exist already in the packages database.
        //KW if the package already exists then filter it out from the results.

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
        //KW validating user input fields.
        $this->validate($request,[
            'customerid' => 'required',
            'originaltrackingnumber' => 'required',
            'customername' => 'required',
            'packagedescription' => 'required',
            'packageweight' => 'required',
            'locationstatus' => 'required',
            'dateofarrival' => 'required',
            'dateofshipment' => 'required',
        ]);

        $package = new ReceivedPackages; 
        $package->managerid = auth()->user()->id;
        $package->managername = auth()->user()->name;
        $package->newtrackingnumberbarcode = $request->input('newtrackingnumber');
        $package->customerid = $request->input('customerid');
        $package->customername = $request->input('customername');
        $package->packagedescription = $request->input('packagedescription');
        $package->dateofarrival = $request->input('dateofarrival');
        $package->dateofdeparture = $request->input('dateofshipment');
        $package->locationstatus = $request->input('locationstatus');
        $package->originaltrackingnumber = $request->input('originaltrackingnumber');
        $package->package_weight = $request->input('packageweight');

        $customerPackageId = $request->input('customer_package_id');//KW unique Identifier used to run query in customerpackage table.
        //KW running a query to pull additional package information from database.
        $customerPackageDBInfo = DB::select("SELECT * FROM customer_packages WHERE id = $customerPackageId");
        //KW convert database information to sring
        foreach ($customerPackageDBInfo as $packageInfo){
            $invoice_result = $packageInfo->customer_invoice;
            $customerselection_pickup_delivery = $packageInfo->delivery_method;
        }
        $package->deliverycustomercollection = $customerselection_pickup_delivery;
        $package->customer_invoice = $invoice_result;
        $package->save();//KW saving information to packages database.
        
        return redirect('/managepackages')->with('success', "Package successfully received !");

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
