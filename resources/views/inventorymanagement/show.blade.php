@extends('layouts.app')

@section('content')

@php
//KW run query to find corresponding customer id to package it.
use App\Models\CustomerPackage;
use Illuminate\Support\Facades\DB;
$trackingNumber = $package->newtrackingnumberbarcode;
$customerPackageNumber = DB::select("SELECT id FROM customer_packages WHERE newtrackingnumber = $trackingNumber");
//KW select customer package from
    
@endphp



<h1>Shipment Details</h1>

<h4>Manager ID: {{$package->managerid}}</h4>
<h4>Manager Name: {{$package->managername}}</h4>



<table class="table">
    <tr>
        <th>Package ID</th>
        <td>{{$package->id}}</td>
    </tr>
    <tr>
        <th>Customer Name:</th>
        <td>{{$package->customername}}</td>
    </tr>

    <tr>
        <th>Tracking #</th>
        <td>{{$package->newtrackingnumberbarcode}}</td>
    </tr>

    <tr>
        <th>Package Description</th>
        <td>{{$package->packagedescription}}</td>
    </tr>

    <tr>
        <th>Package Weight</th>
        <td>{{$package->package_weight}} lbs</td>
    </tr>

    <tr>
        <th>Date Of Arrival</th>
        <td>{{$package->dateofarrival}}</td>
    </tr>

    <tr>
        <th>Date of Shipment</th>
        <td>{{$package->dateofdeparture}}</td>
    </tr>

    <tr>
        <th>Delivery Method</th>
        <td>{{$package->deliverycustomercollection}}</td>
    </tr>

    <tr>
        <th>Package Invoice</th>
        <td>
            <a target="_blank" href="/show-pdf/{{$customerPackageNumber[0]->id}}" class="btn btn-primary" >View Invoice</a>
        </td>
       
    </tr>

</table>


<h1>Manage Invoice</h1>
<table>
    <tr>
        <th>View Invoice</th>
        <th>Create Invoice</th>
        <th>Update Invoice</th>
    </tr>

    <tr>
        <td><a href="/invoicemanagement/{{$package->id}}" class="btn btn-primary">View Invoice</a></td>
        <td><a href="/invoicemanagement/createinvoice/{{$package->id}}" class="btn btn-primary">Create Invoice</a></td>
        <td><a href="/invoicemanagement/{{$package->id}}/edit" class="btn btn-primary">Update Invoice</a></td>
    </tr>
    
</table>

@endsection