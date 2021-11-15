@extends('Admin.layouts.app')

@section('data')
	<x-message/>
	<h4 class="text-center">SELLER ACCOUNT</h4>
    <div class="container-fluid mt-5 mb-5">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr align="center">
                    <th >S.No.</th>
                    <th>Company Name</th>
                    <th>PAN No.</th>
                    <th>Registerd At</th>
                    <th>Phone No.</th>
                    <th>Account Status</th>
                    <th>Account Open</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sellers as $seller)
                    <tr align="center">
                        <td class="counterCell"></td>
                        <td>{{ $seller->comp_name ? $seller->comp_name : 'NA' }}</td>
                        <td>{{ $seller->adhar_number ? $seller->adhar_number : 'NA'  }}</td>
                        <td>{{ date('d-m-Y', strtotime($seller->created_at)) }}</td>
                        <td>{{ $seller->mobile_number }}</td>
                        <td>{{ $seller->status ? 'Active' : 'Inactive' }}</td>
                        <td>{{ date('d-m-Y', strtotime($seller->updated_at)) }}</td>
                        <td>
                            <form method="post" action="{{ route('seller_account_toggle') }}">
                                <input type="hidden" name="tour_operator_id" value="{{ $seller->id }}">
                                <input type="submit" class="btn btn-primary" name="submit" value="toggle status">
                            </form>
                        </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>
    </div>
@endsection
