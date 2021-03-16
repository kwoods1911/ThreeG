@extends('layouts.app')

@section('content')

<h1>Account Information</h1>

<a href="/manageaccounts" class="btn btn-primary">
    <span><<  </span>
    Go Back</a>
<table class="table table-striped table-hover">
    <tr>
        <th>Account #</th>
        <td>{{$account->id}}</td>
    </tr>
    <tr>
        <th>username</th>
        <td>{{$account->name}}</td>
    </tr>
    <tr>
        <th>Password</th>
        <td>{{$account->password}}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{$account->email}}</td>
    </tr>
    <tr>
        <th>Created At:</th>
        <td>{{$account->created_at}}</td>
    </tr>

    <tr>
        <th>User Role</th>
        <td>{{$account->user_role}}</td>
    </tr>
</table>

<a href="/manageaccounts/{{$account->id}}/edit" class="btn btn-primary"> Edit Acount Information</a>

@endsection