@extends('layouts.app')

@section('content')
<h1>Package Details</h1>

<p>Package Description: {{$customerPackages->packageDescription}}</p>
@php
//KW handling errors if package has not been received by manager variables will be displayed below.
$locationStatus = 'Awaiting Arrival in Miami';
$dateOfArrival ='N/A';
$dateOfDeparture = 'N/A';
 if($packageInformation == null){

 }else{
     //KW package has been received dynamic information about package will be displayed.
    $locationStatus = $packageInformation[0]->locationstatus;
    $dateOfArrival = $packageInformation[0]->dateofarrival;
    $dateOfDeparture = $packageInformation[0]->dateofdeparture;
 }
@endphp
<p>Location Status:{{$locationStatus}}</p> 
<p>Date of departure: {{$dateOfArrival}}</p>
<p>Estimated Time of arrival: {{$dateOfDeparture}}</p>
<a href="/show-pdf/{{$customerPackages->id}}">View Invoice</a>
    <a href="/customerpackage" class="btn btn-primary"> Go Back</a>
@endsection