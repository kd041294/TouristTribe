@extends('Seller.layouts.app')


@section('data')
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="card mtb-5">
                    <div class="card-header" style="text-align:center;">
				    <h3>Payment Info Edit</h3>
                    </div>
                    @if($error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endif
                    <form method="post" action="{{ route('payment_info_edit') }}">
					    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Bank Account Name</label>
                                <input type="text" name="bank_account_name" value="{{ $tour_operator->bank_account_name ? $tour_operator->bank_account_name : '' }}"  class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Bank Account Number</label>
                                <input type="number" name="bank_account_no"  class="form-control" value="{{ $tour_operator->bank_account_no ? $tour_operator->bank_account_no : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>IFSC code</label>
                                <input type="number" name="ifsc_code"  class="form-control" value="{{ $tour_operator->bank_ifsc_code ? $tour_operator->bank_ifsc_code : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input type="number" name="bank_mobile_no"  class="form-control" value="{{ $tour_operator->bank_mobile_number ? $tour_operator->bank_mobile_number : '' }}" required>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="submit" class="btn btn-primary btn-block">
                            </div>
                        </div>
					</form>
                </div>
            </div>
        </div>
@endsection