<?php
/**
 * Student: Khari Woods
 * Course CIS2261
 * Date: March 19, 2020
 * Controller Description: This controller is reponsible for managing the basic pages of the website.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//KW importing Models to be used
use App\Models\CustomerPackage;
use App\Models\ReceivedPackages;
use App\Models\ThreeG_Invoices;
use DB;


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

    public function viewbill($trackingnumber){
        //KW select $id where tracking number is equal to $id.
        // $invoice = DB::select("SELECT * FROM threeg_invoice WHERE packageid = $id");
        $invoiceID = DB::select("SELECT id FROM threeg_invoice WHERE  package_tracking_number = $trackingnumber");
        if($invoiceID == null){
            return view('customerpackages.invoicepending');
        }else{
            $invoice = ThreeG_Invoices::find($invoiceID[0]->id);
            return view('customerpackages.viewbill')->with('invoice',$invoice);
        }
        
        //KW find package invoice and redirect user to that page
        // return redirect("/invoicemanagement/{{$invoice->id}"); 
    }
}
