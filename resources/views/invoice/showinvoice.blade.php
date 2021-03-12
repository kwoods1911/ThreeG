@extends('layouts.app')

@section('content')

@php
    $processingFee = 10.00;
    $subTotal = $invoice->shipping_cost + $invoice->item_value + $invoice->customs_tax + $processingFee;
    $totalTaxes = (($invoice->shipping_cost) * 0.012)+ ($invoice->item_value * 0.012)+($invoice->customs_tax*0.012)+($processingFee * 0.012);

@endphp
<h1>THREE G SHIPPING LTD.</h1>
<span>
    #123 Johnson St. Nassau
    New Providence Bahamas
    Tel: 242-333-1290
</span>
<h1>NOT A RECEIPT</h1>
<p>Invoice #{{$invoice->invoice_num}}</p>
<p>Date: 21/01/2021 5:41PM</p>
<p>Created By: Adebo Woods</p>

<Address>
    Customer name: {{$invoice->customer_name}}
    <br>
    Customer ID:
    <br>
    Customer Address:
    <br>
    Phone number:
</Address>

<p>Customer Email: </p>


<a href="#" class="btn btn-primary">Download Invoice</a>

<table class="table">
    <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Price</th>
        <th>VAT(12%)</th>
        <th>Total</th>
    </tr>

    <tr>
        <td>Freight (insert package weight)</td>
        <td>1</td>
        <td>$ {{$invoice->shipping_cost}}</td>
        <td>$ {{($invoice->shipping_cost) * 0.12}}</td>
        <td>$ {{($invoice->shipping_cost) * 1.12}}</td>
    </tr>
    <tr>
        <td>Package Desc.
            <b>{{$invoice->package_description}}</b>
            <span>CUSTOMS DUTY{{$invoice->customs_tax_rate * 100}} %</span>
        </td>
        <td>1</td>
        <td>{{$invoice->item_value}}</td>
        <td>{{($invoice->item_value) * 0.012}}</td>
        <td>{{($invoice->item_value) * 1.012}}</td>
    </tr>
    <tr>
        <td>Customs VAT(12%)</td>
        <td>1</td>
        <td>${{$invoice->customs_tax}}</td>
        <td>${{$invoice->customs_vat}}</td>
        <td>${{$invoice->customs_tax + $invoice->customs_vat}}</td>
    </tr>

    <tr>
        <td>Processing</td>
        <td>1</td>
        <td>$ {{$processingFee}}</td>
        <td>$ {{$processingFee * 0.012}}</td>
        <td>$ {{$processingFee * 1.012}}</td>
    </tr>

    <tr>
        <td>Grand Total</td>
        <td>1</td>
        <td>$ {{$subTotal}}</td>
        <td>$ {{$totalTaxes}}</td>
        <td>$ {{$subTotal + $totalTaxes}}</td>
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