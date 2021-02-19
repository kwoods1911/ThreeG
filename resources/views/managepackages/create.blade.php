@extends('layouts.app')

@section('content')
<h1>Receive Package</h1>
<a href="/managepackages">Go Back</a>

{!! Form::open(['action' => 'App\Http\Controllers\ManagePackagesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="form-group">
    {{Form::label('originaltrackingnumber', 'Tracking Number')}} <span>:</span>
    {{Form::text('originaltrackingnumber',$customerpackage->originaltrackingnumber,['class' => 'form-control', 'placeholder' => 'Tracking Number'])}}
</div>

<div class="form-group">
    {{Form::label('customername', 'Customer Name')}} <span>:</span>
    {{Form::text('customername',$customerpackage->customername,['class' => 'form-control', 'placeholder' => 'John Doe'])}}
</div>

<p>Write a brief description of the package. E.g Clothes, jordans</p>
<div class="form-group">
    {{Form::label('packagedescription', 'Package Description')}} <span>:</span>
    {{Form::text('packagedescription',$customerpackage->packageDescription,['class' => 'form-control', 'placeholder' => 'Package Description'])}}
</div>

<div class="form-group">
    {{Form::label('packageweight', 'Package Weight')}} <span>:</span>
    {{Form::number('packageweight','',['class' => 'form-control', 'placeholder' => '0.00'])}}
</div>

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