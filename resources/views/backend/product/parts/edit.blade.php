@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Edit Part</h5>
</div>

<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('parts.admin.update', $part->id) }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Part Name" id="name" name="name" class="form-control" value="{{$part->name}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="part_code">Code</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Part Code" id="part_code" name="part_code" class="form-control" value="{{$part->part_code}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="price">Price</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Price" id="price" name="price" class="form-control" value="{{$part->unit_price}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="description">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="description" name="description" placeholder="Detailed information about the part." required>{{$part->description}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="specification">Specification</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="specification" name="specification" placeholder="Technical Details" required>{{$part->specification}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="thumbnail_img">Image</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="thumbnail_img" name="thumbnail_img" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="form-group form-check ">
                            <input type="checkbox" class="form-check-input" value="Active" id="state" name="state" @if($part->state == 'Active') checked @endif>
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
