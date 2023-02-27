@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Edit Springassist</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('springassist.update', $springassist->id) }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Springassist Name" id="name" name="name" class="form-control" value="{{$springassist->name}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="option_code">Option Code</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Code" id="option_code" name="option_code" class="form-control" value="{{$springassist->option_code}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="price">Price</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Price" id="price" name="price" class="form-control" value="{{$springassist->price}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="width_limit">Width Limit</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Width Limit" id="width_limit" name="width_limit" class="form-control" value="{{$springassist->width_limit}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="form-group form-check ">
                            <input type="checkbox" class="form-check-input" value="Active" id="state" name="state" @if($springassist->state == 'Active') checked @endif>
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
