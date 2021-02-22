<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivedPackages;
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
        return view('inventorymanagement.index')->with('inventorypackages',$inventorypackages);
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
        $package = ReceivedPackages::find($id);
        return view("inventorymanagement.show")->with('package',$package);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = ReceivedPackages::find($id);
        return view('inventorymanagement.edit')->with('package',$package);
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
        $package = ReceivedPackages::find($id);

        $this->validate($request,[
            'packageweight' => 'required',
            'locationstatus'=> 'required',
            'packagedescription' => 'required',
            'dateofarrival' => 'required',
            'dateofshipment' => 'required'
        ]);

        $package->package_weight = $request->input('packageweight');
        $package->packagedescription = $request->input('packagedescription');
        $package->locationstatus = $request->input('locationstatus');
        $package->dateofarrival = $request->input('dateofarrival');
        $package->dateofdeparture = $request->input('dateofshipment');
        $package->save();

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
        //
    }
}
