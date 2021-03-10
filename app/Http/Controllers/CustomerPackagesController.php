<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPackage;
use App\Models\User;
use App\Http\Controllers\UtilitiesController;
use DB;//KW importing DB class
class CustomerPackagesController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user_id = auth()->user()->id;//KW getting user ID
        $user = User::find($user_id);//Finding user object with specific id from Database
        return view('customerpackages.index')->with('customerPackages',$user->customerpackage);//passing in related packages from for customer to page for display.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customerpackages.create');
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
            'originaltrackingnumber' => 'required',
            'packagedescription' => 'required',
            'customer_invoice' => 'nullable|mimes:pdf,xlx,csv|max:2048',
            'pickupordelivery'=> 'required'
        ]);

        //KW checking if user has opted to upload file.

        if($request->hasFile('customer_invoice')){
            //get file name with extensions
            // $fileNameWithExt = $request->file('customer_invoice')->getCliendOriginalImage();
            // $filename = pathinfo($fileNameWithExt, PATHINFO_FILE);
            // //get extension
            // $extension = $request->file('customer_invoice')->getOriginalClientExtension();
            // //filename to store
            // $fileNameToStore = $filename .'_' .time().'.'.$extension;
            // $path = $request->file('customer_invoice') ->storeAs('public/customer_images', $fileNameToStore);
            $fileNameToStore =$request->input('packagedescription').''. time().'.'.$request->file('customer_invoice')->extension();  
            $request->file('customer_invoice')->move(public_path('public/customer_invoices'), $fileNameToStore);
        }else{
            $fileNameToStore = 'noinvoice.pdf';//KW - default pdf file.
        }
        $utility = new UtilitiesController;
        $customerPackages = new CustomerPackage;
        $users = User::find($customerPackages->id);


        //KW match user id with correct package
        // $findCustomerID = CustomerPackage::find($id);
        // $name = $users->getName();
        $customerPackages->user_id = auth()->user()->id;
        $customerPackages->customerid = '456';
        $customerPackages->customername = auth()->user()->name;
        $customerPackages->newtrackingnumber = $utility->generateTrackingNumber(7);
        $customerPackages->originaltrackingnumber = $request->input('originaltrackingnumber');
        $customerPackages->packagedescription = $request->input('packagedescription');
        $customerPackages->delivery_method = $request->input('pickupordelivery');
        $customerPackages->customer_invoice = $fileNameToStore;
        $customerPackages->save();
        
        return redirect('/customerpackage')->with('success','Package Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerPackages = CustomerPackage::find($id);
        return view('customerpackages.show')->with('customerPackages',$customerPackages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customerPackages = CustomerPackage::find($id);
        if(auth()->user()->id !== $customerPackages->user_id){
            return redirect('/customerpackage')->with('error','Unauthorized page.');
        }
        return view('customerpackages.edit')->with('customerPackages',$customerPackages);
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

        $customerPackages = CustomerPackage::find($id);

        //KW - adding logic to store information
        $this->validate($request,[
            'originaltrackingnumber' => 'required',
            'packagedescription' => 'required',
            'customer_invoice' => 'nullable|mimes:pdf,xlx,csv|max:2048',
            'pickupordelivery'=> 'required'
        ]);


        if($request->hasFile('customer_invoice')){
            $fileNameToStore =$request->input('packagedescription').''. time().'.'.$request->file('customer_invoice')->extension();  
            $request->file('customer_invoice')->move(public_path('public/customer_invoices'), $fileNameToStore);
        }else{
            $fileNameToStore = $customerPackages->customer_invoice;
        }
                

            //KW match user id with correct package
            // $name = $users->getName();
            $customerPackages->customerid = '456';//KW write script to generate customer ID.
            $customerPackages->customername = auth()->user()->name;
            $customerPackages->newtrackingnumber = $customerPackages->newtrackingnumber;
            $customerPackages->originaltrackingnumber = $request->input('originaltrackingnumber');
            $customerPackages->packagedescription = $request->input('packagedescription');
            $customerPackages->delivery_method = $request->input('pickupordelivery');
            $customerPackages->customer_invoice = $fileNameToStore;
            $customerPackages->save();
            
            return redirect('/customerpackage')->with('success','Package Details Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customerPackages = CustomerPackage::find($id);//KW - finding specific package  to be deleted.
        $customerPackages->delete();//KW - peforming delete function.
        if(auth()->user()->id !== $customerPackages->user_id){
            return redirect('/customerpackage')->with('error','Unauthorized page.');
        }
        return redirect('/customerpackage')->with('success','Package Deleted !');
    }


 
    }

