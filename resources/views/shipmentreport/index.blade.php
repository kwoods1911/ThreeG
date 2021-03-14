@extends('layouts.app')

@section('content')



<h1>Shipment Reports</h1>

<a href="/home">Go Back</a>
<p>View Reports Created</p>

<a href="/shipmentreport/create" class="btn btn-primary">Create New Report</a>

    <table class=" table table-striped table-hover">
            <tr>
                <th>Report #</th>
                <th>Report Date</th>
                <th>Report Details</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
     @if(count($reports) > 0)

     @foreach($reports as $report)
                        <tr>
                            <td>{{$report->id}}</td>
                            <td>{{$report->date_of_report}}</td>
                            <td><a href="/shipmentreport/{{$report->id}}" class="btn btn-primary" >View Details</a></td>
                            {{-- <td><a href="/inventorymanagement/{{$package->id}}" class="btn btn-info">Details</a></td> --}}
                            <td><a href="/shipmentreport{{$report->id}}edit" class="btn btn-primary">Edit Report</a></td>
                             <td>
                                {!!Form::open(['action' => ['App\Http\Controllers\ShipmentReportController@destroy',$report->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                             </td>
                        </tr>
                        @endforeach

      @endif                  
</table>

@endsection

