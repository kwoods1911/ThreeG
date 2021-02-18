@extends('layouts.app')

@section('content')
<h1>Package Details</h1>

<p>Package Description: {{$customerPackages->packageDescription}}</p>

<p>Location Status:</p> <span>Pending shipment</span>
<p>Date of departure: N/A</p>
<p>Estimated Time of arrival: N/A</p>
<a href="/show-pdf/{{$customerPackages->id}}">View Invoice</a>
    <a href="/customerpackage" class="btn btn-default"> Go Back</a>
@endsection