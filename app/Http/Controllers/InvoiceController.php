<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivedPackages;
class InvoiceController extends Controller
{
    //KW - create routes to 
    public function createInvoice($id){
        //KW - function responsible for creating invoices
        $package = ReceivedPackages::find($id);
        return view('invoice.createinvoice')->with('package',$package);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
   {
    return "123";
   }


}
