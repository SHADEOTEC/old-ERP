@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Edit Control</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('controltype.motor.update', $controltype->id) }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Control Name" id="name" name="name" class="form-control" value="{{$controltype->name}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Control Code</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Control Code" id="ct_code" name="ct_code" class="form-control" value="{{$controltype->ct_code}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="price">Price</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Price" id="price" name="price" class="form-control" value="{{$controltype->price}}">
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="position">Position</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Position" id="position" name="position" class="form-control" value="{{$controltype->position}}" required>
                    </div>
                </div> -->
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="length">Length</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="like: 1 ft." id="length" name="length" class="form-control" value="{{$controltype->length}}" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="form-group form-check ">
                            <input type="checkbox" class="form-check-input" value="Active" id="state" name="state" @if($controltype->state == 'Active') checked @endif>
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
