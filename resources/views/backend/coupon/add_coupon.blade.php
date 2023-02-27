@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Add New Couponassadasda</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Code</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Coupon Code" id="code" name="code" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="discount">Discount Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="discount_type" name="discount_type" required>
                            <option value="">Select Discount Type</option>
                            <option value="0">Amount</option>
                            <option value="1">Percentage</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="discount">Discount</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Amount or Percentage" id="discount" name="discount" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="discount">Start Date</label>
                    <div class="col-sm-9">
                        <input type="date" placeholder="" id="start_date" name="start_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="discount">End Date</label>
                    <div class="col-sm-9">
                        <input type="date" placeholder="" id="end_date" name="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="form-group form-check ">
                            <input type="checkbox" class="form-check-input" value="Active" id="state" name="state">
                            <label class="form-check-label pt-1" for="state" style="font-size:0.75rem;">Active</label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
