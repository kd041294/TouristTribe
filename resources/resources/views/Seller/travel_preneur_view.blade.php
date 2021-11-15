@extends('Seller.layouts.app')

@section('data')
	<x-message/>
	<div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="card">
                    <div class="card-header" style="text-align:center"><h4>View TravelPreneur User</h4></div>
                    <div class="card-body">
                        @if($error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endif
                        
                        <p>Name : {{ $travel_preneur->name }}</p>
                        <p>Email : {{ $travel_preneur->email }}</p>
                        <p>Aadhar No. : {{ $travel_preneur->aadhar_no }}</p>
                        <p>Phone : {{ $travel_preneur->phone }}</p>
                       
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection