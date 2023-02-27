@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Edit Product</h5>
</div>

<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.admin.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Product Name" id="name" name="name" class="form-control" value="{{$product->name}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Category</label>
                    <div class="col-sm-9">
                        <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-selected="{{ $product->category_id }}" data-live-search="false" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('categories.child_category', ['child_category' => $childCategory])
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Tags</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control aiz-tag-input" name="tags[]" id="tags" value="{{ $product->tags }}" placeholder="{{ translate('Type to add a tag') }}" data-role="tagsinput">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Fabric</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="fabric[]" id="fabric" style="height: 210px;" data-live-search="true" multiple required>
                            @foreach($fabrics as $item)
                                @if(in_array($item->id, $fabric_array))
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Cassettes</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="cassette[]" id="cassette" style="height: 210px;" data-live-search="true" multiple >
                            @foreach($cassettes as $item)
                                @if(in_array($item->cassette_code, $cass_array))
                                <option value="{{$item->cassette_code}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->cassette_code}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Mounts</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="mount[]" id="mount" style="height: 210px;" data-live-search="true" multiple required>
                            @foreach($mounts as $item)
                                @if(in_array($item->id, $mount_array))
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Brackets</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="bracket[]" id="bracket" style="height: 210px;" data-live-search="true" multiple required>
                            @foreach($brackets as $item)
                                @if(in_array($item->id, $bracket_array))
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Springassist</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="springassist[]" id="springassist" style="height: 210px;" data-live-search="true" multiple >
                            @foreach($springassists as $item)
                                @if(in_array($item->id, $sa_array))
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Room Types</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="roomtype[]" id="roomtype" style="height: 210px;" data-live-search="true" multiple required>
                            @foreach($roomtypes as $item)
                                @if(in_array($item->id, $roomtype_array))
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Fabric Wrapped</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="wrap" id="wrap" style="height: 210px;" data-live-search="true">
                            <option value="">Select Fabric Wrapped</option>
                            @foreach($wraps as $item)
                                @if($item->wrap_code == $wrap_selected->wrap_code)
                                <option value="{{$item->wrap_code}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->wrap_code}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Stacks</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="stack[]" id="stack" style="height: 210px;" multiple data-live-search="true">
                            @foreach($stacks as $item)
                                @if(in_array($item->id, $stack_array))
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Control Types -->
                <!-- Manual -->
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Manual Control</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="ct_manual[]" id="ct_manual" style="height: 210px;" multiple data-live-search="true">
                            @foreach($ct_manuals as $item)
                                @if(in_array($item->id, $ct_man_array))
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /Manual -->
                <!-- Motor -->
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Motor Control</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="ct_motor[]" id="ct_motor" style="height: 210px;" multiple data-live-search="true">
                            @foreach($ct_motors as $item)
                                @if(in_array($item->id, $ct_motor_array))
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /Motor -->
                <!-- Width Motor -->
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Width Motor Control</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="ct_wid_motor" id="ct_wid_motor" style="height: 210px;" data-live-search="true">
                        <option value="">Select Width Motor</option>
                            @foreach($ct_wid_motors as $item)
                                @if($item->ct_code == $ct_wm_selected->ct_widmotor_code)
                                <option value="{{$item->ct_code}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->ct_code}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /Width Motor -->
                <!-- /Control Types -->
                <!-- Price Model -->
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Price Model</label>
                    <div class="col-sm-9">
                        <select class="form-control mb-3 aiz-selectpicker" name="shade_code" id="shade_code" style="height: 210px;"  data-live-search="true" required>
                            <option value="">Select shade code for the price model</option>
                            <option value="duo_lfc">duo_lfc</option>
                            <option value="duo_luxe">duo_luxe</option>
                            <option value="duo_rdc">duo_rdc</option>
                            <option value="tri_lfc">tri_lfc</option>
                            <option value="tri_rdc">tri_rdc</option>
                            <option value="uni">uni</option>
                            <option value="willow_lfc">willow_lfc</option>
                            <option value="willow_rdc">willow_rdc</option>
                            <option value="roller_lightpatt">roller_lightpatt</option>
                            <option value="roller_lightplain">roller_lightplain</option>
                            <option value="roller_darksolid">roller_darksolid</option>
                            <option value="roller_darkpatt">roller_darkpatt</option>
                            <option value="roller_sunscreen">roller_sunscreen</option>
                        </select>
                    </div>
                </div>
                <!-- /Price Model -->


                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="thumbnail_img">Image</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="thumbnail_img" name="thumbnail_img">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="description">Description</label>
                    <div class="col-sm-9">
                        <textarea class="aiz-text-editor" name="description" id="description">{{$product->description}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="specification">Specification</label>
                    <div class="col-sm-9">
                        <textarea class="aiz-text-editor" name="specification" id="specification">{{$product->specification}}</textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="form-group form-check ">
                            <input type="checkbox" class="form-check-input" value="Active" id="state" name="state" @if($product->state == 'Active') checked @endif>
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
