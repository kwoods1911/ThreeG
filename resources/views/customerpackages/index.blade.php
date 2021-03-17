@extends('layouts.app')

@section('content')


    <h1>My Packages</h1>



    @if(count($customerPackages)>0)
    <a href="/customerpackage/create" class="btn btn-primary">Add Package</a>
    <br>
        <table class=" table table-striped table-hover">
            <tr>
                {{-- <th>Customer Id</th> --}}
                <th>Three G - Tracking Number</th>
                <th>Package Description</th>
                <th>Final Bill</th>
                <th>Details</th>
                {{-- <th>Edit</th> --}}
                <th>Delete</th>
            </tr>
@foreach ($customerPackages as $customerPackage)
<tr>
    {{-- <td>{{$customerPackage->customerid}}</td> --}}
    <td>{{$customerPackage->newtrackingnumber}}</td>
    <td>{{$customerPackage->packageDescription}}</td>
    <td>
        <a href="/show-bill/{{$customerPackage->newtrackingnumber}}" class="btn btn-primary">
        View Bill
    </a>
    </td>
    <td><a href="/customerpackage/{{$customerPackage->id}}" class="btn btn-primary">
        View Details</a>
    </td>
    {{-- <td><a href="/customerpackage/{{$customerPackage->id}}/edit" class="btn btn-primary">Edit</a></td> --}}
    <td>
        {!!Form::open(['action' => ['App\Http\Controllers\CustomerPackagesController@destroy', $customerPackage->id], 'method' => 'POST'])!!}
       {{Form::hidden('_method','DELETE')}}
       {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
       {!!Form::close()!!}
    </td>
</tr>
@endforeach
            

        </table>

    @else

    <p>Currently you have no packages with us. Click below to upload a package or invoice.</p>
    <a href="/customerpackage/create" class="btn btn-primary">Add Package</a>

    @endif

    {{-- <h1>Users</h1>

    @if (count($users) > 0)
        @foreach ($users as $user)
            <p>{{$user->name}}</p>
            <p>{{$user->email}}</p>
        @endforeach
    @else
        
    @endif --}}
@endsection