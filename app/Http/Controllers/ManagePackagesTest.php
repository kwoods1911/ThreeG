<?php
/**
 * Student: Khari Woods
 * Course CIS2261
 * Date: March 19, 2020
 * Controller Description: 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPackage;

class ManagePackagesTest extends Controller
{
    public function create($id){
        $customerPackages = CustomerPackage::find($id);
        
        if(auth()->user()->user_role == 'customer'){
            return redirect('/home');
        }else{
        return view("managepackages.create")->with('customerpackage',$customerPackages);
        }
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
                
        return redirect('/managepackages/index');
    }
}
