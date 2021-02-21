@extends('layouts.app')

@section('content')

<h1>Inventory</h1>

<a href="#">View Incomming Packagesy</a>

<p>Show table of incomming packages.</p>

<form action="">
    <label for="">Search Original Tracking #:</label>
    <input type="text">
    <label for="">Search By Customer Name:</label>
    <input type="text">
    <input type="submit">
</form>
    <table class=" table table-striped table-hover">
            <tr>
                <th>Customer Id</th>
                <th>Origi Tracking #</th>
                <th>Three G - Tracking #</th>
                <th>Customer Name</th>
                <th>Package Description</th>
                <th>Receive Package</th>
                {{-- <th>Discard Package</th> --}}
            </tr>
            @if(count($customerPackages) > 0)

                    @foreach ($customerPackages as $customerPackage)
                        <tr>
                            <td>{{$customerPackage->customerid}}</td>
                            <td>{{$customerPackage->originaltrackingnumber}}</td>
                            <td>{{$customerPackage->newtrackingnumber}}</td>
                            <td>{{$customerPackage->customername}}</td>
                            <td>{{$customerPackage->packageDescription}}</td>
                            <td><a href="/managepackages/create/{{$customerPackage->id}}" class="btn btn-primary">Receive Package</a></td>
                            {{-- <td> --}}
                                {{-- {!!Form::open(['action' => ['App\Http\Controllers\ManagePackagesController@destroy', $customerPackage->id], 'method' => 'POST'])!!} --}}
                               {{-- {{Form::hidden('_method','DELETE')}} --}}
                               {{-- {{Form::submit('Discard',['class' => 'btn btn-danger'])}} --}}
                               {{-- {!!Form::close()!!} --}}
                            {{-- </td> --}}
                        </tr>
                    @endforeach
            
            @endIf
</table>

@endsection