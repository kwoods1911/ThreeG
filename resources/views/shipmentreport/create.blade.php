@extends('layouts.app')

@section('content')

<h1>Create Report</h1>


<p>Create a report for all incomming packages</p>



{!! Form::open(['action' => 'App\Http\Controllers\ShipmentReportController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="form-group">
    {{Form::label('start_date', 'Start Date')}} <span>:</span>
    {{Form::date('start_date', \Carbon\Carbon::now())}}
</div>

<div class="form-group">
    {{Form::label('end_date', 'End Date')}} <span>:</span>
    {{Form::date('end_date', \Carbon\Carbon::now())}}
</div>
{{Form::submit('Create Report',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection

