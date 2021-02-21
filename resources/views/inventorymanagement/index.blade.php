@extends('layouts.app')

@section('content')



<h1>Inventory</h1>

<a href="/home">Go Back</a>
<p>Packages in inventory.</p>


<form action="">
    <label for="">Search Original Tracking #:</label>
    <input type="text">
    <label for="">Search By Customer Name:</label>
    <input type="text">
    <input type="submit">
</form>
    <table class=" table table-striped table-hover">
            <tr>
                
                <th>Origi Tracking #</th>
                <th>Three G - Tracking #</th>
                <th>Customer Id</th>
                <th>Customer Name</th>
                <th>Package Description</th>
                <th>Package Details</th>
                {{-- <th>Customer Invoice</th> --}}
                <th>Prepare Shipment</th>
            </tr>
            @if(count($inventorypackages) > 0)
                    @foreach ($inventorypackages as $package)
                        <tr>
                            <td>{{$package->originaltrackingnumber}}</td>
                            <td>{{$package->newtrackingnumberbarcode}}</td>
                            <td>{{$package->customerid}}</td>
                            <td>{{$package->customername}}</td>
                            <td>{{$package->packagedescription}}</td>
                            <td><a href="#" class="btn btn-info">Details</a></td>
                            {{-- <td><a href="#" class="btn btn-primary">Invoice</a></td> --}}
                            <td><a href="/inventorymanagement/{{$package->id}}/edit" class="btn btn-primary">Prep. Ship.</a></td>
                            <td></td> 
                        </tr>
                    @endforeach
            
            @endIf

            {{-- {!!Form::open(['action' => ['App\Http\Controllers\ManagePackagesController@destroy', $package->id], 'method' => 'POST'])!!} --}}
            {{-- {{Form::hidden('_method','DELETE')}} --}}
            {{-- {{Form::submit('Discard',['class' => 'btn btn-danger'])}} --}}
            {{-- {!!Form::close()!!} --}}
</table>

@endsection