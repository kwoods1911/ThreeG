@extends('layouts.app')

@section('content')
<h1>Report Details</h1>

<h4>Report ID: {{$report_parameters->id}}</h4>
<h4>Manager Name: {{$report_parameters->managername}}</h4>

<h6>Report Date:</h6>
<p>Start Date: {{$report_parameters->start_date}}</p>
<p>End Date: {{$report_parameters->end_date}}</p>

<table class=" table table-striped table-hover">
    <tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Original Tracking Number</th>
        <th>Package Description</th>
        <th>Package Weight</th>
        <th>Location Status</th>
        <th>Final Delivery Method</th>
        <th>New Tracking #</th>
        <th>Date Of Arrival</th>
        <th>Date of Departure</th>
        <th>Shipment Cost</th>
    </tr>
@if (count($report_data) > 0)
    
@foreach ($report_data as $data)
<tr>
    <td>{{$data->customerid}}</td>
    <td>{{$data->customername}}</td>
    <td>{{$data->originaltrackingnumber}}</td>
    <td>{{$data->packagedescription}}</td>
    <td>{{$data->package_weight}}</td>
    <td>{{$data->locationstatus}}</td>
    <td>{{$data->deliverycustomercollection}}</td>
    <td>{{$data->newtrackingnumberbarcode/* new tracking number*/}}</td>
    <td>{{$data->dateofarrival/* Date of Arrival*/}}</td>
    <td>{{$data->dateofdeparture/* Date of Departure*/}}</td>
    <td>{{$data->final_total/* Shipment Cost*/}}</td>
</tr>
@endforeach

@endif
    
</table>

@endsection