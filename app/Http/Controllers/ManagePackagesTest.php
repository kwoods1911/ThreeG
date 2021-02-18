<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPackage;

class ManagePackagesTest extends Controller
{
    public function create($id){
        $customerPackages = CustomerPackage::find($id);
        return view("managepackages.create")->with('customerpackage',$customerPackages);
    }
}
