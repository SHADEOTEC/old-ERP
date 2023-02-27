@extends('backend.layouts.app')

@section('mystyles')
    <link rel="stylesheet" href="{{ static_asset('assets/js/multiselect/bootstrap-multiselect.min.css') }}">

    <style>
        /* Multiselect styles */
        span.multiselect-native-select {
            position: relative;
        }

        span.multiselect-native-select select {
            border: 0 !important;
            clip: rect(0 0 0 0) !important;
            height: 1px !important;
            margin: -1px -1px -1px -3px !important;
            overflow: hidden !important;
            padding: 0 !important;
            position: absolute !important;
            width: 1px !important;
            left: 50%;
            top: 30px;
        }

        .multiselect.dropdown-toggle:after {
            display: none;
        }

        .multiselect-container {
            position: absolute;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .multiselect-container .multiselect-reset .input-group {
            width: 93%;
        }

        .multiselect-container .multiselect-filter>.fa-search {
            z-index: 1;
            padding-left: 0.75rem;
        }

        .multiselect-container .multiselect-filter>input.multiselect-search {
            border: none;
            border-bottom: 1px solid #d3d3d3;
            padding-left: 2rem;
            margin-left: -1.625rem;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .multiselect-container .multiselect-filter>input.multiselect-search:focus {
            border-bottom-right-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }

        .multiselect-container .multiselect-filter>.multiselect-moz-clear-filter {
            margin-left: -1.5rem;
            display: none;
        }

        .multiselect-container .multiselect-option.multiselect-group-option-indented {
            padding-left: 1.75rem;
        }

        .multiselect-container .multiselect-all,
        .multiselect-container .multiselect-group,
        .multiselect-container .multiselect-option {
            padding: 0.25rem 0.25rem 0.25rem 0.75rem;
        }

        .multiselect-container .multiselect-all.dropdown-item,
        .multiselect-container .multiselect-all.dropdown-toggle,
        .multiselect-container .multiselect-group.dropdown-item,
        .multiselect-container .multiselect-group.dropdown-toggle,
        .multiselect-container .multiselect-option.dropdown-item,
        .multiselect-container .multiselect-option.dropdown-toggle {
            cursor: pointer;
        }

        .multiselect-container .multiselect-all .form-check-label,
        .multiselect-container .multiselect-group .form-check-label,
        .multiselect-container .multiselect-option .form-check-label {
            cursor: pointer;
        }

        .multiselect-container .multiselect-all.active:not(.multiselect-active-item-fallback),
        .multiselect-container .multiselect-all:not(.multiselect-active-item-fallback):active,
        .multiselect-container .multiselect-group.active:not(.multiselect-active-item-fallback),
        .multiselect-container .multiselect-group:not(.multiselect-active-item-fallback):active,
        .multiselect-container .multiselect-option.active:not(.multiselect-active-item-fallback),
        .multiselect-container .multiselect-option:not(.multiselect-active-item-fallback):active {
            background-color: #d3d3d3;
            color: #000;
        }

        .multiselect-container .multiselect-all .form-check,
        .multiselect-container .multiselect-group .form-check,
        .multiselect-container .multiselect-option .form-check {
            padding: 0 5px 0 20px;
        }

        .multiselect-container .multiselect-all:focus,
        .multiselect-container .multiselect-group:focus,
        .multiselect-container .multiselect-option:focus {
            outline: 0;
        }

        .form-inline .multiselect-container span.form-check {
            padding: 3px 20px 3px 40px;
        }

        .input-group.input-group-sm>.multiselect-native-select .multiselect {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            padding-right: 1.75rem;
            height: calc(1.5em + 0.5rem + 2px);
        }

        .input-group>.multiselect-native-select {
            flex: 1 1 auto;
            width: 1%;
        }

        .input-group>.multiselect-native-select>div.btn-group {
            width: 100%;
        }

        .input-group>.multiselect-native-select:not(:first-child) .multiselect {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .input-group>.multiselect-native-select:not(:last-child) .multiselect {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .multiselect-container {
            width: 100%;
        }

        .btn-group {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <h5 class="h6 mb-0">{{ translate('Add New Product') }}</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="choice_form">
            <div class="row gutters-5">
                <div class="col-lg-8">
                    @csrf
                    <input type="hidden" name="added_by" value="admin">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Product Information') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Product Name') }} <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" placeholder="{{ translate('Product Name') }}" required>
                                </div>
                            </div>
                            <div class="form-group row" id="category">
                                <label class="col-md-3 col-from-label">{{ translate('Category') }} <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control" name="category_id" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            @foreach ($category->childrenCategories as $childCategory)
                                                @include('categories.child_category', ['child_category' => $childCategory])
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <span id="cat_err"></span>
                            </div>
                            <div class="form-group row d-none" id="brand">
                                <label class="col-md-3 col-from-label">{{ translate('Brand') }}</label>
                                <div class="col-md-8">
                                    <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">
                                        <option value="">{{ translate('Select Brand') }}</option>
                                        @foreach (\App\Brand::all() as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->getTranslation('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Tags') }} <span class="text-danger"></span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control aiz-tag-input" name="tags[]" placeholder="{{ translate('Type and hit enter to add a tag') }}">
                                    <small class="text-muted">{{ translate('This is used for search. Input those words by which cutomer can find this product.') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Fabric Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Fabric') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Fabric</label>
                                    {{-- <small class="text-muted" style="font-size:13px;">Press 'ctrl' + 'click' to multiselect.</small> --}}
                                </div>
                                <div class="col-8">
                                    <select class="form-control mb-3" style="width: 100%" id="fabric" multiple required>
                                        {{-- @foreach ($fabrics as $item)
                                            <option value="{{ $item->id }}" data-fabric-cat={{ $item->shade_subcat }}>{{ $item->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <!-- Button trigger Add Fabric modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFabricModal">Add New Fabric</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Fabric End -->

                    <!--Cassette Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Cassettes') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Cassette</label>

                                </div>
                                <div class="col-md-8">
                                    <select class="form-control mb-3" id="cassette" multiple>
                                        {{--  @foreach ($cassettes as $item)
                                            <option class="d-none" value="{{ $item->cassette_code }}" data-cassette-cat={{ $item->category_id }}>{{ $item->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Cassette End -->

                    <!--Mount Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Mounts') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Mount</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control mb-3" id="mount" multiple>
                                        @foreach ($mounts as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Mount End -->

                    <!--Bracket Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Brackets') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Bracket</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control mb-3" id="bracket" multiple required>
                                        @foreach ($brackets as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Bracket End -->

                    <!--Springassist Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Springassists') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Springassist</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control mb-3" id="springassist" multiple>
                                        @foreach ($springassists as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Springassist End -->

                    <!--Room Type Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Room Types') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Room Type</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control mb-3" id="roomtype" multiple required>
                                        @foreach ($roomtypes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Room Type End -->

                    <!--Stack Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Stack') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Stack</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control mb-3" id="stack" multiple>
                                        @foreach ($stacks as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Stack End -->

                    <!--Fabric Wrapped Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Fabric Wrapped') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <select class="form-control mb-3" name="wrap" id="wrap">
                                        <option value="">Select Fabric Wrapped</option>
                                        @foreach ($wraps as $item)
                                            <option value="{{ $item->wrap_code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Fabric Wrapped End -->

                    <!--Manual Control Type Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Manual Control Type') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Manual Control</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control mb-3" id="ct_manual" multiple required>
                                        @foreach ($ct_manuals as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Manual Control Type End -->

                    <!--Motor Control Type Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Motor Control Type') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Motor Control</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control mb-3" id="ct_motor" multiple>
                                        @foreach ($ct_motors as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Motor Control Type End -->

                    <!--Width Control Type Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Width Control Type') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <select class="form-control mb-3" name="ct_wid_motor" id="ct_wid_motor" style="">
                                        <option value="">Select Width Control Type</option>
                                        @foreach ($ct_wid_motors as $item)
                                            <option value="{{ $item->ct_code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Width Control Type End -->

                    <!--Wand Start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Wand') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label style="font-size:15px;">Select Wand</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control mb-3" id="wand" multiple>
                                        @foreach ($wands as $item)
                                            <option value="{{ $item->id }}">{{ $item->length }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Wand End -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Product Image') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-from-label" for="image">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="thumbnail_img" name="thumbnail_img" required>
                                </div>
                            </div>
                            <small
                                   class="text-muted mb-3">{{ translate('This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.') }}</small>
                        </div>
                    </div>
                    <div class="card d-none">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Product Videos') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Video Provider') }}</label>
                                <div class="col-md-8">
                                    <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">
                                        <option value="youtube">{{ translate('Youtube') }}</option>
                                        <option value="dailymotion">{{ translate('Dailymotion') }}</option>
                                        <option value="vimeo">{{ translate('Vimeo') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Video Link') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="video_link" placeholder="{{ translate('Video Link') }}">
                                    <small class="text-muted">{{ translate("Use proper link without extra parameter. Don't use short share link/embeded iframe code.") }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card d-none">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Product Variation') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="{{ translate('Colors') }}" disabled>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control aiz-selectpicker" data-live-search="true" data-selected-text-format="count" name="colors[]" id="colors" multiple disabled>
                                        @foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
                                            <option value="{{ $color->code }}"
                                                    data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:{{ $color->code }}'></span><span>{{ $color->name }}</span></span>"></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input value="1" type="checkbox" name="colors_active">
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="{{ translate('Attributes') }}" disabled>
                                </div>
                                <div class="col-md-8">
                                    <select name="choice_attributes[]" id="choice_attributes" class="form-control aiz-selectpicker" data-selected-text-format="count" data-live-search="true" multiple
                                            data-placeholder="{{ translate('Choose Attributes') }}">
                                        @foreach (\App\Attribute::all() as $key => $attribute)
                                            <option value="{{ $attribute->id }}">{{ $attribute->getTranslation('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>
                                <br>
                            </div>

                            <div class="customer_choice_options" id="customer_choice_options">

                            </div>
                        </div>
                    </div>

                    <div class="card d-none">
                        <div class="card-header">
                            <!--h5 class="h6 mb-0">{{ translate('Product price + stock') }}</h5-->
                            <h5 class="h6 mb-0">{{ translate('Product price') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Unit price') }} <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Unit price') }}" name="unit_price" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label" for="start_date">{{ translate('Discount Date Range') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control aiz-date-range" name="date_range" placeholder="{{ translate('Select Date') }}" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to "
                                           autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Discount') }} <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Discount') }}" name="discount" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control aiz-selectpicker" name="discount_type">
                                        <option value="amount">{{ translate('Flat') }}</option>
                                        <option value="percent">{{ translate('Percent') }}</option>
                                    </select>
                                </div>
                            </div>

                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">
                                        {{ translate('Set Point') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="number" lang="en" min="0" value="0" step="1" placeholder="{{ translate('1') }}" name="earn_point" class="form-control">
                                    </div>
                                </div>
                            @endif

                            <div id="show-hide-div">
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{ translate('Quantity') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="number" lang="en" min="0" value="0" step="1" placeholder="{{ translate('Quantity') }}" name="current_stock" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">
                                        {{ translate('SKU') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="{{ translate('SKU') }}" name="sku" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="sku_combination" id="sku_combination">

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Product Description') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Description') }}</label>
                                <div class="col-md-8">
                                    <textarea class="aiz-text-editor" name="description" id="description"></textarea>
                                    <span style="color:red; font-weight:bold;" id="desc_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card d-none">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('SEO Meta Tags') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Meta Title') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="meta_title" placeholder="{{ translate('Meta Title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Description') }}</label>
                                <div class="col-md-8">
                                    <textarea name="meta_description" rows="8" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Meta Image') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="meta_img" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Specifications Start-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Product Specification') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Specification') }}</label>
                                <div class="col-md-8">
                                    <textarea class="aiz-text-editor" id="specification" name="specification"></textarea>
                                    <span style="color:red; font-weight:bold;" id="spec_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Specifications End-->

                    <!--Price Code Start-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">Pricing codes for the product.</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="form-label pt-1" for="state" style="font-size:0.75rem;">Select Price Codes</label>
                                <select class="form-control" name="shade_code" id="shade_code" required>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--Price Code End-->

                    <!--Active Start-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">Is product active?</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row form-check pl-5">
                                <input type="checkbox" class="form-check-input" value="Active" id="state" name="state">
                                <label class="form-check-label pt-1" for="state" style="font-size:0.75rem;">Active</label>
                            </div>
                        </div>
                    </div>
                    <!--Active End-->
                </div>

                <div class="col-lg-4 d-none">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">
                                {{ translate('Shipping Configuration') }}
                            </h5>
                        </div>

                        <div class="card-body">
                            @if (get_setting('shipping_type') == 'product_wise_shipping')
                                <div class="form-group row">
                                    <label class="col-md-6 col-from-label">{{ translate('Free Shipping') }}</label>
                                    <div class="col-md-6">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="radio" name="shipping_type" value="free" checked>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-6 col-from-label">{{ translate('Flat Rate') }}</label>
                                    <div class="col-md-6">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="radio" name="shipping_type" value="flat_rate">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="flat_rate_shipping_div" style="display: none">
                                    <div class="form-group row">
                                        <label class="col-md-6 col-from-label">{{ translate('Shipping cost') }}</label>
                                        <div class="col-md-6">
                                            <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Shipping cost') }}" name="flat_shipping_cost" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-6 col-from-label">{{ translate('Is Product Quantity Mulitiply') }}</label>
                                    <div class="col-md-6">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="checkbox" name="is_quantity_multiplied" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            @else
                                <p>
                                    {{ translate('Product wise shipping cost is disable. Shipping cost is configured from here') }}
                                    <a href="{{ route('shipping_configuration.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index', 'shipping_configuration.edit', 'shipping_configuration.update']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Shipping Configuration') }}</span>
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Low Stock Quantity Warning') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">
                                    {{ translate('Quantity') }}
                                </label>
                                <input type="number" name="low_stock_quantity" value="1" min="0" step="1" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">
                                {{ translate('Stock Visibility State') }}
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{ translate('Show Stock Quantity') }}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="radio" name="stock_visibility_state" value="quantity" checked>
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{ translate('Show Stock With Text Only') }}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="radio" name="stock_visibility_state" value="text">
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{ translate('Hide Stock') }}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="radio" name="stock_visibility_state" value="hide">
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Cash On Delivery') }}</h5>
                        </div>
                        <div class="card-body">
                            @if (get_setting('cash_payment') == '1')
                                <div class="form-group row">
                                    <label class="col-md-6 col-from-label">{{ translate('Status') }}</label>
                                    <div class="col-md-6">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="checkbox" name="cash_on_delivery" value="1" checked="">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            @else
                                <p>
                                    {{ translate('Cash On Delivery option is disabled. Activate this feature from here') }}
                                    <a href="{{ route('activation.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index', 'shipping_configuration.edit', 'shipping_configuration.update']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Cash Payment Activation') }}</span>
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Featured') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{ translate('Status') }}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" name="featured" value="1">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Todays Deal') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{ translate('Status') }}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" name="todays_deal" value="1">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Flash Deal') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">
                                    {{ translate('Add To Flash') }}
                                </label>
                                <select class="form-control aiz-selectpicker" name="flash_deal_id" id="flash_deal">
                                    <option value="">Choose Flash Title</option>
                                    @foreach (\App\FlashDeal::where('status', 1)->get() as $flash_deal)
                                        <option value="{{ $flash_deal->id }}">
                                            {{ $flash_deal->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">
                                    {{ translate('Discount') }}
                                </label>
                                <input type="number" name="flash_discount" value="0" min="0" step="1" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">
                                    {{ translate('Discount Type') }}
                                </label>
                                <select class="form-control aiz-selectpicker" name="flash_discount_type" id="flash_discount_type">
                                    <option value="">Choose Discount Type</option>
                                    <option value="amount">{{ translate('Flat') }}</option>
                                    <option value="percent">{{ translate('Percent') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('Estimate Shipping Time') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">
                                    {{ translate('Shipping Days') }}
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="est_shipping_days" min="1" step="1" placeholder="{{ translate('Shipping Days') }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">{{ translate('Days') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ translate('VAT & Tax') }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach (\App\Tax::where('tax_status', 1)->get() as $tax)
                                <label for="name">
                                    {{ $tax->name }}
                                    <!--input type="hidden" value="{{ $tax->id }}" name="tax_id[]"-->
                                </label>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select class="form-control aiz-selectpicker" name="tax_type[]">
                                            <option value="amount">{{ translate('Flat') }}</option>
                                            <option value="percent">{{ translate('Percent') }}</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="Second group">
                            <button type="submit" name="button" id="submitbtn" value="publish" class="btn btn-success">{{ translate('Save & Publish') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Add Fabric Modal -->
    <div class="modal fade" id="addFabricModal" tabindex="-1" role="dialog" aria-labelledby="addFabricModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFabricModalLabel">Add New Fabric</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addfabricform" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label class="from-label">Name</label>
                        <input type="text" class="form-control mb-3" name="fabric_name" id="fabric_name" style="" placeholder="Fabric Name" required />
                        <label class="from-label">Image</label>
                        <input type="file" class="form-control mb-3" name="fabric_img" id="fabric_img" style="" required />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ static_asset('assets/js/multiselect/bootstrap-multiselect.min.js') }}"></script>

    <script type="text/javascript">
        var fabricsInjectedData = @json($fabrics);
        var cassettesInjectedData = @json($cassettes);
        var shadeCodesInjectedData = @json($shade_codes);

        $(document).ready(function() {
            $('#fabric').multiselect({
                maxHeight: 300,
                nonSelectedText: 'No Fabric Present. Choose Category',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for Fabric',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            });
            $('#cassette').multiselect({
                maxHeight: 300,
                nonSelectedText: 'No Cassette Present. Choose Category',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for Cassette',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            })
            //mount
            $('#mount').multiselect({
                maxHeight: 300,
                checkboxName: function(option) {
                    return 'mount[]';
                },
                nonSelectedText: 'Choose mount',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for mount',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            });
            $('#bracket').multiselect({
                maxHeight: 300,
                checkboxName: function(option) {
                    return 'bracket[]';
                },
                nonSelectedText: 'Choose bracket',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for bracket',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            });
            $('#springassist').multiselect({
                maxHeight: 300,
                checkboxName: function(option) {
                    return 'springassist[]';
                },
                nonSelectedText: 'Choose springassist',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for springassist',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            });
            $('#roomtype').multiselect({
                maxHeight: 300,
                checkboxName: function(option) {
                    return 'roomtype[]';
                },
                nonSelectedText: 'Choose roomtype',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for roomtype',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            });
            $('#stack').multiselect({
                maxHeight: 300,
                checkboxName: function(option) {
                    return 'stack[]';
                },
                nonSelectedText: 'Choose stack',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for stack',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            });
            $('#ct_manual').multiselect({
                maxHeight: 300,
                checkboxName: function(option) {
                    return 'ct_manual[]';
                },
                nonSelectedText: 'Choose control type',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for control type',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            });
            $('#ct_motor').multiselect({
                maxHeight: 300,
                checkboxName: function(option) {
                    return 'ct_motor[]';
                },
                nonSelectedText: 'Choose Motor Control Type',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for Motor Control Type',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            });
            $('#wand').multiselect({
                maxHeight: 300,
                checkboxName: function(option) {
                    return 'wand[]';
                },
                nonSelectedText: 'Choose wand',
                allSelectedText: 'All Selected',
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for wand',
                includeResetOption: true,
                includeResetDivider: true,
                resetText: "Reset",
                width: "100%"
            });

        });

        $('form').bind('submit', function(e) {
            // Disable the submit button while evaluating if the form should be submitted
            $("button[type='submit']").prop('disabled', true);

            var valid = true;

            if ($('#description').val() == '') {
                $('#desc_err').text('Description is required.');
                valid = false;
            } else {
                $('#desc_err').text('');
            }
            if ($('#specification').val() == '') {
                $('#spec_err').text('Specification is required.');
                valid = false;
            } else {
                $('#spec_err').text('');
            }
            // if ($('input[name=thumbnail_img]').val() == '') {
            //     $('#img_err').text('Image is required.');
            //     valid=false;
            // }else {
            //     $('#img_err').text('');
            // }

            if (!valid) {
                e.preventDefault();

                // Reactivate the button if the form was not submitted
                // $("button[type='submit']").button.prop('disabled', false);
                $('#submitbtn').prop('disabled', false);
            }
        });

        $("[name=shipping_type]").on("change", function() {
            $(".flat_rate_shipping_div").hide();

            if ($(this).val() == 'flat_rate') {
                $(".flat_rate_shipping_div").show();
            }

        });

        function add_more_customer_choice_option(i, name) {
            /*$.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url:'{{ route('products.add-more-choice-option') }}',
                    data:{
                       attribute_id: i
                    },
                    success: function(data) {
                        var obj = JSON.parse(data);
                        $('#customer_choice_options').append('\
                        <div class="form-group row">\
                            <div class="col-md-3">\
                                <input type="hidden" name="choice_no[]" value="'+i+'">\
                                <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="{{ translate('Choice Title') }}" readonly>\
                            </div>\
                            <div class="col-md-8">\
                                <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" multiple>\
                                    '+obj+'\
                                </select>\
                            </div>\
                        </div>');
                        AIZ.plugins.bootstrapSelect('refresh');
                   }
               });*/


        }

        $('input[name="colors_active"]').on('change', function() {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors').prop('disabled', true);
                AIZ.plugins.bootstrapSelect('refresh');
            } else {
                $('#colors').prop('disabled', false);
                AIZ.plugins.bootstrapSelect('refresh');
            }
            update_sku();
        });

        $(document).on("change", ".attribute_choice", function() {
            update_sku();
        });

        $('#colors').on('change', function() {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function() {
            update_sku();
        });

        $('input[name="name"]').on('keyup', function() {
            update_sku();
        });

        function delete_row(em) {
            $(em).closest('.form-group row').remove();
            update_sku();
        }

        function delete_variant(em) {
            $(em).closest('.variant').remove();
        }

        function update_sku() {
            $.ajax({
                type: "POST",
                url: '{{ route('products.sku_combination') }}',
                data: $('#choice_form').serialize(),
                success: function(data) {
                    $('#sku_combination').html(data);
                    AIZ.uploader.previewGenerate();
                    AIZ.plugins.fooTable();
                    if (data.length > 1) {
                        $('#show-hide-div').hide();
                    } else {
                        $('#show-hide-div').show();
                    }
                }
            });
        }

        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function() {
                add_more_customer_choice_option($(this).val(), $(this).text());
            });

            update_sku();
        });

        //show/hide options in cassette depending on category
        $('#category_id').change(function() {
            let data = [];
            var parent_cat = $('#category_id option:selected').data("parent");
            if (parent_cat) {
                cassettesInjectedData.forEach(cassette => {
                    if (cassette.category_id == parent_cat) {
                        data.push({
                            label: cassette.name,
                            title: cassette.name,
                            value: cassette.cassette_code,
                            selected: false
                        });
                    }
                });
            }
            //cassette
            if (data.length > 0) {

                $('#cassette').multiselect('dataprovider', data);

                $('#cassette').multiselect('setOptions', {
                    maxHeight: 300,
                    checkboxName: function(option) {
                        return 'cassettes[]';
                    },
                    nonSelectedText: 'Choose cassettes',
                    allSelectedText: 'All Selected',
                    includeSelectAllOption: true,
                    enableCaseInsensitiveFiltering: true,
                    filterPlaceholder: 'Search for cassettes',
                    includeResetOption: true,
                    includeResetDivider: true,
                    resetText: "Reset",
                    width: "100%"
                });
                $('#cassette').multiselect('rebuild');
            } else {
                $('#cassette').multiselect('dataprovider', data);

                $('#cassette').multiselect('setOptions', {
                    maxHeight: 300,
                    nonSelectedText: 'No cassettes present for selected category',
                    allSelectedText: 'All Selected',
                    includeSelectAllOption: true,
                    enableCaseInsensitiveFiltering: true,
                    filterPlaceholder: 'Search for cassettes',
                    includeResetOption: true,
                    includeResetDivider: true,
                    resetText: "Reset",
                    width: "100%"
                });
                $('#cassette').multiselect('rebuild');
            }

        });

        //show/hide options in fabric depending on category
        $('#category_id').change(function() {
            let data = [];
            var parent_cat = $('#category_id option:selected').val();
            if (parent_cat) {
                fabricsInjectedData.forEach(fabric => {
                    if (fabric.shade_subcat == parent_cat) {
                        data.push({
                            label: fabric.name,
                            title: fabric.name,
                            value: fabric.id,
                            selected: false
                        });
                    }
                });
            }
            if (data.length > 0) {

                $('#fabric').multiselect('dataprovider', data);

                $('#fabric').multiselect('setOptions', {
                    maxHeight: 300,
                    checkboxName: function(option) {
                        return 'fabric[]';
                    },
                    nonSelectedText: 'Choose Fabric',
                    allSelectedText: 'All Selected',
                    includeSelectAllOption: true,
                    enableCaseInsensitiveFiltering: true,
                    filterPlaceholder: 'Search for Fabric',
                    includeResetOption: true,
                    includeResetDivider: true,
                    resetText: "Reset",
                    width: "100%"
                });
                $('#fabric').multiselect('rebuild');
            } else {
                $('#fabric').multiselect('dataprovider', data);

                $('#fabric').multiselect('setOptions', {
                    maxHeight: 300,
                    nonSelectedText: 'No fabric present for selected category',
                    allSelectedText: 'All Selected',
                    includeSelectAllOption: true,
                    enableCaseInsensitiveFiltering: true,
                    filterPlaceholder: 'Search for Fabric',
                    includeResetOption: true,
                    includeResetDivider: true,
                    resetText: "Reset",
                    width: "100%"
                });
                $('#fabric').multiselect('rebuild');
            }


        });
        //show/hide options in shade depending on category
        $('#category_id').change(function() {
            let dataInnerHtml = '';
            var parent_cat = $('#category_id option:selected').data("parent");
            if (parent_cat) {
                shadeCodesInjectedData.forEach(shade => {
                    if (shade.cat_id == parent_cat) {
                        dataInnerHtml += `
                            <option value="${shade.shade_code}"> ${shade.shade_code} </option>
                        `;
                    }
                });
                $("#shade_code").html(dataInnerHtml);
            } else {
                $("#shade_code").html('');
            }


        });

        $("#addfabricform").on('submit', (function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/prod_add_fabric') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    fabricsInjectedData.push(data);
                },
                error: function() {}
            });
        }));
    </script>
@endsection
