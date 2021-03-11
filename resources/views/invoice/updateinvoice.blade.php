@extends('layouts.app');

@section('content')
    <h1>Update Invoice For Package</h1>

    <h3>Manager Name: {{$package->managername}} </h3>

    <p>
        Invoice: 
        {{-- {{$data['invoice']->item_value}} --}}

    </p>

 

{!! Form::open(['action' => 'App\Http\Controllers\ModifyInvoiceController@update', 'method' => 'POST']) !!}

<div class="form-group">
    {{Form::hidden('invoiceid',$invoice[0]->id,['class' => 'form-control', 'placeholder' => 'Customer id'])}}
</div>
<div class="form-group">
    {{Form::label('packageid', 'Package Id')}} <span>:</span>
    {{Form::text('packageid',$invoice[0]->packageid,['placeholder' => 'id'])}}
</div>

<div class="form-group">
    {{Form::label('itemvalue', 'Item Value')}} <span>:</span>
    {{Form::number('itemvalue',$invoice[0]->item_value,['placeholder' => 0.00])}}
</div>

<div class="form-group">
    {{Form::label('customdutyrate', 'Custom Duty Rate')}} <span>:</span>
    {{Form::number('customdutyrate',$invoice[0]->customs_tax_rate,['placeholder' => 0.00])}}
</div>

<div class="form-group">
    {{Form::label('itemcategory', 'Item Category')}} <span>:</span>
    {{Form::text('itemcategory',$invoice[0]->item_category,['placeholder' => 'e.g Electronics'])}}
</div>


<div class="form-group">
    {{Form::label('shippingrate', 'Shipping Rate')}} <span>:</span>
    {{Form::number('shippingrate',1.20,['placeholder' => 0.00])}}
</div>

<div class="form-group">
    {{Form::label('packageweight', 'Package Weight')}} <span>:</span>
    {{Form::number('packageweight',$invoice[0]->package_weight,['placeholder' => 0.00])}}<span>(LBS)</span>
</div>
{{Form::hidden('_method','PUT')}}
{{Form::submit('Update Invoice',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection