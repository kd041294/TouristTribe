@extends('Seller.layouts.app')


@section('data')
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="card mtb-5">
                    <div class="card-header">
				    <h3>Payment Info<span>
				        <a type="button" href="{{ route('payment_info_edit') }}" class="btn btn-outline-info">
				            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                                </svg></a>
				        <a type="submit" href="{{ route('payment_info_delete') }}" class="btn btn-primary float-right">Delete</a></span></h3>
                    </div>
                    <form method="post" action="{{ route('payment_info') }}">
					    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Bank Account Name = {{ $tour_operator->bank_account_name ? $tour_operator->bank_account_name : "No Data Found" }}</label>
                            </div>
                            <div class="form-group">
                                <label>Bank Account Number = {{ $tour_operator->bank_account_no ? $tour_operator->bank_account_no : "No Data Found" }}</label>
                            </div>
                            <div class="form-group">
                                <label>IFSC code = {{ $tour_operator->bank_ifsc_code ? $tour_operator->bank_ifsc_code : "No Data Found" }}</label>
                            </div>
                            <div class="form-group">
                                <label>Mobile No. = {{ $tour_operator->bank_mobile_number ? $tour_operator->bank_mobile_number : "No Data Found" }}</label>
                            </div>
                        </div>
					</form>
                </div>
            </div>
        </div>
@endsection