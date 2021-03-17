<?php
/**
 * Student: Khari Woods
 * Course CIS2261
 * Date: March 19, 2020
 * Controller Description: This controller is reponsible for finding package data and passing that
 * information to a form to populate the form for an easier user experience.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivedPackages;
class InvoiceController extends Controller
{
    //KW - create routes to 
    public function createInvoice($id){
        //KW - function responsible for creating invoices
        $package = ReceivedPackages::find($id);
        if(auth()->user()->user_role == 'customer'){
            return redirect('/home');
        }else{
        return view('invoice.createinvoice')->with('package',$package);
        }
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
