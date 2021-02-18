<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPackage;
use App\Http\Controllers\CustomerPackagesController;
class PagesController extends Controller
{
    //KW - this controller is resonsible for assigning views to the basic pages in the application.

    public function index(){
        $title = "Welcome to Three G Shipping";//KW title variable to be displayed on index page
        return view('pages.index')->with('title', $title);//KW -passing in title parameters to index page.
    }

    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        $data = array(
            'title' => "Three G's Services",
            'services' => ['Package Tracking', 'Low Cost Shipping From Miami To Nassau','On time delivery']
        );
        return view('pages.services')->with($data);//KW passing in an array of data to services page.
    }

    public function viewpdf($id){
        $file = CustomerPackage::find($id);
        // return view('pages.about')->with('title', $file->customer_invoice);
        return response()->file('public\customer_invoices\\'.$file->customer_invoice);
    }
}
