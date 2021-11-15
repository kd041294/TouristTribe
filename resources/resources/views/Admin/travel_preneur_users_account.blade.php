@extends('Admin.layouts.app')

@section('data')
	<x-message/>
	<h4 class="text-center">TRAVEL PRENEUR USERS</h4>
    <div class="container-fluid mt-5 mb-5">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr align="center">
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Aadhar No.</th>
                    <th>Phone No.</th>
                    <th>Registered At</th>
                    <th>Account Status</th>
                    <th>Account Open</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($travel_preneur_users as $travel_preneur_user)
                    <tr align="center">
                        <td class="counterCell"></td>
                        <td>{{ $travel_preneur_user->name }}</td>
                        <td>{{ $travel_preneur_user->email  }}</td>
                        <td>{{ $travel_preneur_user->aadhar_no  }}</td>
                        <td>{{ $travel_preneur_user->phone }}</td>
                        <td>{{ date('d-m-Y', strtotime($travel_preneur_user->created_at)) }}</td>
                        <td>{{ $travel_preneur_user->status ? 'Active' : 'Inactive' }}</td>
                        <td>{{ date('d-m-Y', strtotime($travel_preneur_user->updated_at)) }}</td>
                        <td>
                            <form method="post" action="{{ route('travel_preneur_users_toggle') }}">
                                <input type="hidden" name="travel_preneur_user_id" value="{{ $travel_preneur_user->id }}">
                                <input type="submit" class="btn btn-primary" name="submit" value="toggle status">
                            </form>
                        </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>
    </div>
@endsection
