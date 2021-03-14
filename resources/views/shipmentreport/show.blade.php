@extends('layouts.app')

@section('content')
<h1>Report Details</h1>

<h4>Report ID: {{$report_parameters->id}}</h4>
<h4>Manager Name: {{$report_parameters->managername}}</h4>

<table>
    <tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>originaltrackingnumber</th>
        <th>Package Description</th>
        <th>Package Weight</th>
        <th>Location Status</th>
        <th>Final Delivery Method</th>
        <th>New Tracking #</th>
        <th>Date Of Arrival</th>
        <th>Date of Departure</th>
    </tr>
@if (count($report_data) > 0)
    
@foreach ($report_data as $data)
<tr>
    <td>{{$data->customerid}}</td>
    <td>{{$data->customername}}</td>
    <td>{{$data->originaltrackingnumber}}</td>
    <td>{{$data->packagedescription}}</td>
    <td>{{$data->locationstatus}}</td>
</tr>
@endforeach

@endif
    
</table>

@endsection