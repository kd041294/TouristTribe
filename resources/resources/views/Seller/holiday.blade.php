@extends('Seller.layouts.app')

@section('data')
    <x-message/>
    @if($error)
		<div class="alert alert-danger">{{ $error }}</div>
	@endif
    @if($message)
        <div class="alert alert-danger">{{ $message }}</div>
    @endif
	<h4 class="text-center">HOLIDAY DETAILS<span><a href="{{ route('add_tour_operator_holiday') }}" class="btn btn-primary pull-right">ADD</a></span></h4>
    <div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-nowrap">
            <!--<thead class="thead-dark">-->
            <thead>
                <tr align="center">
                    <th width="5%">S.No.</th>
                    <th width="10%">TOUR OPERATOR ID</th>
                    <th width="15%">NAME</th>
                    <th width="15%">FROM(date)</th>
                    <th width="10%">TO(date)</th>
                    <th width="10%">Action</th>
                    
                </tr>
            </thead>
            <tbody>
            @if(count($holidays))
                @foreach($holidays as $holiday)
                    <tr align="center">
                        <td class="counterCell"></td>
                        <td>{{ $holiday->tour_operator_id }}</td>
                        <td>{{ $holiday->name }}</td>
                        <td>{{ date('d-m-Y', strtotime($holiday->from_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($holiday->to_date)) }}</td>
                        <td></td>
                    </tr>

                @endforeach 
            @else
                <td colspan="6" align="center">No Holidays </td>
            @endif
            </tbody>
        </table>
    </div></div>

@endsection
