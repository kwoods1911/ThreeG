@extends('layouts.app')

@section('content')
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
        <th>View Final Invoice</th>
        <td><a href="/invoicemanagement/{{$package->id}}" class="btn btn-primary">View Invoice</a></td>
    </tr>
</table>


@endsection