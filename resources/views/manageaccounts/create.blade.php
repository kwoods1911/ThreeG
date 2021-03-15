@extends('layouts.app')

@section('content')
<h1>Create Account</h1>
<a href="/manageaccounts">Go Back</a>



{!! Form::open(['action' => 'App\Http\Controllers\ManageAccountsController@store', 'method' => 'POST']) !!}

<div class="form-group">
    {{Form::label('user_name', 'User Name')}} <span>:</span>
    {{Form::text('user_name','',['class' => 'form-control', 'placeholder' => 'John Doe'])}}
</div>

<div class="form-group">
    {{Form::label('email', 'Email')}} <span>:</span>
    {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'email'])}}
</div>

<div class="form-group">
    {{Form::label('confirm_email', 'Confirm Email')}} <span>:</span>
    {{Form::email('confirm_email', '', ['class' => 'form-control', 'placeholder' => 'email'])}}
</div>

<div class="form-group">
    {{Form::label('password', 'Password')}} <span>:</span>
    {{Form::text('password','',['class' => 'form-control', 'placeholder' => '12345'])}}
</div>

<div class="form-group">
    {{Form::label('confirm_password', 'Confirm Password')}} <span>:</span>
    {{Form::text('confirm_password','',['class' => 'form-control', 'placeholder' => '12345'])}}
</div>

<div class="form-group">
    {{Form::label('user_role', 'User Role')}} <span>:</span>
    {{Form::select('user_role', ['customer' => 'Customer', 'admin' => 'Administrator'], 'customer')}}
</div>

{{Form::submit('Create Account',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection