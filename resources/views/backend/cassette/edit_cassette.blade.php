@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Edit Cassette</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('cassette.update', $cassette->id) }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="cassette_code">Code</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Cassette Code" id="cassette_code" name="cassette_code" class="form-control" value="{{$cassette->cassette_code}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Cassette Name" id="name" name="name" class="form-control" value="{{$cassette->name}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Category</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="category_id" id="category_id" >
                            <option value="">Select Category</option>
                            @foreach ($categories as $item)
                                @if($item->id == $cassette->category_id)
                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Colors</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control aiz-tag-input" name="colors[]" id="colors" value="{{ $str_color }}" placeholder="{{ translate('Type to add colors') }}" data-role="tagsinput" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="min_wid">Minimum Width</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Minimum Width" id="min_wid" name="min_wid" class="form-control" value="{{$cassette->min_wid}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="min_wid">Maximum Width</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Maximum Width" id="max_wid" name="max_wid" class="form-control" value="{{$cassette->max_wid}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Price</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Price" id="price" name="price" class="form-control" value="{{$cassette->price}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="form-group form-check ">
                            <input type="checkbox" class="form-check-input" value="Active" id="state" name="state" @if($cassette->state == 'Active') checked @endif>
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
