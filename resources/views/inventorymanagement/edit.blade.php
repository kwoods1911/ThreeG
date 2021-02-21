@extends('layouts.app')
@section('content')
<h1>Prepare Shipment</h1>
<a href="/inventorymanagement">Go Back</a>

{!! Form::open(['action' => 'App\Http\Controllers\ManagePackagesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="form-group">
    {{Form::hidden('customerid',$package->id,['class' => 'form-control', 'placeholder' => 'Customer id'])}}
</div>
<h6>
    Three G Tracking # {{ $package->newtrackingnumberbarcode}}
</h6>

<h6>
    Original Tracking # {{$package->originaltrackingnumber}}
</h6>

<h6>Customer Name: {{$package->customername}}</h6>

<h6>Package Description: {{$package->packagedescription}}</h6>

<div class="form-group">
    {{Form::label('packageweight', 'Package Weight')}} <span>:</span>
    {{Form::number('packageweight',$package->package_weight,['class' => 'form-control', 'placeholder' => 0.00])}}
</div>

<div class="form-group">
    {{Form::label('locationstatus', 'Location Status of Package')}} <span>:</span>
    {{Form::select('locationstatus', ['Miami Warehouse' => 'Miami Warehouse', 'Nassau Warehouse' => 'Nassau Warehouse'], 'Miami Warehouse')}}
</div>

{{-- <div class="form-group">
    {{Form::label('deliverycustomercollection', 'Delivery Method')}} <span>:</span>
    {{Form::select('deliverycustomercollection', ['Pick Up' => 'Pick Up', 'Delivery' => 'Delivery'], $customerpackage->delivery_method)}}
</div> --}}

<div class="form-group">
    {{Form::label('dateofarrival', 'Date of arrival')}} <span>:</span>
    {{Form::date('dateofarrival', \Carbon\Carbon::now())}}
</div>

<div class="form-group">
    {{Form::label('dateofshipment', 'Date of shipment')}} <span>:</span>
    {{Form::date('dateofshipment', \Carbon\Carbon::now())}}
</div>
{{Form::submit('Receive Package',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection