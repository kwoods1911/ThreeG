@extends('layouts.app')

@section('content')
<a href="/inventorymanagement/{{$invoice->packageid}}" class="btn btn-primary">Go Back</a>
<h1>THREE G SHIPPING LTD.</h1>
<span>
    #123 Johnson St. Nassau
    New Providence Bahamas
    Tel: 242-333-1290
</span>
<h1>NOT A RECEIPT</h1>
<p>Invoice    #{{$invoice->id}}</p>
<p>Date:       {{$invoice->created_at}}</p>
<p>Created By: {{$invoice->manager_name}}</p>


<div>
    <p>Customer ID: {{$invoice->customer_id}} </p>
    <p>Customer Name: {{$invoice->customer_name}} </p>
</div>

<a href="#" class="btn btn-primary">Download Invoice</a>
<table class="table">
    <tr>
        <th>Item</th>
        <th>Price</th>
        <th>VAT(12%)</th>
        <th>Total</th>
    </tr>

    <tr>
        <td>Freight: {{$invoice->package_weight}} (LBS)</td>
        <td>$ {{round($invoice->shipping_cost,2)}} </td>
        <td>$ {{round($invoice->shipping_cost_vat,2)}}</td>
        <td>$ {{round($invoice->shipping_cost_total,2)}}</td>
    </tr>
    <tr>
        <td>Package Desc.
            <b>{{$invoice->package_description}}</b>
            <br>
            <span>Item Value ${{round($invoice->item_value,2)}}</span>
            <br>
            <span>CUSTOMS DUTY {{$invoice->customs_rate}} %</span>
        </td>
        <td>$ {{round($invoice->customs_tax_amount,2)}}</td>
        <td>$ {{round($invoice->customs_tax_amount_vat,2)}}</td>
        <td>$ {{round($invoice->customs_tax_total,2)}}</td>
    </tr>

    <tr>
        <td>Processing</td>
        <td>$ {{round($invoice->processing_fee,2)}}</td>
        <td>$ {{round($invoice->processing_fee_vat,2)}}</td>
        <td>$ {{round($invoice->processing_fee_total,2)}}</td>
    </tr>

    <tr>
        <td>Final</td>
        <td>$ {{round($invoice->subtotal,2)}}</td>
        <td>$ {{round($invoice->subtotal_vat,2)}}</td>
        <td>$ {{round($invoice->final_total,2)}}</td>
    </tr>
 
</table>

<p>
    Three G LTD is not responsible for damages items and packages or shortages of items received
    on of the packages are in posession of the customer.
    This document does not confirm that the item has been paid for.
    Package MUST BE collected within 5 business days of arriving to Nassau. Packages left after 30days will be sold to cover the costs.
</p>

<h3>Delete Invoice:</h3>
            {!!Form::open(['action' => ['App\Http\Controllers\ModifyInvoiceController@destroy', $invoice->id], 'method' => 'POST'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
@endsection