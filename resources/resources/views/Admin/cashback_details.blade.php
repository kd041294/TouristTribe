@extends('Admin.layouts.app')

@section('data')
	<x-message/>
    @if($error)
		<div class="alert alert-danger">{{ $error }}</div>
	@endif
    @if($message)
        <div class="alert alert-danger">{{ $message }}</div>
    @endif
	<h4 class="text-center">CASHBACK DETAILS</h4>
    <div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="thead-dark">
                <tr align="center">
                    <th width="5%">S.No.</th>
                    <th width="10%">Customer Id</th>
                    <th width="15%">Customer Details</th>
                    <th width="15%">Customer Booking Details</th>
                    <th width="15%">Transfer Amount Pay By Customer</th>
                    <th width="10%">Payable Amount</th>
                    <th width="15%" colspan="2">Confirmation(paid/unpaid, transaction no.)</th>
                    <th width="10%">Action</th>
                    
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>


@endsection