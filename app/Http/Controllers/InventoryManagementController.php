<?php

/**
 * Student: Khari Woods
 * Course CIS2261
 * Date: March 19, 2020
 * Controller Description: This controller is reponsible for managing the inventory of the warehouse.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivedPackages;
use App\Models\ThreeG_Invoices;
class InventoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //KW - Pull all packages from received packages database.
        $inventorypackages = ReceivedPackages::all();
        if(auth()->user()->user_role == 'customer'){
            return redirect('/home');
        }else{
            return view('inventorymanagement.index')->with('inventorypackages',$inventorypackages);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //KW find packaged based on ID passed in through the parameter
        $package = ReceivedPackages::find($id);
        if(auth()->user()->user_role == 'customer'){
            return redirect('/home');
        }else{
        return view("inventorymanagement.show")->with('package',$package);//KW passing package into the page as a variable
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //KW find packaged based on ID passed in through the parameter
        $package = ReceivedPackages::find($id);
        if(auth()->user()->user_role == 'customer'){
            return redirect('/home');
        }else{
            return view('inventorymanagement.edit')->with('package',$package);//KW passing package into the page as a variable
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
        //KW quering database for specific package to be updated.
        $package = ReceivedPackages::find($id);
        $this->validate($request,[
            'packageweight' => 'required',
            'locationstatus'=> 'required',
            'dateofarrival' => 'required',
            'dateofshipment' => 'required'
        ]);

        //KW updating package based on user inputs.
        $package->package_weight = $request->input('packageweight');
        $package->locationstatus = $request->input('locationstatus');
        $package->dateofarrival = $request->input('dateofarrival');
        $package->dateofdeparture = $request->input('dateofshipment');
        $package->save();//KW saving updates to database
        return redirect('/inventorymanagement')->with('success','Package Details Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //KW - on button click delete current item in inventory and also delete its corresponding invoices.
        $package = ReceivedPackages::find($id);
        $package->delete();//KW deleting record from database
        return redirect("/inventorymanagement")->with('success','Package Deleted!');//KW sending confirmation message to page.

    }
}
