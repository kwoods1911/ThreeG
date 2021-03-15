@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->user_role == 'customer')
                        <p>You are a customer</p>
                        <h3>View your packages</h3>
                            <a href="/customerpackage" class="btn btn-primary">My Packages</a>
                        @else
                        <p>Manager: {{auth()->user()->name}}</p>
                        <p>Display Table</p>
                        <ul>
                            {{-- Each link should have their own controller --}}
                            <li>
                                {{--  ManagePackage Controller --}}
                                <a href="/managepackages">Incomming Packages</a>    
                            </li>
                            <li>
                                {{--  InventoryManagement Controller --}}
                                <a href="/inventorymanagement">View Inventory</a>    
                            </li>
                            <li>
                                {{-- GenerateReport Controller --}}
                                <a href="/shipmentreport">Generate Shipment Report</a>    
                            </li>
                            
                            <li>
                                <a href="/manageaccounts">Manage Accounts</a>
                            </li>
                        </ul>
                        
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
