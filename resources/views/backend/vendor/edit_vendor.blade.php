@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Edit Vendor</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('vend_formula.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="vendor">Vendor</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Vendor Name" id="vendor" name="vendor" class="form-control" value="{{$vendor->vendor}}"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="formula">Formula</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Formula Name" id="formula" name="formula" class="form-control" value="{{$vendor->formula}}"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="shades">Shades</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Shades" id="shades" name="shades" class="form-control" value="{{$vendor->shades}}"  >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="fascia">Fascia</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Fascia" id="fascia" name="fascia" class="form-control" value="{{$vendor->fascia}}"  >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="tube">Tube</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Tube" id="tube" name="tube" class="form-control" value="{{$vendor->tube}}"  >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bottom_rail">Bottom Rail</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Bottom Rail" id="bottom_rail" name="bottom_rail" class="form-control" value="{{$vendor->bottom_rail}}"  >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bottom_tube">Bottom Tube</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Bottom Tube" id="bottom_tube" name="bottom_tube" class="form-control" value="{{$vendor->bottom_tube}}"  >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="fabric_width">Fabric Width</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Fabric Width" id="fabric_width" name="fabric_width" class="form-control" value="{{$vendor->fabric_width}}"  >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="fabric_height">Fabric Height</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Fabric Height" id="fabric_height" name="fabric_height" class="form-control" value="{{$vendor->fabric_height}}"  >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="blind_width">Blind Width</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Blind Width" id="blind_width" name="blind_width" class="form-control" value="{{$vendor->blind_width}}"  >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="form-group form-check ">
                            <input type="checkbox" class="form-check-input" value="1" id="state" name="state" @if($vendor->state == 1) checked @endif>
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
