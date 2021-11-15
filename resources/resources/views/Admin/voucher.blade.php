@extends('Admin.layouts.app')

@section('data')
    <x-message/>
    @if($error)
		<div class="alert alert-danger">{{ $error }}</div>
	@endif
    @if($message)
        <div class="alert alert-danger">{{ $message }}</div>
    @endif
	<h4 class="text-center">VOUCHER DETAILS<span><a href="{{ route('admin_add_voucher') }}" class="btn btn-primary pull-right">ADD</a></span></h4>
    <div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="thead-dark">
                <tr align="center">
                    <th width="5%">S.No.</th>
                    <th width="10%">COUPON NAME</th>
                    <th width="15%">COUPON VALUE</th>
                    <th width="15%">EXPIRY DATE</th>
                    <th width="15%">STATUS</th>
                    <th width="15%">ACTION</th>
                </tr>
            </thead>
            <tbody>
            @if(count($coupons))
                @foreach($coupons as $coupon)
                    <tr align="center">
                        <td class="counterCell"></td>
                        <td>{{ $coupon->coupon_name }}</td>
                        <td>{{ $coupon->coupon_value }}</td>
                        <td>{{ $coupon->expDate }}</td>
                        <td>{{ $coupon->status ? 'ACTIVE' : 'INACTIVE' }}</td>
                        <td>
                            <form method="post" action="{{ route('admin_voucher_toggle') }}">
                                <input type="hidden" name="coupon" value="{{ $coupon->id }}">
                                <input type="submit" class="btn btn-primary" name="submit" value="toggle status">
                            </form>
                        </td>
                    </tr>
                @endforeach 
            @else
                <td colspan="6" align="center">No Coupons Available. </td>
            @endif
            </tbody>
        </table>
    </div>

@endsection
