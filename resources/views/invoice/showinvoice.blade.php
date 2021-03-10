@extends('layouts.app')

@section('content')
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
    Customer Address
    <br>
    Phone number
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
        </td>
        <td>1</td>
        <td>{{$invoice->item_value}}</td>
        <td>{{($invoice->item_value) * 0.12}}</td>
        <td>{{($invoice->item_value) * 1.12}}</td>
    </tr>
    <tr>
        <td>Customs VAT(12%)</td>
        <td>1</td>
        <td>${{$invoice->customs_tax}}</td>
        <td>${{$invoice->customs_vat}}</td>
        <td>${{$invoice->total_cost}}</td>
    </tr>

    <tr>
        <td>Processing</td>
        <td>1</td>
        <td>$12.00</td>
        <td>$14.11</td>
        <td>$0.00</td>
    </tr>

    <tr>
        <td>Grand Total</td>
        <td>1</td>
        <td>$ {{$invoice->total_cost}}</td>
        <td>$ {{$invoice->total_cost}}</td>
        <td>$ {{$invoice->total_cost}}</td>
    </tr>
 
</table>

<p>
    Three G LTD is not responsible for damages items and packages or shortages of items received
    on of the packages are in posession of the customer.
    This document does not confirm that the item has been paid for.
    Package MUST BE collected within 5 business days of arriving to Nassau. Packages left after 30days will be sold to cover the costs.
</p>


@endsection