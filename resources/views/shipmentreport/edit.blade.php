@extends('layouts.app')

@section('content')

<h1>Edit Report</h1>
<p>Note: Reports are edited based on a date range for all incomming packages.</p>



{!! Form::open(['action' => ['App\Http\Controllers\ShipmentReportController@update',$report_parameters->id], 'method' => 'POST']) !!}
<div class="form-group">
    {{Form::label('start_date', 'Start Date')}} <span>:</span>
    {{Form::date('start_date', \Carbon\Carbon::now())}}
</div>

<div class="form-group">
    {{Form::label('end_date', 'End Date')}} <span>:</span>
    {{Form::date('end_date', \Carbon\Carbon::now())}}
</div>
{{Form::hidden('_method','PUT')}}
{{Form::submit('Create Report',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection

