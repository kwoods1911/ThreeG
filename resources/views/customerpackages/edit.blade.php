{{-- @extends('layouts.app')

@section('content')
<h1>Edit Package Information</h1>

{!! Form::open(['action' => ['App\Http\Controllers\CustomerPackagesController@update',$customerPackages->id], 'method' => 'POST']) !!}
<div class="form-group">
    {{Form::label('originaltrackingnumber', 'Tracking Number')}} <span>:</span>
    {{Form::text('originaltrackingnumber',$customerPackages->originaltrackingnumber,['class' => 'form-control', 'placeholder' => 'Tracking Number'])}}
</div>

<p>Write a brief description of the package.</p>
<div class="form-group">
    {{Form::label('packagedescription', 'Package Description')}} <span>:</span>
    {{Form::text('packagedescription',$customerPackages->packageDescription,['class' => 'form-control', 'placeholder' => 'Package Description'])}}
</div>


<div class="form-group">
    {{Form::label('pickupordelivery', 'Pick Up Or Delivery')}} <span>:</span>
    {{Form::select('pickupordelivery', ['Pick Up' => 'Pick Up', 'Delivery' => 'Delivery'], 'pickup')}}
</div>

<div class="form-group">
    <p>Upload Invoice for your package:</p> --}}
     
{{-- {{Form::file('customer_invoice')}} --}}
{{-- </div> --}}
{{-- PUT method is overriding the POST method for updating package details --}}
{{Form::hidden('_method','PUT')}}

{{-- {{Form::submit('Submit',['class' => 'btn btn-primary'])}} --}}
{{-- {!! Form::close() !!} --}}
@endsection