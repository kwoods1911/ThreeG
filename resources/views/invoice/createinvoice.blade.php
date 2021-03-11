@extends('layouts.app');

@section('content')
    <h1>Create Invoice For Package</h1>

    <h3>Manager Name: {{$package->managername}} </h3>

{!! Form::open(['action' => 'App\Http\Controllers\ModifyInvoiceController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

<div class="form-group">
    {{Form::label('packageid', 'Package Id')}} <span>:</span>
    {{Form::text('packageid',$package->id,['placeholder' => 'id'])}}
</div>

<div class="form-group">
    {{Form::label('itemvalue', 'Item Value')}} <span>:</span>
    {{Form::number('itemvalue',0,['placeholder' => 0.00])}}
</div>

<div class="form-group">
    {{Form::label('customdutyrate', 'Custom Duty Rate')}} <span>:</span>
    {{Form::number('customdutyrate','',['placeholder' => 0.00])}}
</div>

<div class="form-group">
    {{Form::label('itemcategory', 'Item Category')}} <span>:</span>
    {{Form::text('itemcategory','',['placeholder' => 'e.g Electronics'])}}
</div>


<div class="form-group">
    {{Form::label('shippingrate', 'Shipping Rate')}} <span>:</span>
    {{Form::number('shippingrate',1.20,['placeholder' => 0.00])}}
</div>

<div class="form-group">
    {{Form::label('packageweight', 'Package Weight')}} <span>:</span>
    {{Form::number('packageweight',$package->package_weight,['placeholder' => 0.00])}}<span>(LBS)</span>
</div>

{{Form::submit('Calculate',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection