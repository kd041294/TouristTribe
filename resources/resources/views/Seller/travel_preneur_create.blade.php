@extends('Seller.layouts.app')


@section('data')
	<x-message/>
	<div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="card">
                    <div class="card-header" style="text-align:center"><h4>Add TravelPreneur User</h4></div>
                    <div class="card-body">
                        @if($error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endif
                        <form method="post" action="{{ route('seller_travel_preneur_create') }}">
                            <div class="form-group">
                                <label for="sel1">Enter TravelPreneur Id :</label>
                                <input type="text" class="form-control" name="travel_preneur_user">
                                
                            </div>
                            
                            <button type="submit" class="btn btn-outline-info btn-block">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection