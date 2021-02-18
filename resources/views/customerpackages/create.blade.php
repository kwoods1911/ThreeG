@extends('layouts.app')

@section('content')
<h1>Upload Package</h1>

{!! Form::open(['action' => 'App\Http\Controllers\CustomerPackagesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="form-group">
    {{Form::label('originaltrackingnumber', 'Tracking Number')}} <span>:</span>
    {{Form::text('originaltrackingnumber','',['class' => 'form-control', 'placeholder' => 'Tracking Number'])}}
</div>

<p>Write a brief description of the package. E.g Clothes, jordans</p>
<div class="form-group">
    {{Form::label('packagedescription', 'Package Description')}} <span>:</span>
    {{Form::text('packagedescription','',['class' => 'form-control', 'placeholder' => 'Package Description'])}}
</div>

<div class="form-group">
    {{Form::label('pickupordelivery', 'Pick Up Or Delivery')}} <span>:</span>
    {{Form::select('pickupordelivery', ['Pick Up' => 'Pick Up', 'Delivery' => 'Delivery'], 'pickup')}}
</div>

<div class="form-group">
    <p>Upload Invoice for your package:</p>
{{Form::file('customer_invoice')}}
</div>
{{Form::submit('Submit',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection