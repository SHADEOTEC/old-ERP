@extends('backend.layouts.app')

@section('content')

    @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ $error }}</strong> You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach 

    <div class="aiz-titlebar mt-2 mb-2">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Edit Order Product') }}</h1>
            </div>
        </div>
    </div>

    <form action="#" method="post">

        <div class="row gutters-5 single-product" id="product-{{ $product->id }}">
            <div class="col-lg-8">
                <input name="_method" type="hidden" value="POST">
                <input type="hidden" name="lang" value="{{ $lang }}">
                <input type="hidden" name="id" id="id" value="{{ $product->id }}">
                <input type="hidden" id="price_tag_id" name="price_tag_id" value="{{ $product->category->price_tag }}">
                <input type="hidden" id="disc_percent" name="disc_percent" value="{{ $cust_discount ? $cust_discount->disc_percent : '' }}">
                @csrf
                <input type="hidden" name="added_by" value="seller">
                <!-- Product Info Card -->
                <div class="card pt-4">
                    <!--div class="d-flex justify-content-center align-items-start"-->
                    <div class="d-flex align-items-start pl-3">
                        <div>
                            <!-- <img src="{{ url('assets/img/products') . '/' . $product->thumbnail_img }}" width="250px" class="img-fluid"/> -->
                            <img src="{{ static_asset('products/images/') . '/' . $product->thumbnail_img }}" id="main_img" width="235px" height="200px" class="" />
                        </div>
                        <div class="pr-2 pl-2 pb-2 pt-0">
                            <p class="font-weight-bold" name="product_name" id="product_name">{{ $product->name }}</p>
                            <p class="font-weight-bold">Description</p>
                            <p class="font-weight-lighter" id="shade_desc">{{ strip_tags($product->description) }}</p>
                            <button type="button" class="btn btn-sm btn-outline-primary d-block" data-toggle="modal" data-target="#exampleModalLong">
                                Specification
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="d-inline pt-2 pb-2">Product Details</h6>
                        <div class="form-group row mb-4">
                            <div class="col-12 col-md-6 col-lg-6 pt-2">
                                <label for="">Dealer Name</label>
                                <input type="text" class="form-control" name="dealer_name" id="dealer_name" placeholder="Valid full name is required." value="{{ $seller->name }}" readonly>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 pt-2">
                                <label for="">Customer Side Mark</label>
                                <input type="text" class="form-control" name="cust_side_mark" id="cust_side_mark"
                                       @if (isset($cust_discount->cs_mark)) value="{{ $cust_discount->cs_mark }}"
                            @else
                                value="" @endif readonly placeholder="">
                            </div>

                            <div class="col-6 col-md-6 col-lg-6 pt-2">
                                <label for="">Invoice Number</label>
                                <input type="text" class="form-control" name="inv_num" id="inv_num" value="{{ $main_order->order_no }}" required readonly>
                                <input type="text" class="form-control hide" style="display: none" name="order_number" id="order_number" placeholder="" required value="{{ $main_order->order_no }}" readonly>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6 pt-2">
                                <label for="">Order Date</label>
                                <input type="text" class="form-control" value="{{ $order->date }}" required readonly>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="accordion" id="add_to_cart">
                    <!-- ROOM TYPE -->
                    <div class="card">
                        <div class="card-header p-2" id="room" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block collapsed text-left" type="button">
                                    ROOM TYPE
                                </button>
                            </h2>
                        </div>
                        <div id="collapseEleven" class="collapse" aria-labelledby="room" data-parent="#add_to_cart">
                            <div class="card-body">
                                <div class="form-group row mb-3">
                                    <div class="col-12 col-md-12 col-lg-12 pt-2">
                                        <select class="form-control" name="room_type" id="room_type" required>
                                            <option value="">Select Room Type</option>
                                            @foreach ($roomtype as $item)
                                                @if ($item->xztroomtype->state == 'Active')
                                                    <option value="{{ $item->roomtype_id }}" @if ($order->room_type == $item->xztroomtype->name) selected @endif>{{ $item->xztroomtype->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-12 col-md-12 col-lg-12 pt-2">
                                        <label for="window_desc" class="hide">Window Description</label>
                                        <input type="text" class="form-control hide" id="window_desc" name="window_desc">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Quantity and Measurements   -->
                    <div class="card">
                        <div class="card-header p-2" id="qty_measure" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block collapsed text-left" type="button">
                                    QUANTITY & MEASUREMENTS
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="qty_measure" data-parent="#add_to_cart">
                            <div class="card-body">
                                <div class="form-group row mb-3">
                                    <div class="col-12 col-md-4 col-lg-4 pt-2">
                                        <label for="">Quantity</label>
                                        <select class="form-control" name="quantity" id="quantity" required>
                                            <option value="">Select Quantity</option>
                                            <option value="1" @if ($order->quantity == '1') selected @endif>1</option>
                                            <option value="2" @if ($order->quantity == '2') selected @endif>2</option>
                                            <option value="3" @if ($order->quantity == '3') selected @endif>3</option>
                                            <option value="4" @if ($order->quantity == '4') selected @endif>4</option>
                                            <option value="5" @if ($order->quantity == '5') selected @endif>5</option>
                                            <option value="6" @if ($order->quantity == '6') selected @endif>6</option>
                                            <option value="7" @if ($order->quantity == '7') selected @endif>7</option>
                                            <option value="8" @if ($order->quantity == '8') selected @endif>8</option>
                                            <option value="9" @if ($order->quantity == '9') selected @endif>9</option>
                                            <option value="10" @if ($order->quantity == '10') selected @endif>10</option>
                                        </select>
                                        <!-- <input type="text" class="form-control" placeholder="" name="quantity" id="quantity" required> -->
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-4 pt-2">
                                        <label for="">Width</label>
                                        <div class="d-flex mb-3 flex-row">
                                            <div class="flex-fill" style="width:60%">
                                                <select class="form-control calc_prices fabric-min-max-width-changes get_fts_prices @if (isset($ct_wid_motors) && !empty($ct_wid_motors)) wm_price @endif" name="width" id="width" required
                                                        style="font-size:13px;">
                                                    <option value="">Select Width</option>
                                                    @foreach ($distinct_wid as $key => $item)
                                                        @if ($key == 0)
                                                            @for ($j = 12; $j < $item->width; $j++)
                                                                <option data-price={{ $item->width }} @if ($j == $order->width) selected @endif value="{{ $j }}">{{ $j }}</option>
                                                            @endfor
                                                        @endif
                                                        <?php $i = 0; ?>
                                                        <option data-price={{ $item->width }} @if ($item->width == $order->width) selected @endif value="{{ $item->width }}">{{ $item->width }}</option>
                                                        @while (isset($distinct_wid[$key + 1]) && $distinct_wid[$key + 1]->width != $item->width + ++$i)
                                                            <option data-price={{ $distinct_wid[$key + 1]->width }} @if ($item->width + $i == $order->width) selected @endif value="{{ $item->width + $i }}">{{ $item->width + $i }}</option>
                                                        @endwhile
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex-fill" style="width:40%">
                                                <select class="form-control calc_prices get_fts_prices @if (isset($ct_wid_motors) && !empty($ct_wid_motors)) wm_price @endif" name="wid_decimal" id="wid_decimal" style="font-size:13px;padding-inline:3px;">
                                                    <option @if ($order->width_decimal == '0') selected @endif value="0">Even</option>
                                                    <option @if ($order->width_decimal == '0.125') selected @endif value="0.125">1/8</option>
                                                    <option @if ($order->width_decimal == '0.25') selected @endif value="0.25">1/4</option>
                                                    <option @if ($order->width_decimal == '0.375') selected @endif value="0.375">3/8</option>
                                                    <option @if ($order->width_decimal == '0.5') selected @endif value="0.5">1/2</option>
                                                    <option @if ($order->width_decimal == '0.625') selected @endif value="0.625">5/8</option>
                                                    <option @if ($order->width_decimal == '0.75') selected @endif value="0.75">3/4</option>
                                                    <option @if ($order->width_decimal == '0.875') selected @endif value="0.875">7/8</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 pt-2">
                                        <label for="">Length</label>
                                        <div class="d-flex mb-3 flex-row">
                                            <div class="flex-fill" style="width:60%">
                                                <select class="form-control calc_prices get_fts_prices @if (isset($ct_wid_motors) && !empty($ct_wid_motors)) wm_price @endif" name="length" id="length" required style="font-size:13px;">
                                                    <option value="">Select Length</option>
                                                    @foreach ($distinct_len as $key => $item)
                                                        @if ($key == 0)
                                                            @for ($j = 12; $j < $item->length; $j++)
                                                                <option data-price={{ $item->length }} @if ($order->length == $j) selected @endif value="{{ $j }}">{{ $j }}</option>
                                                            @endfor
                                                        @endif
                                                        <?php $i = 0; ?>
                                                        <option data-price={{ $item->length }} @if ($order->length == $item->length) selected @endif value="{{ $item->length }}">{{ $item->length }}</option>
                                                        @while (isset($distinct_len[$key + 1]) && $distinct_len[$key + 1]->length != $item->length + ++$i)
                                                            <option data-price={{ $distinct_len[$key + 1]->length }} @if ($order->length == $item->length + $i) selected @endif value="{{ $item->length + $i }}">{{ $item->length + $i }}</option>
                                                        @endwhile
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex-fill" style="width:40%">
                                                <select class="form-control calc_prices get_fts_prices @if (isset($ct_wid_motors) && !empty($ct_wid_motors)) wm_price @endif" name="len_decimal" id="len_decimal" style="font-size:13px;padding-inline:3px;">
                                                    <option @if ($order->length_decimal == '0') selected @endif value="0">Even</option>
                                                    <option @if ($order->length_decimal == '0.125') selected @endif value="0.125">1/8</option>
                                                    <option @if ($order->length_decimal == '0.25') selected @endif value="0.25">1/4</option>
                                                    <option @if ($order->length_decimal == '0.375') selected @endif value="0.375">3/8</option>
                                                    <option @if ($order->length_decimal == '0.5') selected @endif value="0.5">1/2</option>
                                                    <option @if ($order->length_decimal == '0.625') selected @endif value="0.625">5/8</option>
                                                    <option @if ($order->length_decimal == '0.75') selected @endif value="0.75">3/4</option>
                                                    <option @if ($order->length_decimal == '0.875') selected @endif value="0.875">7/8</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Control Type Control -->
                    <div class="card">
                        <div class="card-header p-2" id="Control Type" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block collapsed text-left" type="button">
                                    CONTROL TYPE
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="Control Type" data-parent="#add_to_cart">
                            <div class="card-body">
                                <div class="form-group row mb-1">
                                    <div class="col-12 col-md-12 col-lg-12 pt-2">
                                        <div class="form-check d-inline mr-2">
                                            <input class="form-check-input" type="radio" name="controltype" id="motorization" value="motor" @if ($order->control_type == 'motor') checked @endif>
                                            <label class="form-check-label" for="motorization">
                                                Motorization
                                            </label>
                                        </div>
                                        <div class="form-check d-inline mr-2">
                                            <input class="form-check-input" type="radio" name="controltype" id="manual" value="manual" @if ($order->control_type == 'manual') checked @endif>
                                            <label class="form-check-label" for="manual">
                                                Manual
                                            </label>
                                        </div>
                                        <!-- Motorization Radio Select-->
                                        <div class="mt-3 mb-3">
                                            <p class="form-check-label hide" for="motorization" id="control_type_hdng" style="color:#e62e04;">
                                                Control Type
                                            </p>
                                        </div>
                                        <select class="form-control hide mb-3 mt-3" name="motor_pos" id="motor_pos">
                                            <option value="">Select your Motor Position</option>
                                            <option @if ($order->motor_pos == 'Default') selected @endif value="Default">Default</option>
                                            <option @if ($order->motor_pos == 'Right') selected @endif value="Right">Right</option>
                                            <option @if ($order->motor_pos == 'Left') selected @endif value="Left">Left</option>
                                        </select>
                                        <select class="form-control hide mb-3 mt-3" name="motor_type" id="motor_type">
                                            <option value="">Select your Motor type</option>
                                            @foreach ($ct_motors as $item)
                                                @if ($item->motor->state == 'Active')
                                                    <option @if ($order->motor_name == $item->motor->name) selected @endif value="{{ $item->motor->price }}" data-motor-price={{ $item->motor->ct_code }}>{{ $item->motor->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="motor_name" id="motor_name" value="">
                                        <!-- Sub lists -->
                                        <select class="form-control hide mb-3 mt-3" name="shad_wand_len" id="shad_wand_len">
                                            <option value="">Select wand length</option>
                                            <option @if ($order->shad_wand_len == '1ft') selected @endif value="1ft">1ft</option>
                                            <option @if ($order->shad_wand_len == '2ft') selected @endif value="2ft">2ft</option>
                                            <option @if ($order->shad_wand_len == '3ft') selected @endif value="3ft">3ft</option>
                                            <option @if ($order->shad_wand_len == '4ft') selected @endif value="4ft">4ft</option>
                                            <option @if ($order->shad_wand_len == '5ft') selected @endif value="5ft">5ft</option>
                                        </select>
                                        <select class="form-control hide mb-3 mt-3" name="shad_wand_side" id="shad_wand_side">
                                            <option value="">Select control side</option>
                                            <option @if ($order->shad_wand_side == 'Right') selected @endif value="Right">Right</option>
                                            <option @if ($order->shad_wand_side == 'Left') selected @endif value="Left">Left</option>
                                        </select>
                                        <select class="form-control hide mb-3 mt-3" name="motor_cntrl" id="motor_cntrl">
                                            <option value="">Select your Remote</option>
                                            <option @if ($order->remote_ctrl_price == '30') selected @endif value="30">1 Channel</option>
                                            <option @if ($order->remote_ctrl_price == '33') selected @endif value="33">2 Channel</option>
                                            <option @if ($order->remote_ctrl_price == '35') selected @endif value="35">5 Channel</option>
                                            <option @if ($order->remote_ctrl_price == '40') selected @endif value="40">15 Channel</option>
                                        </select>
                                        <input type="text" class="form-control col-12 hide" id="channel_guideline" placeholder="Programming Instructions" name="channel_guideline" />
                                        <input type="hidden" id="remote_ctrl_channel" name="remote_ctrl_channel" value="">

                                        <!-- Sub list -> Somfy -->
                                        <select class="form-control hide mb-3 mt-3" name="somfy_list" id="somfy_list">
                                            <option value="">Select Somfy Upgrade</option>
                                            <option value="130">RF Remote Control-1Channel</option>
                                            <option value="165">RF Remote Control-5Channel</option>
                                            <option value="575">RF Remote Control-16Channel</option>
                                            <option value="245">RF Remote Control-Telis Modulis 1Channel</option>
                                            <option value="295">RF Remote Control-Telis Modulis 5Channel</option>
                                            <option value="325">RF Wireless Wall Switch-1Channel</option>
                                            <option value="325">RF Wireless Wall Switch-5Channel</option>
                                            <option value="510">Programmable Timer-1Channel</option>
                                            <option value="170">Smoove1 RTS</option>
                                            <option value="145">myLink RTS Interface</option>
                                            <option value="145">RF Transformer</option>
                                        </select>
                                        <input type="hidden" id="somfy_upgrade_name" name="somfy_upgrade_name" value="">

                                        <!-- Manual Radio Select-->
                                        <select class="form-control hide mb-3 mt-3" name="manual_sel" id="manual_sel">
                                            <option value="">Select chain/cord</option>
                                            <option @if ($order->chain_cord == 'Chain') selected @endif>Chain</option>
                                            <option @if ($order->chain_cord == 'Cord') selected @endif>Cord</option>
                                        </select>

                                        <div class="chain_color_box hide">
                                            <label class="form-check-label pt-1" for="" style="color:#e62e04;">Color</label>
                                        </div>
                                        <div class="col-4 chain_color_box hide mt-2 mb-2 pl-4">
                                            <input type="checkbox" class="form-check-input chain_colors" @if ($order->chain_color == 'White') checked @endif value="White" id="chain_white" name="chaincolor_arr">
                                            <label class="form-check-label pt-1" for="chain_white" style="font-size:0.75rem;">White</label>
                                        </div>
                                        <div class="chain_color_box hide mb-2 pl-4">
                                            <input type="checkbox" class="form-check-input chain_colors" @if ($order->chain_color == 'Black') checked @endif value="Black" id="chain_black" name="chaincolor_arr">
                                            <label class="form-check-label pt-1" for="chain_black" style="font-size:0.75rem;">Black</label>
                                        </div>
                                        <div class="chain_color_box hide mb-2 pl-4">
                                            <input type="checkbox" class="form-check-input chain_colors" @if ($order->chain_color == 'Steel') checked @endif value="Steel" id="chain_steel" name="chaincolor_arr">
                                            <label class="form-check-label pt-1" for="chain_steel" style="font-size:0.75rem;">Steel</label>
                                        </div>

                                        <div class="cord_color_box hide">
                                            <label class="form-check-label pt-1" for="" style="color:#e62e04;">Color</label>
                                        </div>
                                        <div class="cord_color_box hide mb-2 pl-4">
                                            <input type="checkbox" class="form-check-input cord_colors" @if ($order->cord_color == 'Default') checked @endif value="Default" id="cord_default" name="cordcolor_arr">
                                            <label class="form-check-label pt-1" for="cord_default" style="font-size:0.75rem;">Default</label>
                                        </div>
                                        <div class="cord_color_box hide mt-2 mb-2 pl-4">
                                            <input type="checkbox" class="form-check-input cord_colors" @if ($order->cord_color == 'White') checked @endif value="White" id="cord_white" name="cordcolor_arr">
                                            <label class="form-check-label pt-1" for="cord_white" style="font-size:0.75rem;">White</label>
                                        </div>
                                        <div class="cord_color_box hide mb-2 pl-4">
                                            <input type="checkbox" class="form-check-input cord_colors" @if ($order->cord_color == 'Grey') checked @endif value="Grey" id="cord_grey" name="cordcolor_arr">
                                            <label class="form-check-label pt-1" for="cord_grey" style="font-size:0.75rem;">Grey</label>
                                        </div>
                                        <div class="cord_color_box hide mb-2 pl-4">
                                            <input type="checkbox" class="form-check-input cord_colors" @if ($order->cord_color == 'Beige') checked @endif value="Beige" id="cord_beige" name="cordcolor_arr">
                                            <label class="form-check-label pt-1" for="cord_beige" style="font-size:0.75rem;">Beige</label>
                                        </div>
                                        <div class="cord_color_box hide mb-2 pl-4">
                                            <input type="checkbox" class="form-check-input cord_colors" @if ($order->cord_color == 'Black') checked @endif value="Black" id="cord_black" name="cordcolor_arr">
                                            <label class="form-check-label pt-1" for="cord_black" style="font-size:0.75rem;">Black</label>
                                        </div>
                                        <div class="cord_color_box hide mb-2 pl-4">
                                            <input type="checkbox" class="form-check-input cord_colors" @if ($order->cord_color == 'Brown') checked @endif value="Brown" id="cord_brown" name="cordcolor_arr">
                                            <label class="form-check-label pt-1" for="cord_brown" style="font-size:0.75rem;">Brown</label>
                                        </div>

                                        <div class="mt-3 mb-3">
                                            <p class="form-check-label hide" for="motorization" id="manual_control_pos_hdng" style="color:#e62e04;">
                                                Control Position
                                            </p>
                                        </div>
                                        <select class="form-control hide mb-3 mt-3" name="chain_ctrl" id="chain_ctrl">
                                            <option value="">Select your chain control side</option>
                                            @foreach ($ct_manuals as $item)
                                                @if (stripos($item->manual->ct_code, 'chain') !== false)
                                                    <option value="{{ $item->manual->ct_code }}" data-man-img={{ $item->manual->image }} @if ($order->chain_ctrl == $item->manual->name) selected @endif>{{ $item->manual->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        <select class="form-control hide mb-3 mt-3" name="cord_ctrl" id="cord_ctrl">
                                            <option value="">Select your cord control side</option>
                                            @foreach ($ct_manuals as $item)
                                                @if (stripos($item->manual->ct_code, 'cord') !== false)
                                                    <option @if ($order->cord_ctrl == $item->manual->name) selected @endif value="{{ $item->manual->ct_code }}" data-man-img="{{ $item->manual->image }}">{{ $item->manual->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        <div class="row hide smart_opts ml-1 mb-2">
                                            <div class="col">
                                                <label class="form-check-label pt-1" for="plugin_charger" style="font-size:0.75rem;">Plugin Charger</label>
                                                <div>
                                                    <input type="radio" name="plugin_charger" class="smart_radios" value="35" @if ($order->plug_in_charger && $order->plug_in_charger == '35') checked @endif /> Yes
                                                    <input type="radio" name="plugin_charger" class="smart_radios" value="0" @if (!$order->plug_in_charger) checked @endif /> No
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row hide smart_opts ml-1 mb-2">
                                            <div class="col">
                                                <label class="form-check-label pt-1" for="solar_panel" style="font-size:0.75rem;">Solar Panel</label>
                                                <div>
                                                    <input type="radio" name="solar_panel" class="smart_radios" value="35" @if ($order->solar_panel && $order->solar_panel == '35') checked @endif /> Yes
                                                    <input type="radio" name="solar_panel" class="smart_radios" value="0" @if (!$order->solar_panel) checked @endif /> No
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row hide smart_opts ml-1 mb-2">
                                            <div class="col">
                                                <label class="form-check-label pt-1" for="shade_smart_hub" style="font-size:0.75rem;">Shade Smart Hub</label>
                                                <div>
                                                    <input type="radio" name="shade_smart_hub" class="smart_radios" value="175" @if ($order->shadoesmart_hub && $order->shadoesmart_hub == '175') checked @endif /> Yes
                                                    <input type="radio" name="shade_smart_hub" class="smart_radios" value="0" @if (!$order->shadoesmart_hub) checked @endif /> No
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row hide smart_opts ml-1 mb-2">
                                            <div class="col">
                                                <label class="form-check-label pt-1" for="shade_smart_transformers" style="font-size:0.75rem;">Shade Smart Transformers</label>
                                                <div>
                                                    <input type="radio" name="shade_smart_transformers" class="smart_radios" value="200" @if ($order->shadoesmart_transformer && $order->shadoesmart_transformer == '200') checked @endif /> Yes
                                                    <input type="radio" name="shade_smart_transformers" class="smart_radios"value="0" @if (!$order->shadoesmart_transformer) checked @endif /> No
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img id="chain_img" src="{{ asset('assets/img/chain/unnamed.jpg') }}" class="hide img-fluid" width="200px" />
                        </div>

                    </div>
                    <!-- Mount Types -->
                    <div class="card">
                        <div class="card-header p-2" id="m-type" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block collapsed text-left" type="button">
                                    MOUNT
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="m-type" data-parent="#add_to_cart">
                            <div class="card-body">
                                <div class="col-6 col-md-6 col-lg-6 d-none mb-3 pt-2">
                                    <img id="mount_pos_img" src="{{ static_asset('assets/img/mount/unnamed.jpg') }}" class="hide img-fluid mt-4" width="200px" />
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <select class="form-control" name="mount" id="mount" required>
                                        <option value="">Select Mount</option>
                                        @foreach ($mount as $item)
                                            @if ($item->xztmount->state == 'Active')
                                                <option data-mountimg={{ $item->xztmount->image }} @if ($order->mount_type == $item->xztmount->name) selected @endif value="{{ $item->xztmount->price }}">{{ $item->xztmount->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <input type="hidden" id="mount_type" name="mount_type" value="">
                                </div>
                                <div class="col-6 col-md-6 col-lg-6 mb-3 pt-2">
                                    <img id="mount_img" src="{{ static_asset('assets/img/mount/unnamed.jpg') }}" class="hide img-fluid mt-4" width="200px" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Fabric Selection -->
                    <div class="card">
                        <div class="card-header p-2" id="fab_sel" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block collapsed text-left" type="button">
                                    FABRIC SELECTION
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="fab_sel" data-parent="#add_to_cart">
                            <div class="card-body">
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <select class="form-control fabric-min-max-width-changes" name="fabric" id="fabric" required>
                                        <option value="">Select Fabric</option>
                                        @foreach ($fabric as $item)
                                            @if ($item->xztfabric->show_in_gallery == 'Yes')
                                                <option data-img="{{ $item->xztfabric->url }}" data-fabric-min-width="{{ $item->xztfabric->min_width }}" data-fabric-max-width="{{ $item->xztfabric->max_width }}"
                                                        data-fab-specs="{{ $item->xztfabric->fab_specs }}" @if ($order->fabric == $item->xztfabric->name) selected @endif value="{{ $item->fabric_id }}">
                                                    {{ $item->xztfabric->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="spinner-border hide m-5" role="status" id="img_spinner">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <img id="fabric_img" src="" class="hide mt-4" width="200px" height="200px" />
                                    <p id="fab_det" class="mt-4"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cassette Options -->
                    @php
                        $mainCategoryID = get_main_category_id($product->category_id);
                    @endphp
                    <div class="card">
                        <div class="card-header p-2" id="cas_opt" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block collapsed text-left" type="button">
                                    CASSETTE OPTIONS
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="cas_opt" data-parent="#add_to_cart">
                            <div class="card-body">
                                <div class="form-group row mb-3">
                                    <div class="col-12 col-md-6 col-lg-6 pt-2">
                                        <label for="">Cassette Type</label>
                                        <select data-cassette-type-price='0' data-stdcas-price='0' data-roundcas-price='0' class="form-control get_fts_prices" name="cassette_type" id="cassette_type" required>
                                            @if ($mainCategoryID == 3)
                                                <option value="Open Roller">Open Roller</option>
                                            @else
                                                <option value="">Select Cassette</option>
                                            @endif

                                            @foreach ($cassette as $item)
                                                @if ($item->xztcassette->state == 'Active')
                                                    <option value="{{ $item->xztcassette->cassette_code }}" @if ($order->cassette_type == $item->xztcassette->cassette_code) selected @endif data-cassette-id="{{ $item->xztcassette->id }}">{{ $item->xztcassette->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 pt-2">
                                        <label for="">Cassette Color</label>
                                        <select class="form-control" data-value="{{ $order->cassette_color }}" name="cassette_color" id="cassette_color" required>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($mainCategoryID == 3)
                        <div class="card">
                            <div class="card-header p-2" id="bot_rail" data-toggle="collapse" data-target="#collapseBottomRail" aria-expanded="false" aria-controls="collapseBottomRail">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block collapsed text-left" type="button">
                                        BOTTOM RAIL
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseBottomRail" class="collapse" aria-labelledby="bot_rail" data-parent="#add_to_cart">
                                <div class="card-body">
                                    <div class="form-group row mb-3">
                                        <div class="col-12 col-md-6 col-lg-6 pt-2">
                                            <label for="">Bottom Rail Type</label>
                                            <select class="form-control" name="bottom_rail" id="bottom_rail" required>
                                                <option data-price="0" value="">Select Bottom Rail</option>
                                                <option @if ($order->bottom_rail == 'Default') selected @endif data-price="0" value="Default">Default</option>
                                                <option @if ($order->bottom_rail == 'Hem Bar Wrapped') selected @endif data-price="85" value="Hem Bar Wrapped">Hem Bar Wrapped</option>
                                                <option @if ($order->bottom_rail == 'Sealed Wrapped') selected @endif data-price="65" value="Sealed Wrapped">Sealed Wrapped</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 pt-2">
                                            <label for="">Bottom Rail Color</label>
                                            <select class="form-control" data-color="{{ $order->bottom_rail_color }}" name="bottom_rail_color" id="bottom_rail_color" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header p-2" id="bot_rail" data-toggle="collapse" data-target="#collapseBottomRail" aria-expanded="false" aria-controls="collapseBottomRail">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block collapsed text-left" type="button">
                                        BOTTOM RAIL
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseBottomRail" class="collapse" aria-labelledby="bot_rail" data-parent="#add_to_cart">
                                <div class="card-body">
                                    <div class="form-group row mb-3">
                                        <div class="col-12 col-md-6 col-lg-6 pt-2">
                                            <label for="">Bottom Rail Type</label>
                                            <select class="form-control" name="bottom_rail" id="bottom_rail" required>
                                                <option data-price="0" value="">Select Bottom Rail</option>
                                                <option @if ($order->bottom_rail == 'Default') selected @endif data-price="0" value="Default">Default</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 pt-2">
                                            <label for="">Bottom Rail Color</label>
                                            <select class="form-control" data-color="{{ $order->bottom_rail_color }}" name="bottom_rail_color" id="bottom_rail_color" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Wrapped/Exposed -->
                    @if (isset($wrap) && !empty($wrap))
                        <div class="card">
                            <div class="card-header p-2" id="wrap-exp" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block collapsed text-left" type="button">
                                        WRAPPED/EXPOSED
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="wrap-exp" data-parent="#add_to_cart">
                                <div class="card-body">
                                    <div class="col-12 col-md-12 col-lg-12 pt-2">
                                        <select class="form-control get_fts_prices" name="wrap_expose" id="wrap_expose" required>
                                            <option value="">Select Wrapped/Exposed</option>
                                            <option @if ($order->wrap_exposed == '0') selected @endif value="0">Default</option>
                                            @if ($wrap->xztwrap->state == 'Active')
                                                <option value="{{ $wrap->xztwrap->wrap_code }}" @if ($order->wrap_exposed == $wrap->xztwrap->wrap_code) selected @endif>{{ $wrap->xztwrap->name }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Brackets -->
                    @if (isset($bracket) && count($bracket) > 0)
                        <div class="card">
                            <div class="card-header p-2" id="brkts" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block collapsed text-left" type="button">
                                        BRACKETS
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseEight" class="collapse" aria-labelledby="brkts" data-parent="#add_to_cart">
                                <div class="card-body">
                                    <div class="form-group row mb-3">
                                        <div class="col-12 col-md-6 col-lg-6 pt-2">
                                            <select class="form-control" name="brackets" id="brackets" required>
                                                <option value="">Select Bracket</option>
                                                @foreach ($bracket as $item)
                                                    @if ($item->xztbracket->state == 'Active')
                                                        <option value="{{ $item->id }}" @if ($order->brackets == $item->xztbracket->name) selected @endif data-bracketimg={{ $item->xztbracket->image }}>{{ $item->xztbracket->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-6 mb-3 pt-2">
                                        <img id="bracket_img" src="{{ static_asset('bracket/images/unnamed.jpg') }}" class="hide img-fluid mt-4" width="200px" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Brackets Options-->
                    @if ($shade_opt->bracket_options)
                        @php
                            $brkt_opt_chk = 1;
                        @endphp
                        <div class="card hide" id="brktsoptcard">
                            <div class="card-header p-2" id="brktsopt" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block collapsed text-left" type="button">
                                        BRACKETS OPTIONS
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThirteen" class="collapse" aria-labelledby="brkts" data-parent="#add_to_cart">
                                <div class="card-body">
                                    <div class="form-group row mb-3">
                                        <div class="col-12 col-md-6 col-lg-6 pt-2">
                                            <select class="form-control hide" name="brackets_opt" id="brackets_opt">
                                                <option value="">Select Bracket Options</option>
                                                <option value="44" @if ($order->bracket_option_name == 'Dual Brackets') selected @endif>Dual Brackets</option>
                                                <!-- <option value="76">Intermediate Breackets</option>
                                                                                                                                                           <option value="76">Center Support Breackets</option> -->
                                            </select>
                                        </div>
                                        <input type="hidden" id="brackets_opt_name" name="brackets_opt_name" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Stack Options-->
                    @if (isset($stack) && count($stack) > 0)
                        <div class="card" id="stackcard">
                            <div class="card-header p-2" id="stackhdr" data-toggle="collapse" data-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block collapsed text-left" type="button">
                                        STACKS
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFifteen" class="collapse" aria-labelledby="stackhdr" data-parent="#add_to_cart">
                                <div class="card-body">
                                    <div class="form-group row mb-3">
                                        <div class="col-12 col-md-12 col-lg-12 pt-2">
                                            <select class="form-control" name="stack" id="stack" required>
                                                <option value="">Select Stack</option>
                                                @foreach ($stack as $item)
                                                    @if ($item->xztstack->state == 'Active')
                                                        <option data-stack-img={{ $item->xztstack->image }} value="{{ $item->id }}">{{ $item->xztstack->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <img id="stack_img" src="{{ asset('stack/images/unnamed.jpg') }}" class="hide img-fluid mt-4 pl-3" width="200px" />
                                        <!--input type="hidden" id="brackets_opt_name" name="brackets_opt_name" value=""-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Spring Assist -->
                    @if (isset($springassist) && count($springassist) > 0)
                        @php
                            $sa_check = 1;
                        @endphp
                        <div class="card hide" id="sp_card">
                            <div class="card-header p-2" id="sp_assist" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block collapsed text-left" type="button">
                                        SPRING ASSIST
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTen" class="collapse" aria-labelledby="sp_assist" data-parent="#add_to_cart">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="form-group form-check pl-5">
                                            <input type="checkbox" class="form-check-input" value="90" id="spring_chk">
                                            <label class="form-check-label pt-1" for="spring_chk" style="font-size:0.75rem;">Add Spring Assist</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Smart Options and Add ons -->
                    <!-- SPECIAL INSTRUCTIONS -->
                    <div class="card mb-50">
                        <div class="card-header p-2" id="instr" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block collapsed text-left" type="button">
                                    SPECIAL INSTRUCTIONS
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwelve" class="collapse" aria-labelledby="instr" data-parent="#add_to_cart">
                            <div class="card-body">
                                <div class="form-group row mb-3">
                                    <div class="col-12 col-md-12 col-lg-12 pt-2">
                                        <label for="sp_instructions">Special Instructions</label>
                                        <textarea class="form-control" id="sp_instructions" name="sp_instructions" rows="3">{{ $order->sp_instructions }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Billing and Shipping address -->

                </div>
            </div>
            <!--
                                                                                    P R I C E
                                                                                -->
            <div class="col-lg-4">
                <h5 style="background-color:#FFF;" class="display_price_box mb-4 p-3 text-center">Price Details</h5>
                <!-- Display Quantity -->
                <div class="card display_price_box pt-2">
                    <div class="row p-3">
                        <div class="col-md-6">
                            <p class="font-weight-bold">Quantity</p>
                        </div>
                        <div class="col-md-6">
                            <p class="" id="txt_qty"></p>
                        </div>
                    </div>
                </div>
                <!-- Display Measurements -->
                <div class="card display_price_box">
                    <div class="row pt-3 pl-3 pr-3">
                        <div class="col-md-6">
                            <p class="font-weight-bold">Measurements</p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Price</p>
                        </div>
                    </div>
                    <div class="row pl-3 pr-3 pb-3">
                        <div class="col-md-6">
                            <p class="d-inline" id="txt_wid"></p>
                            <p class="d-inline">x</p>
                            <p class="d-inline" id="txt_len"></p>
                        </div>
                        <div class="col-md-6">
                            <p class="" id="shade_price"></p>
                        </div>
                        <input type="hidden" id="shade_amount" name="shade_amount" value="" />
                    </div>
                </div>
                <!-- Display Control Type -->
                @if ($shade_opt->control_type > 0 || $shade_opt->control_type_arr > 0)
                    <div class="card display_price_box">
                        <div class="pt-2 pb-2 pl-3">
                            <table style="width: 100%">
                                <thead>
                                    <th id="controlhd">
                                        <p class="font-weight-bold">Control Type</p>
                                    </th>
                                    <th id="controlhdprice">
                                        <p class="font-weight-bold">Price</p>
                                    </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <p class="font-weight-bold" id="man_type"></p>
                                        <td style="width:51%">
                                            <p class="" id="txt_ctype"></p>
                                        </td>
                                        <td style="width:49%">
                                            @if (isset($ct_wid_motors) && !empty($ct_wid_motors))
                                                <p class="" id="ctype_arrprice"></p>
                                            @else
                                                <p class="" id="ctype_price"></p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="" id="txt_ctype1"></p>
                                        </td>
                                        <td>
                                            <p class="" id="ctype_price1"></p>
                                            <p class="" id="txt_shad_wand_len"></p>
                                            <p class="" id="txt_shad_wand_side"></p>
                                        </td>
                                        <input type="hidden" id="motor_arr_pri" name="motor_arr_pri" value="" />
                                    </tr>
                                    @if ($shade_opt->somfy > 0)
                                        <tr>
                                            <td>
                                                <p class="" id="txt_somfy_upgrade"></p>
                                            </td>
                                            <td>
                                                <p class="" id="somfy_upgrade_price"></p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                <!-- Display Mount -->
                @if ($shade_opt->mount > 0)
                    <div class="card display_price_box">
                        <div class="row pt-3 pl-3 pr-3">
                            <div class="col-md-6">
                                <p class="font-weight-bold">Mount</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-weight-bold">Price</p>
                            </div>

                        </div>
                        <div class="row pl-3 pr-3">
                            <div class="col-md-6">
                                <p class="" id="txt_mount"></p>
                            </div>
                            <div class="col-md-6">
                                <p class="" id="mount_price"></p>
                            </div>
                            <div class="col-md-6">
                                <p class="" id="txtmount_pos"></p>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Display Fabric -->
                <div class="card display_price_box">
                    <div class="row pt-3 pl-3 pr-3">
                        <div class="col-md-12">
                            <p class="font-weight-bold">Fabric</p>
                        </div>
                        <!-- <div class="col-md-6">                                                         </div> -->
                    </div>
                    <div class="row pl-3 pr-3">
                        <div class="col-md-12">
                            <p class="" id="txt_fabric"></p>
                        </div>
                        <!-- <div class="col-md-6">
                                                                                                <p  class="" id="fabric_price"></p>
                                                                                            </div> -->
                    </div>
                </div>
                <!-- Display Wrapped -->
                @if ($shade_opt->wrap_expose > 0)
                    <div class="card display_price_box">
                        <div class="row pt-3 pl-3 pr-3">
                            <div class="col-md-6">
                                <p class="font-weight-bold">Wrapped</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-weight-bold">Price</p>
                            </div>
                        </div>
                        <div class="row pl-3 pr-3">
                            <div class="col-md-6">
                                <p class="" id="txt_wrap"></p>
                            </div>
                            <div class="col-md-6">
                                <p class="" id="wrap_price"></p>
                            </div>
                            <input type="hidden" id="wrap_exp_price" name="wrap_exp_price" value="">
                        </div>
                    </div>
                @endif
                <!-- Display Cassette -->
                <div class="card display_price_box">
                    <div class="row pt-3 pl-3 pr-3">
                        <div class="col-md-6">
                            <p class="font-weight-bold">Cassette</p>
                        </div>
                        <div class="col-md-6">
                            <p class="font-weight-bold">Price</p>
                        </div>
                    </div>
                    <div class="row pl-3 pr-3">
                        <div class="col-md-6">
                            <p class="d-inline" id="txt_cassette"></p>
                            <p class="d-inline">&nbsp;</p>
                        </div>
                        <div class="col-md-6">
                            <p class="d-inline" id="cassette_price"></p>
                        </div>
                        <input type="hidden" id="casprice" name="casprice" value="">
                    </div>
                    <div class="row pl-3 pr-3">
                        <div class="col-md-6">
                            <p class="" id="txt_casscolor"></p>
                        </div>
                    </div>
                </div>
                <!-- Display Brackets -->
                @if ($shade_opt->brackets > 0)
                    <div class="card display_price_box">
                        <div class="row pt-3 pl-3 pr-3">
                            <div class="col-md-6">
                                <p class="font-weight-bold">Brackets</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-weight-bold">Price</p>
                            </div>
                        </div>
                        <div class="row pl-3 pr-3">
                            <div class="col-md-6">
                                <p class="" id="free_brkts"></p>
                            </div>
                            <div class="col-md-6">
                                <p class="" id="free_brkts_price"></p>
                            </div>
                        </div>
                        <div class="row pl-3 pr-3">
                            <div class="col-md-6">
                                <p class="" id="txt_brackets"></p>
                            </div>
                            <div class="col-md-6">
                                <p class="" id="brackets_price"></p>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Spring Assist -->
                @if ($shade_opt->spring_assist > 0)
                    <div class="card display_price_box">
                        <div class="row pt-3 pl-3 pr-3">
                            <div class="col-md-6">
                                <p class="font-weight-bold">Spring Assist</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-weight-bold">Price</p>
                            </div>
                        </div>
                        <div class="row pl-3 pr-3">
                            <div class="col-md-6">
                                <p class="" id="txt_spring"></p>
                            </div>
                            <div class="col-md-6">
                                <p class="" id="spring_price"></p>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Display Smart Option -->
                <div class="card display_price_box">
                    <div class="pt-2 pb-2 pl-3">
                        <div class="row">
                            <div class="col-6">
                                <p class="font-weight-bold">Smart Option</p>
                            </div>
                            <div class="col-6">
                                <p class="font-weight-bold">Price</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p id="plugin_txt"></p>
                            </div>
                            <div class="col-6">
                                <p id="plugin_price"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p id="solar_txt"></p>
                            </div>
                            <div class="col-6">
                                <p id="solar_price"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p id="hub_txt"></p>
                            </div>
                            <div class="col-6">
                                <p id="hub_price"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p id="transformer_txt"></p>
                            </div>
                            <div class="col-6">
                                <p id="transformer_price"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Coupon -->
                <div class="card display_price_box d-none">
                    <div class="row pt-3 pl-3 pr-3 pb-3">
                        <p class="font-weight-bold pl-3">Coupon</p>
                        <p class="font-weight-bold pl-3" id="cpntxt"></p>
                        <div class="col-12 text-center">
                            <form id="coupon_form" action="{{ url('/xzt.coupon_check') }}" method="post">
                                @csrf
                                <input type="text" class="form-control mb-3" id="coupon" name="coupon" />
                                <input type="button" class="form-control btn btn-primary text-center" id="coupon_sbmt" name="coupon_sbmt" value="Apply Coupon" style="width:60%;" />
                            </form>
                            <input type="hidden" id="coupon_discount" name="coupon_discount" value="" />
                        </div>
                    </div>
                </div>
                <!-- Display Total -->
                <div class="card display_price_box">
                    <div class="row pt-2 pb-2 pl-3">
                        <table style="width: 100%;font-size: 18px;" class="text-center">
                            <thead class="">
                                <th class="">Suggested Price</th>
                                <th class="">Grand Total</th>
                            </thead>
                            <tbody class="">
                                <tr class="">
                                    <td class="">
                                        <span class="font-weight-bold">$ </span>
                                        <p class="d-inline font-weight-bold text-right" name="ttl_price" id="ttl_price" style="text-decoration: line-through;" value=""></p>
                                    </td>

                                    <td class="">
                                        <span class="d-inline font-weight-bold">$ </span>
                                        <p class="d-inline font-weight-bold" name="discount_txt" id="discount_txt" value=""></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="hidden" name="t_price" id="t_price" value="">
                        <input type="hidden" name="d_price" id="d_price" value="">
                    </div>

                </div>
                <div class="card display_price_box">
                    <div class="row pt-2 pb-2 pl-3 text-center">
                        <div class="col">
                            <button type="submit" name="button" id="button" value="publish" class="btn btn-primary">Update Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Specifications</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ strip_tags($product->specification) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="loader-service makeItHidden">
        <i class="las la-circle-notch"></i>
    </div>

@endsection

@section('script')
    <script src="{{ static_asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ static_asset('assets/js/print.min.js') }}"></script>

    <script>
        /* Width Height price */
        var motor_arrprice = 0;
        // Ajax for width price
        $('.wm_price').on('change', function(e) {
            e.preventDefault();
            vm_price_change();
        });
        vm_price_change();

        function vm_price_change() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var width = $('#width option:selected').val() ? $('#width option:selected').val() : 0;
            var decimal = $('#wid_decimal option:selected').val() ? $('#wid_decimal option:selected').val() : 0;
            var max = "{{ $wid_motor_max ?? 0 }}";
            var code = "{{ $ct_wid_motors->ct_widmotor_code ?? 0 }}";
            $.ajax({
                url: "{{ url('/features/wid_motor_price') }}",
                type: "post",
                dataType: 'json',
                data: {
                    width: width,
                    fraction: decimal,
                    max: max,
                    code: code
                },
                success: function(result) {
                    // console.log(result);
                    $('#ctype_arrprice').text(result);
                    motor_arrprice = result;
                }
            });
        }

        /* Control Type Section Js */
        $('#motorization').click(function() {
            motorization_checkbox_click();
        });
        if ($("#motorization")[0].checked) {
            motorization_checkbox_click();
        }


        function motorization_checkbox_click() {
            $('#motor_type').show();
            $('#motor_cntrl').show();
            $('#motor_pos').show();
            $('#controlhd').show();
            $('#controlhdprice').show();
            $('.smart_opts').show();

            $('#txt_ctype').text('');
            $('#txt_ctype1').text('');
            $('#ctype_price').text('');
            $('#ctype_price1').text('');
            $('#txt_somfy_upgrade').text('');
            $('#somfy_upgrade_price').text('');
            $('#man_type').text('');

            $('#wand_length').hide();
            $("#wand_length option").prop("selected", false);
            $('#wand_ctrl').hide();
            $("#wand_ctrl option").prop("selected", false);
            $('#chain_color').hide();
            $("#chain_color option").prop("selected", false);
            $('#chain_ctrl').hide();
            $("#chain_ctrl").prop("required", false);
            $("#chain_ctrl option").prop("selected", false);
            $('#cord_ctrl').hide();
            $('#cord_ctrl').prop("required", false);
            $("#cord_ctrl option").prop("selected", false);
            $('#cord_color').hide();
            $("#cord_color option").prop("selected", false);
            $('#manual_sel').hide();
            $("#manual_sel option").prop("selected", false);

            // $('.chain_color_box').hide();
            $('.chain_color_box').removeClass('d-inline');
            $(".chain_colors option").prop("selected", false);
            // $('.cord_color_box').hide();
            $('.cord_color_box').removeClass('d-inline');
            $(".cord_colors option").prop("selected", false);

            $('#chain_img').hide();

            $('#control_type_hdng').hide();
            $('#manual_control_pos_hdng').hide();

            if (motor_arrprice != 0) {
                $('#ctype_arrprice').text(motor_arrprice);
                grandTotalCalc();
            }
        }

        $('#motor_type').click(function() {
            motor_type_click();
        });

        motor_type_click();

        function motor_type_click() {
            var name = $('#motor_type').find('option:selected').text();
            if (name == 'Shadeowand') {
                $('#shad_wand_len').show();
                $('#shad_wand_side').show();
                $('#txt_somfy_upgrade').text('');
                $('#somfy_upgrade_price').text('');
            } else {
                $('#shad_wand_len').hide();
                $('#shad_wand_side').hide();
            }
            if (name == 'Somfy') {
                $('#somfy_list').show();
                $('#motor_cntrl').hide();
                $('#txt_ctype1').text('');
                $('#ctype_price1').text('');
                $('#txt_shad_wand_len').text('');
                $('#txt_shad_wand_side').text('');
                $('#motor_cntrl').prop('required', false);
                $('#somfy_list').prop('required', true);
            } else {
                $('#somfy_list').hide();
                $('#motor_cntrl').show();
                $('#motor_cntrl').prop('required', false); // true
                $('#somfy_list').prop('required', false);
            }
            if (name == 'Rechargeable Battery Motor' || name == '12 Volt Motor' || name == '24 Volt Motor' || name == '24 Volt Motor' || name == '110 Volt Motor') {
                $('#txt_shad_wand_len').text('');
                $('#txt_shad_wand_side').text('');
                $('#txt_somfy_upgrade').text('');
                $('#somfy_upgrade_price').text('');
                // $('#txt_ctype1').text('');
                // $('#ctype_price1').text('');
            }

            $('#motor_name').val($('#motor_type').find('option:selected').text());
        }

        $('#manual').click(function() {
            manual_motor_click();
        });
        if ($("#manual")[0].checked) {
            manual_motor_click();
        }

        function manual_motor_click() {
            $('#manual_sel').show();

            $('#txt_ctype').text('');
            $('#txt_ctype1').text('');
            $('#ctype_price').text('');
            $('#ctype_price1').text('');
            $('#txt_somfy_upgrade').text('');
            $('#somfy_upgrade_price').text('');
            $('#txt_shad_wand_len').text('');
            $('#txt_shad_wand_side').text('');
            $('#ctype_arrprice').text('');

            $('#control_type_hdng').show();

            $('#controlhd').hide();
            $('#controlhdprice').hide();
            $('#motor_type').hide();
            $("#motor_type option").prop("selected", false);
            $('#somfy_list').hide();
            $("#somfy_list option").prop("selected", false);
            $('#motor_cntrl').hide();
            $("#motor_cntrl option").prop("selected", false);
            $('#motor_pos').hide();
            $("#motor_pos option").prop("selected", false);
            $('#shad_wand_len').hide();
            $("#shad_wand_len option").prop("selected", false);
            $('#shad_wand_side').hide();
            $("#shad_wand_side option").prop("selected", false);


            $('.smart_opts').hide();
            $('#channel_guideline').hide();


            grandTotalCalc();
        }

        $("#bottom_rail").change(function() {
            let val = $(this).val();
            let selectedColor = $("#bottom_rail_color").data("color");
            if (val == "") {
                $("#bottom_rail_color").html("");
            }
            if (val == "Default") {
                $("#bottom_rail_color").html(`
                    <option value="default">Default</option><option value="white">White</option><option value="ivory">Ivory</option><option value="grey">Grey</option><option value="black">Black</option>
                `);
                $(`#bottom_rail_color option[value="${selectedColor}"]`).prop("selected", true);
            }
            if (val == "Hem Bar Wrapped" || val == "Sealed Wrapped") {
                $("#bottom_rail_color").html(`
                    <option value="default">Default</option>
                `);
            }
            grandTotalCalc();

        })

        $('body').on('change', '#manual_sel', function() {
            let name = $(this).find('option:selected').text();
            manual_chain_cord_select(name);
        });

        let name = $('#manual_sel').find('option:selected').text();
        manual_chain_cord_select(name);

        function manual_chain_cord_select(name) {
            if (name == 'Chain') {
                // $('#chain_color').show();
                // $('.chain_color_box').show();
                $('.chain_color_box').addClass('d-inline');
                $('#chain_ctrl').show();
                $('#cord_ctrl').hide();
                $('#cord_color').hide();
                // $('.cord_color_box').hide();
                $('.cord_color_box').removeClass('d-inline');

                $('#manual_control_pos_hdng').show();

                $('#man_type').text('Manual: Chain Color & Control');

                $('#chain_color').prop('required', true);
                $('#chain_ctrl').prop('required', true);
                $('#cord_ctrl').prop('required', false);
                $('#cord_color').prop('required', false);

            } else if (name == 'Cord') {
                $('#cord_ctrl').show();
                // $('#cord_color').show();
                // $('.cord_color_box').show();
                $('.cord_color_box').addClass('d-inline');
                $('#chain_color').hide();
                $('#chain_ctrl').hide();
                // $('.chain_color_box').hide();
                $('.chain_color_box').removeClass('d-inline');

                $('#manual_control_pos_hdng').show();

                $('#man_type').text('Manual: Cord Color & Control');

                $('#chain_color').prop('required', false);
                $('#chain_ctrl').prop('required', false);
                $('#cord_ctrl').prop('required', true);
                $('#cord_color').prop('required', true);

                $("#chain_ctrl option:selected").prop("selected", false)
                $('#chain_img').hide();
            }
        }

        $('input[name="controltype"]').click(function() {
            control_type_select();
        });
        control_type_select();

        function control_type_select() {
            if ($('input[name="controltype"]:checked').val() == 'manual') {
                $('#manual_sel').prop('required', true);
                $('#motor_type').prop('required', false);
                $('#motor_cntrl').prop('required', false);
                $("#chain_ctrl").prop("required", true);
            } else if ($('input[name="controltype"]:checked').val() == 'motor') {
                $('#manual_sel').prop('required', false);
                $('#motor_type').prop('required', true);
                $('#motor_cntrl').prop('required', false); // true
                var name = $('#motor_type').find('option:selected').text();
                if (name == 'Somfy') {
                    $('#motor_cntrl').prop('required', false);
                }
            }
        }

        /* End Control Type Section Js */

        $('#fabric').change(function() {
            $('#img_spinner').show();
            let image = $(this).find(':selected').attr('data-img');
            //console.log(image);
            $('#fabric_img').attr("src", "{{ static_asset('fabric/images') . '/' }}" + image);
            $('#fabric_img').show();
            $('#img_spinner').hide();
            $('#fab_det').text($(this).find(':selected').attr('data-fab-specs'));
            if ($(this).find(':selected').val() == '') {
                $('#fabric_img').hide();
                $('#img_spinner').hide();
                $('#fab_det').text('');
            }
        });
        $('#mount').change(function() {
            let m_img = $(this).find(':selected').attr('data-mountimg');
            $('#mount_img').attr("src", "{{ static_asset('mount/images') . '/' }}" + m_img);
            $('#mount_img').show();
            if ($(this).find(':selected').val() == '') {
                $('#mount_img').hide();
            }
        });

        $('#mount_pos').change(function() {
            let m_img = $(this).find(':selected').attr('data-mountposimg');
            $('#mount_pos_img').attr("src", "{{ static_asset('mount/images/position') . '/' }}" + m_img);
            $('#mount_pos_img').show();
            if ($(this).find(':selected').val() == '') {
                $('#mount_pos_img').hide();
            }
        });

        $('#stack').change(function() {
            let stack_image = $(this).find(':selected').attr('data-stack-img');
            $('#stack_img').attr("src", "{{ static_asset('stack/images') . '/' }}" + stack_image);
            $('#stack_img').show();
            if ($(this).find(':selected').val() == '') {
                $('#stack_img').hide();
            }
        });

        $('#brackets').change(function() {
            let bracket_image = $(this).find(':selected').attr('data-bracketimg');
            $('#bracket_img').attr("src", "{{ static_asset('bracket/images') . '/' }}" + bracket_image);
            $('#bracket_img').show();
            if ($(this).find(':selected').val() == '') {
                $('#bracket_img').hide();
            }
        });

        $('#chain_ctrl').change(function() {
            let img_manual = $(this).find(':selected').attr('data-man-img');
            if (img_manual) {
                $('#chain_img').attr("src", "{{ static_asset('controltype/manual/images') . '/' }}" + img_manual);
                $('#chain_img').show();
                if ($(this).find(':selected').val() == '') {
                    $('#chain_img').hide();
                }
            }
        });

        $('#cord_ctrl').change(function() {
            let img_manual = $(this).find(':selected').attr('data-man-img');
            if (img_manual) {
                $('#chain_img').attr("src", "{{ static_asset('controltype/manual/images') . '/' }}" + img_manual);
                $('#chain_img').show();
                if ($(this).find(':selected').val() == '') {
                    $('#chain_img').hide();
                }
            }
        });

        $('#quantity').change(function() {
            $("#txt_qty").text($('#quantity option:selected').val());
            if ($('#quantity option:selected').val() > 1) {
                var chk = `<?php if (isset($brkt_opt_chk)) {
                    echo $brkt_opt_chk;
                } ?>`;
                if (chk > 0) {
                    $("#brackets_opt").removeClass('hide');
                    $("#brktsoptcard").removeClass('hide');
                }
            } else {
                $("#brackets_opt").addClass('hide');
                $("#brktsoptcard").addClass('hide');
                $("#brackets_opt option").prop("selected", false);
            }
        });

        $('#width').change(function() {
            var chk = `<?php if (isset($sa_check)) {
                echo $sa_check;
            } ?>`;
            if ($('#width option:selected').val() > 96) {
                if (chk > 0) {
                    $("#sp_card").removeClass('hide');
                    alert('It is highly recommended that you add spring assist to your shade.');
                }
            } else {
                $("#sp_card").addClass('hide');
            }

            if ($('#product_name').text().toLowerCase().includes("roller") || $('#shade_desc').text().toLowerCase().includes("roller")) {
                if ($('#width').val() > 96) {
                    alert('It is highly recommended that you add spring assist to your shade.');
                }
            }
            $("#txt_wid").text($(this).val() + ' (' + $('#wid_decimal option:selected').text() + ')');

        });

        $('#length').change(function() {
            $("#txt_len").text($(this).val() + ' (' + $('#len_decimal option:selected').text() + ')');
        });

        $('.calc_prices').change(function() {
            if ($('#width').val() > 96) {
                $('#spring_chk').prop("checked", true);
                $("#spring_price").text($('#spring_chk:checked').val());
            }
        });

        $('#motor_type').change(function() {
            $("#txt_ctype").text($("#motor_type option:selected").text());
            if (($("#motor_type option:selected").val()) != '') {
                $("#ctype_price").text($("#motor_type option:selected").val());
            }
            grandTotalCalc();
        });

        $('#motor_cntrl').change(function() {
            $("#txt_ctype1").text($("#motor_cntrl option:selected").text());
            $("#ctype_price1").text($("#motor_cntrl option:selected").val());
            $('#remote_ctrl_channel').val($("#motor_cntrl option:selected").text());
            grandTotalCalc();
        });

        $('#somfy_list').change(function() {
            $("#txt_somfy_upgrade").text($("#somfy_list option:selected").text());
            $("#somfy_upgrade_price").text($("#somfy_list option:selected").val());
            $('#somfy_upgrade_name').val($("#somfy_list option:selected").text());
            grandTotalCalc();
        });

        $('#wand_length').change(function() {
            $("#txt_ctype").text($(this).val());
        });

        $('#wand_ctrl').change(function() {
            $("#txt_ctype1").text($(this).val());
        });

        $('.chain_colors').change(function() {
            $("#txt_ctype").text($(this).val());
        });

        $('#chain_ctrl').change(function() {
            $("#txt_ctype1").text($(this).find(':selected').text());
        });

        $('#cord_ctrl').change(function() {
            $("#txt_ctype1").text($(this).find(':selected').text());
        });
        $('.cord_colors').change(function() {
            $("#txt_ctype").text($(this).val());
        });

        $('.chain_colors').click(function() {
            $(".chain_colors").not(this).prop("checked", false);
        });

        $('.cord_colors').click(function() {
            $(".cord_colors").not(this).prop("checked", false);
        });


        $("#mount").change(function() {
            $("#mount_price").text($('#mount option:selected').val());
            $('#mount_type').val($('#mount option:selected').val());
            $('#txt_mount').text($('#mount option:selected').text());
            grandTotalCalc();
        });

        $('#mount_pos').change(function() {
            $('#txtmount_pos').text($('#mount_pos option:selected').text());
        });

        $("input[name=delivery_chk]").change(function() {
            if ($('input[name=delivery_chk]:checked').val() == 'pick') {
                $('.for_reqd').prop('required', false);
            } else {
                $('.for_reqd').prop('required', true);
            }
        });

        $("#mount_price").change(function() {
            grandTotalCalc();
        });

        $('#fabric').change(function() {
            $("#txt_fabric").text($('#fabric option:selected').text());
        });

        $('#wrap_expose').change(function() {
            $("#txt_wrap").text($('#wrap_expose option:selected').text());
        });

        $('#cassette_type').change(function() {
            var cass_type = $("#cassette_type option:selected").html();
            $("#txt_cassette").text(cass_type);
        });

        $('#cassette_color').change(function() {
            var color = $("#cassette_color option:selected").html();
            $("#txt_casscolor").text(color);
        });


        // $('#cassette_type').change(function () {
        //     // if($('#product_name').text().toLowerCase().includes("willow") || $('#shade_desc').text().toLowerCase().includes("willow") || $('#product_name').text().toLowerCase().includes("uni") || $('#shade_desc').text().toLowerCase().includes("uni")) {
        //         if(($("#cassette_type option:selected").val()).toLowerCase().indexOf("track") >= 0) {
        //         $('#cassette_color').find('option').not(':first').remove();
        //         $('#cassette_color').append('<option value="white" selected>White</option>');
        //         $('#cassette_color').append('<option value="anodized">Anodized</option>');
        //         $( "#txt_casscolor" ).text('White');
        //         }else {
        //             $( "#txt_casscolor" ).text('');
        //             $('#cassette_color').find('option').not(':first').remove();
        //             // $('#cassette_color').append('<option value="white">White</option>');
        //             $('#cassette_color').append('<option value="blue">Blue</option>');
        //             $('#cassette_color').append('<option value="black">Black</option>');
        //         }
        //     // }
        // });

        $('#brackets').change(function() {
            $('#free_brkts').text($('#brackets option:selected').text());
            $('#free_brkts_price').text(0);
        });

        $('#brackets_opt').change(function() {
            $("#txt_brackets").text($('#brackets_opt option:selected').text());
            $('#brackets_opt_name').val($('#brackets_opt option:selected').text());

        });

        $('#brackets_opt').change(function() {
            $("#brackets_price").text($('#brackets_opt option:selected').val());
            grandTotalCalc();
        });


        $('#spring_chk').change(function() {
            // $( "#spring_price" ).text($('#spring_chk:checked').val());
            if ($("#spring_chk").prop('checked') == true) {
                $("#spring_price").text($('#spring_chk:checked').val());
            } else {
                $("#spring_price").text('0');
            }
            grandTotalCalc();
        });


        $('#shad_wand_len').change(function() {
            $("#txt_shad_wand_len").text($(this).val());
        });

        $('#shad_wand_side').change(function() {
            $("#txt_shad_wand_side").text($(this).val());
        });

        // $('#txt_qty').change(function() {
        //     grandTotalCalc();
        // });
        $('#quantity').change(function() {
            grandTotalCalc();
        });


        //Smart Option
        $('input[name=plugin_charger]').click(function() {
            $('#plugin_txt').text($('label[for="plugin_charger"]').text());
            $('#plugin_price').text($('input[name=plugin_charger]:checked').val());
            grandTotalCalc();
        });

        $('input[name=solar_panel]').click(function() {
            $('#solar_txt').text($('label[for="solar_panel"]').text());
            $('#solar_price').text($('input[name=solar_panel]:checked').val());
            grandTotalCalc();
        });

        $('input[name=shade_smart_hub]').click(function() {
            $('#hub_txt').text($('label[for="shade_smart_hub"]').text());
            $('#hub_price').text($('input[name=shade_smart_hub]:checked').val());
            grandTotalCalc();
        });

        $('input[name=shade_smart_transformers]').click(function() {
            $('#transformer_txt').text($('label[for="shade_smart_transformers"]').text());
            $('#transformer_price').text($('input[name=shade_smart_transformers]:checked').val());
            grandTotalCalc();
        });


        $(".fabric-min-max-width-changes").change(function() {
            let fabricMinWidth = $("#fabric option:selected").data("fabric-min-width");
            let fabricMaxWidth = $("#fabric option:selected").data("fabric-max-width");

            let selectedWidth = $("#width").val();

            if (selectedWidth < fabricMinWidth && fabricMinWidth > 0) {
                alert("Fabric min width required is " + fabricMinWidth);
            }
            if (selectedWidth > fabricMaxWidth && fabricMaxWidth > 0) {
                alert("Fabric max width required is " + fabricMaxWidth);
            }

        });

        // $('#smart_addons').change(function() {
        //     $( "#txt_sm_option" ).text($(this).val());
        // });

        // $('#smart_addons').change(function() {
        //     var values = $('#smart_addons').val();
        //     values = values.toString();
        //     values = values.replace(/,/g, ' +\n');
        //     $( "#txt_sm_option" ).text(values).css('textTransform', 'capitalize');
        //     $('#smartopts').val($( "#txt_sm_option" ).text());
        //     var sum = 0;
        //     $('#smart_addons option:selected').each(function() {
        //         sum = parseInt($(this).attr("data-smartprice"))+sum;
        //         $('#sm_option_price').text(sum);
        //     });
        //     $('#smartopts_pri').val($('#sm_option_price').text());
        //     if(($("#smart_addons :selected").length) == 0) {
        //         $('#sm_option_price').text('0');
        //     }
        //     grandTotalCalc();
        // });
        $('#shadoesmart_hub').change(function() {
            if ($("#shadoesmart_hub").prop('checked') == true) {
                $("#shadoehub_txt").text($("label[for='shadoesmart_hub']").text());
                $("#shadoehub_price").text($('#shadoesmart_hub:checked').val());
            } else {
                $("#shadoehub_txt").text('');
                $("#shadoehub_price").text('');
            }
            grandTotalCalc();
        });

        $('#shadoesmart_transformer').change(function() {
            if ($("#shadoesmart_transformer").prop('checked') == true) {
                $("#shadoetf_txt").text($("label[for='shadoesmart_transformer']").text());
                $("#shadoetf_price").text($('#shadoesmart_transformer:checked').val());
            } else {
                $("#shadoetf_txt").text('');
                $("#shadoetf_price").text('');
            }
            grandTotalCalc();
        });

        $('#solar_panel').change(function() {
            if ($("#solar_panel").prop('checked') == true) {
                $("#solar_txt").text($("label[for='solar_panel']").text());
                $("#solar_price").text($('#solar_panel:checked').val());
            } else {
                $("#solar_txt").text('');
                $("#solar_price").text('');
            }
            grandTotalCalc();
        });

        $('#plug_in_charger').change(function() {
            if ($("#plug_in_charger").prop('checked') == true) {
                $("#plugchrg_txt").text($("label[for='plug_in_charger']").text());
                $("#plugchrg_price").text($('#plug_in_charger:checked').val());
            } else {
                $("#plugchrg_txt").text('');
                $("#plugchrg_price").text('');
            }
            grandTotalCalc();
        });


        $('#motor_cntrl').change(function() {
            $('#channel_guideline').show();
        });

        $('#clr_addons').on('click', function() {
            $('#smart_addons').val('');
            $('#sm_option_price').text('0');
            $("#txt_sm_option").text('');
            grandTotalCalc();
        });

        //Custom Variables
        var length_calc = '';
        var width_calc = '';
        var width_decimal_calc = '';
        let length_decimal_calc = '';
        var obj;
        var shade_chk;
        var WIDTH_SIZE;
        var LENGTH_SIZE;
        var coupon_obj;


        function grandTotalCalc() {
            //shade
            let total_shade_price = $('#shade_price').text() != "" ? parseInt($('#shade_price').text()) : 0;
            //wrap
            let total_wrap_price = $('#wrap_price').text() != "" ? parseInt($('#wrap_price').text()) : 0;
            //cassette
            let total_cassette_price = $('#cassette_price').text() != "" ? parseInt($('#cassette_price').text()) : 0;
            let total_bottom_rail_price = parseFloat($("#bottom_rail option:selected").data("price") ?? 0) ?? 0;
            //sm_option
            // let ttl_sm_option_price = $('#sm_option_price').text() != "" ? parseInt($('#sm_option_price').text()) : 0;
            let ttl_shadoehub_price = $('#hub_price').text() != "" ? parseInt($('#hub_price').text()) : 0;
            let ttl_shadoetf_price = $('#transformer_price').text() != "" ? parseInt($('#transformer_price').text()) : 0;
            let ttl_solar_price = $('#solar_price').text() != "" ? parseInt($('#solar_price').text()) : 0;
            let ttl_plugchrg_price = $('#plugin_price').text() != "" ? parseInt($('#plugin_price').text()) : 0;
            //control type
            let motor_price = $('#ctype_price').text() != "" ? parseInt($('#ctype_price').text()) : 0;
            let channel_price = $('#ctype_price1').text() != "" ? parseInt($('#ctype_price1').text()) : 0;
            let qty = $('#txt_qty').text() != "" ? parseInt($('#txt_qty').text()) : 0;
            //bracket
            let brack_opt_price = $('#brackets_price').text() != "" ? parseInt($('#brackets_price').text()) : 0;
            //mount
            let mnt_price = $('#mount_price').text() != "" ? parseInt($('#mount_price').text()) : 0;
            //spring assist
            let spring_price = $('#spring_price').text() != "" ? parseInt($('#spring_price').text()) : 0;
            //somfy upgrades
            // let somfy_upg_price = $('#somfy_upgrade_price').text() != "" ? parseInt($('#somfy_upgrade_price').text()) : 0;
            //motor array
            let motor_arr = $('#ctype_arrprice').text() != "" ? parseInt($('#ctype_arrprice').text()) : 0;
            //Coupon Discount
            // let coupon_disc_price = $('#coupon_discount').val() != "" ? parseInt($('#coupon_discount').val()) : 0;

            // console.log(total_shade_price);
            // console.log(total_wrap_price);
            // console.log(total_cassette_price);
            // console.log(ttl_sm_option_price);
            // console.log(motor_price);
            // console.log(channel_price);
            // console.log(brack_opt_price);
            // console.log(mnt_price);
            // console.log(spring_price);
            // console.log(somfy_upg_price);

            var discount = $('#disc_percent').val();
            discount = qty * ((discount / 100) * (total_shade_price + total_cassette_price + total_wrap_price + total_bottom_rail_price));
            // console.log(discount);
            //TODO: here is dicount calculation problem!
            // var ttl_price = (qty*(total_shade_price + total_wrap_price + total_cassette_price + motor_price + channel_price + brack_opt_price + mnt_price + spring_price + somfy_upg_price + motor_arr + ttl_shadoehub_price + ttl_shadoetf_price + ttl_solar_price + ttl_plugchrg_price)) - coupon_disc_price;
            var ttl_price = (qty * (total_shade_price + total_wrap_price + total_cassette_price + total_bottom_rail_price + brack_opt_price + mnt_price + spring_price + channel_price + motor_price + motor_arr + ttl_shadoehub_price +
                ttl_shadoetf_price +
                ttl_solar_price + ttl_plugchrg_price));
            dic_price = ttl_price - discount;
            // console.log(ttl_price, dic_price);
            // ttl_price = isNaN(parseFloat(ttl_price)) ? 0 : ttl_price;
            // $('#ttl_price').text('$ ' + ttl_price || 0);
            // $('#ttl_price').text('$ ' + ttl_price);

            $('#ttl_price').text(ttl_price);
            // console.log(ttl_price);
            $('#t_price').val($('#ttl_price').text());
            $('#d_price').val($('#discount_txt').text());

            $('#discount_txt').text(dic_price.toFixed(2));
        }


        $('.calc_prices').on('change', function() {
            width_calc = $('#width').find(":selected").data('price');
            width_calc_val = $('#width').find(":selected").val();
            width_decimal_calc = $('#wid_decimal').find(":selected").val();
            length_calc = $('#length').find(":selected").data('price');
            length_calc_val = $('#length').find(":selected").val();
            length_decimal_calc = $('#len_decimal').find(":selected").val();
            // console.log(obj[0].width, obj[0].length);

            if (obj[obj.length - 1].width == width_calc) {
                width_decimal_calc = 0;
            }

            // console.log(width_calc, width_decimal_calc, length_calc, length_decimal_calc)

            if ((obj[0].width > width_calc_val && obj[0].length > length_calc_val) || ((parseInt(width_calc) > parseInt(width_calc_val)) && (parseInt(length_calc) > parseInt(length_calc_val)) || (width_decimal_calc < 0.125 &&
                    width_calc && length_calc && length_decimal_calc < 0.125))) {
                // console.log("Basic")
                $.each(obj, function(key, value) {
                    if (value.width == width_calc && value.length == length_calc) {
                        $("#txt_wid").text(value.width + ' (' + $('#wid_decimal option:selected').text() + ')');
                        $("#txt_len").text(value.length + ' (' + $('#len_decimal option:selected').text() + ')');
                        $('#shade_price').text(value.price);
                        $('#shade_amount').val(value.price);
                        $("#cassette_type").attr("data-cassette-type-price", obj[key].square_cassette);
                        // console.log(obj[key].square_cassette);
                        $("#cassette_type").attr("data-stdcas-price", obj[key].std_r_cassette);
                        $("#cassette_type").attr("data-roundcas-price", obj[key].round_cassette);
                        // var v1 = $('#cassette_type').children("option:selected").val();
                        // if(v1 == 'square_cassette') {
                        //     $('#cassette_price').text($('#cassette_type').attr("data-cassette-type-price"));
                        // }

                        $("#w_exp").attr("data-wrap-expose-price", obj[key].fabric_wrap);
                        // var v1 = $("input[name='wrap_expose']:checked").val();
                        // if(v1 == 'wrap') {
                        //     $('#wrap_price').text($('#w_exp').attr("data-wrap-expose-price"));
                        // }

                        //motor array price
                        if ((obj[key].price_tag == 11) || (obj[key].price_tag = 12)) {
                            $('#motor_array_price').text(obj[key].motor_array);
                            $("#motor_arr_pri").val(obj[key].motor_array);
                            // console.log(obj[key].motor_array);
                        }
                    }
                    grandTotalCalc();
                });
            } else {
                // console.log(obj);
                let width_key = 0;
                let length_key = 0;
                // let l = 0;
                $.each(obj, function(key, value) {
                    // If width Increase
                    // console.log("If width Increase")
                    if (width_decimal_calc >= 0.125 && length_decimal_calc < 0.125) {
                        // console.log("If width Increase");
                        if (value.width == width_calc && value.length == length_calc) {
                            width_key = key;
                            // console.log("If width Increase 2", value.width, value.length);
                            while (parseInt(obj[width_key++].width) <= parseInt(width_calc) + parseInt(obj[width_key - 1].wid_diff) && obj.length != width_key) { // obj[width_key - 1].diff_width or WIDTH_SIZE
                                // code ..
                                // console.log("key: ", width_key);
                                if ((parseInt(width_calc) > parseInt(width_calc_val))) {
                                    width_key--;
                                }
                                if (obj[width_key].length == length_calc) {
                                    // $( "#txt_wid" ).text(obj[width_key - 1].width +' ('+ $('#wid_decimal option:selected').text()+')');


                                    $('#shade_price').text(obj[width_key].price);
                                    // console.log(obj[width_key].price);
                                    $('#shade_amount').val(obj[width_key].price);
                                    $("#cassette_type").attr("data-cassette-type-price", obj[width_key].square_cassette);
                                    $("#cassette_type").attr("data-stdcas-price", obj[width_key].std_r_cassette);
                                    $("#cassette_type").attr("data-roundcas-price", obj[width_key].round_cassette);
                                    // var v1 = $('#cassette_type').children("option:selected").val();
                                    // if(v1 == 'square_cassette') {
                                    //     $('#cassette_price').text($('#cassette_type').attr("data-cassette-type-price"));
                                    // }

                                    $("#w_exp").attr("data-wrap-expose-price", obj[width_key].fabric_wrap);
                                    // var v1 = $("input[name='wrap_expose']:checked").val();
                                    // if(v1 == 'wrap') {
                                    //     $('#wrap_price').text($('#w_exp').attr("data-wrap-expose-price"));
                                    // }

                                    //motor array price
                                    if ((obj[width_key].price_tag == 11) || (obj[width_key].price_tag = 12)) {
                                        $('#motor_array_price').text(obj[width_key].motor_array);
                                        $("#motor_arr_pri").val(obj[width_key].motor_array);
                                        // console.log(obj[key].motor_array);
                                    }

                                    return false;
                                }
                            }
                        }
                        // If length Increase
                    } else if (width_decimal_calc < 0.125 && length_decimal_calc >= 0.125) {
                        // console.log("If Length Increase")
                        if (value.width == width_calc && value.length == length_calc) {
                            $("#cassette_type").attr("data-cassette-type-price", obj[key].square_cassette);
                            $("#cassette_type").attr("data-stdcas-price", obj[key].std_r_cassette);
                            $("#cassette_type").attr("data-roundcas-price", obj[key].round_cassette);
                            $("#w_exp").attr("data-wrap-expose-price", obj[key].fabric_wrap);
                            length_key = key;
                            //motor array price
                            if ((obj[key].price_tag == 11) || (obj[key].price_tag = 12)) {
                                $('#motor_array_price').text(obj[key].motor_array);
                                $("#motor_arr_pri").val(obj[key].motor_array);
                                // console.log(obj[key].motor_array);
                            }

                            while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) { //obj[length_key - 1].len_diff or LENGTH_SIZE
                                if ((parseInt(length_calc) > parseInt(length_calc_val))) {
                                    length_key--;
                                }
                                // code ..
                                if (obj[length_key].width == width_calc) {
                                    // console.log("length: ", obj[length_key]);
                                    // $( "#txt_len" ).text($('#length option:selected').text()+' ('+ $('#len_decimal option:selected').text()+')');
                                    $('#shade_price').text(obj[length_key].price);
                                    console.log(obj[length_key].price);
                                    $('#shade_amount').val(obj[length_key].price);
                                    return false;
                                }
                            }
                        }
                        // If both Increase
                    } else {
                        // console.log("If Both Increase")
                        // console.log(obj[obj.length - 1]);
                        // console.log(value.width, width_calc);
                        if (obj[obj.length - 1] == width_calc)
                            obj[obj.length] = {};
                        if (value.width == width_calc && value.length == length_calc) {
                            width_key = key;
                            // console.log(value.width == width_calc, value.length == length_calc)
                            // return false;
                            while (parseInt(obj[width_key++].width) <= parseInt(width_calc) + parseInt(obj[width_key - 1].wid_diff) && obj.length != width_key) {
                                if ((parseInt(width_calc) > parseInt(width_calc_val))) {
                                    width_key--;
                                }
                                // code ..
                                if (obj[width_key].length == length_calc) {
                                    length_key = width_key;
                                    width_calc = obj[width_key].width;

                                    $('#shade_price').text(obj[width_key].price);

                                    console.log(obj[width_key].price);
                                    $('#shade_amount').val(obj[width_key].price);
                                    $("#cassette_type").attr("data-cassette-type-price", obj[width_key].square_cassette);
                                    $("#cassette_type").attr("data-stdcas-price", obj[width_key].std_r_cassette);
                                    $("#cassette_type").attr("data-roundcas-price", obj[width_key].round_cassette);
                                    // var v1 = $('#cassette_type').children("option:selected").val();
                                    // if(v1 == 'square_cassette') {
                                    //     $('#cassette_price').text($('#cassette_type').attr("data-cassette-type-price"));
                                    // }
                                    $("#w_exp").attr("data-wrap-expose-price", obj[width_key].fabric_wrap);
                                    var v1 = $("input[name='wrap_expose']:checked").val();
                                    // if(v1 == 'wrap') {
                                    //     $('#wrap_price').text($('#w_exp').attr("data-wrap-expose-price"));
                                    // }
                                    //motor array price
                                    if ((obj[width_key].price_tag == 11) || (obj[width_key].price_tag = 12)) {
                                        $('#motor_array_price').text(obj[width_key].motor_array);
                                        $("#motor_arr_pri").val(obj[width_key].motor_array);
                                        // console.log(obj[key].motor_array);
                                    }

                                    while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) {
                                        if ((parseInt(length_calc) > parseInt(length_calc_val))) {
                                            length_key--;
                                        }
                                        // code ..
                                        if (obj[length_key].width == width_calc) {
                                            // console.log("length: ", obj[length_key]);
                                            console.log(obj)
                                            $('#shade_price').text(obj[length_key].price);
                                            // console.log(obj[length_key].price);
                                            $('#shade_amount').val(obj[length_key].price);
                                            return false;
                                        }
                                    }
                                    return false;
                                }
                            }
                        }
                    }
                    grandTotalCalc();

                });
            }
            $("#txt_len").text($('#length option:selected').text() + ' (' + $('#len_decimal option:selected').text() + ')');
            $("#txt_wid").text($('#width option:selected').text() + ' (' + $('#wid_decimal option:selected').text() + ')');
        });

        $('#cassette_type').on('change', function() {
            var v1 = $(this).children("option:selected").val();
            // console.log(v1);
            if (v1 == 'square_cassette') {
                // $('#cassette_price').text($(this).attr("data-cassette-type-price"));
                // $('#casprice').val($('#cassette_price').text());
            } else if (v1 == 'std_r_cassette') {
                // $('#cassette_price').text($(this).attr("data-stdcas-price"));
                // $('#casprice').val($('#cassette_price').text());
            } else if (v1 == 'priced_round_cassette') {
                // $('#cassette_price').text($(this).attr("data-roundcas-price"));
                // $('#casprice').val($('#cassette_price').text());
            } else {
                // $('#cassette_price').text('0');
                // $('#casprice').val($('#cassette_price').text());
            }
            grandTotalCalc();
        });

        $("#wrap_expose").on('change', function() {
            // var v1 = $(this).children("option:checked").val();
            var v1 = $("#wrap_expose option:selected").text();
            // console.log(v1);
            // if(v1 == 'Default') {
            //     $('#wrap_price').text('0');
            //     $('#wrap_exp_price').val('0');
            // }else if(v1 == 'Exposed'){
            //     $('#wrap_price').text('0');
            //     $('#wrap_exp_price').val('0');
            // }
            // grandTotalCalc();
        });

        //Total
        // grandTotalCalc();

        //Accordion out of view issue fix
        $('.collapse').on('shown.bs.collapse', function(e) {
            var $card = $(this).closest('.card');
            $('html,body').animate({
                scrollTop: $card.offset().top
            }, 500);
        });

        $(function() {
            // $( "#duedate" ).datepicker();
            // $( "#duedate" ).datepicker("setDate", "+3");
            // $( "#duedate" ).datepicker({ minDate: +3});
            // $( "#duedate" ).datepicker({ minDate: +0});
        });

        //Room type & Window Description Relatino
        $('#room_type').change(function() {
            if (($('#room_type option:selected').text()).toLowerCase() == 'other') {
                $("#window_desc").removeClass("hide");
                $("label[for='window_desc']").removeClass("hide");
            } else {
                $("#window_desc").addClass("hide");
                $("label[for='window_desc']").addClass("hide");
            }
        });

        // Ajax for feature price Cassette & Wrapped Fabric
        $('.get_fts_prices').on('change', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var width = $('#width option:selected').val() ? $('#width option:selected').val() : -1;
            var fraction = $('#wid_decimal option:selected').val() ? $('#wid_decimal option:selected').val() : -1;
            // var cassette_code = $('#cassette_type option:selected').val() ? $('#cassette_type option:selected').val():-1;
            if ($('#cassette_type option:selected').val() != 0) {
                var cassette_code = $('#cassette_type option:selected').val();
            } else {
                var cassette_code = -1;
            }
            if ($('#cassette_type option:selected').val() == "Open Roller") {
                var cassette_code = -1;
            }
            if ($("#wrap_expose").length) {
                if ($('#wrap_expose option:selected').val() != 0) {
                    var wrap_code = $('#wrap_expose option:selected').val();
                } else {
                    var wrap_code = -1;
                }
            } else {
                var wrap_code = -1;
            }
            $.ajax({
                url: "{{ url('/features/getmyprice') }}",
                type: "post",
                dataType: 'json',
                data: {
                    width: width,
                    fraction: fraction,
                    cassette_code: cassette_code,
                    wrap_code: wrap_code
                },
                success: function(result) {
                    // $('#cassette_price').text(result);
                    // $('#cassette_price').text(result);
                    $('#cassette_price').text(result[0].cassette_price);
                    $('#wrap_price').text(result[0].wrap_price);
                    grandTotalCalc();
                }
            });
        });


        var motor_arrprice = 0;
        // Ajax for width price
        $('.wm_price').on('change', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var width = $('#width option:selected').val() ? $('#width option:selected').val() : 0;
            var decimal = $('#wid_decimal option:selected').val() ? $('#wid_decimal option:selected').val() : 0;
            var max = "{{ $wid_motor_max ?? 0 }}";
            var code = "{{ $ct_wid_motors->ct_widmotor_code ?? 0 }}";
            $.ajax({
                url: "{{ url('/features/wid_motor_price') }}",
                type: "post",
                dataType: 'json',
                data: {
                    width: width,
                    fraction: decimal,
                    max: max,
                    code: code
                },
                success: function(result) {
                    // console.log(result);
                    $('#ctype_arrprice').text(result);
                    motor_arrprice = result;
                }
            });
        });

        // Cassette Color
        $(document).on('change', '#cassette_type', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if ($('#cassette_type option:selected').text() == "Open Roller") {
                $('#cassette_color').find('option').remove();
                $('#cassette_color').append(`
                    <option value="default">Default</option>
                `);
                return;
            }
            var cass_id = $('#cassette_type option:selected').data('cassette-id') ? $('#cassette_type option:selected').data('cassette-id') : 0;
            $.ajax({
                url: "{{ route('cassette.color') }}",
                type: "post",
                data: {
                    cass_id: cass_id
                },
                success: function(result) {
                    $('#cassette_color').find('option').remove();
                    $('#cassette_color').append(result);
                    let clr = $('#cassette_color').data('value');
                    $(`#cassette_color option:contains("${clr}")`).prop('selected', true);

                },
                error: function() {}
            });
        });




        var key = 0,
            product = {};

        function add_to_cart() {
            // validate_form();
            var dealer_name = $('#dealer_name').val() ? $('#dealer_name').val() : '';
            var cust_side_mark = $('#cust_side_mark').val() ? $('#cust_side_mark').val() : '';
            // var project_tag = $('#project_tag').val() ? $('#project_tag').val():'';
            var order_number = $('#order_number').val() ? $('#order_number').val() : '';
            var room_type = $('#room_type option:selected').text() ? $('#room_type option:selected').text() : '';
            var window_desc = $('#window_desc').val() ? $('#window_desc').val() : '';

            var quantity = $('#quantity').val() ? $('#quantity').val() : '';
            var width = $('#width').val() ? $('#width').val() : '';
            var wid_decimal = $('#wid_decimal').val() ? $('#wid_decimal').val() : '';
            var length = $('#length').val() ? $('#length').val() : '';
            var len_decimal = $('#len_decimal').val() ? $('#len_decimal').val() : '';

            var fabric = $('#fabric option:selected').text() ? $('#fabric option:selected').text() : '';
            fabric = fabric.trim();
            var brackets = $('#brackets option:selected').text() ? $('#brackets option:selected').text() : '';
            var sp_instructions = $('#sp_instructions').val() ? $('#sp_instructions').val() : '';

            //Product Info
            var prod_id = $('#id').val() ? $('#id').val() : '';
            var img_url = $('#main_img').prop('src') ? $('#main_img').prop('src') : '';
            var prod_name = $('#product_name').text() ? $('#product_name').text() : '';
            // var due_date = $('#duedate').val() ? $('#duedate').val():'';

            //Price
            var price = $('#discount_txt').text() ? $('#discount_txt').text() : '';
            var suggested_price_prod = $("#ttl_price").text() ? $("#ttl_price").text() : 0;
            var disc_percent = $('#disc_percent').val() ? $('#disc_percent').val() : '';
            var shade_price = $('#shade_price').text() ? $('#shade_price').text() : '';
            var cassette_type = $('#cassette_type option:selected').val() ? $('#cassette_type option:selected').val() : '';
            var cassette_price = $('#cassette_price').text() ? $('#cassette_price').text() : '';
            var cassette_color = $('#cassette_color option:selected').text() ? $('#cassette_color option:selected').text() : '';
            let total_bottom_rail_price = parseFloat($("#bottom_rail option:selected").data("price") ?? 0) ?? 0;
            var bottom_rail = $("#bottom_rail option:selected").val();
            var bottom_rail_color = $("#bottom_rail_color option:selected").val();
            var mount_price = $('#mount option:selected').val() ? $('#mount option:selected').val() : '';
            var mount_type = $('#mount option:selected').text() ? $('#mount option:selected').text() : '';
            var mount_pos = $('#mount_pos option:selected').text() ? $('#mount_pos option:selected').text() : '';
            var wrap_expose = $('#wrap_expose option:selected').val() ? $('#wrap_expose option:selected').val() : '';
            var wrap_price = $('#wrap_price').text() ? $('#wrap_price').text() : '';
            var brackets_opt = $('#brackets_opt option:selected').text() ? $('#brackets_opt option:selected').text() : '';
            var brackets_opt_price = $('#brackets_opt option:selected').val() ? $('#brackets_opt option:selected').val() : '';
            var stack = $('#stack option:selected').text() ? $('#stack option:selected').text() : '';
            if ($('#spring_chk').is(":checked") == false) {
                var spring_assist = '';
            } else {
                var spring_assist = $('#spring_chk').val() ? $('#spring_chk').val() : '';
            }

            var control_type = $('input[name="controltype"]:checked').val() ? $('input[name="controltype"]:checked').val() : '';
            if ($('#motor_type option:selected').val() != '') {
                var motor_name = $('#motor_type option:selected').text() ? $('#motor_type option:selected').text() : '';
            } else {
                var motor_name = '';
            }
            var motor_pos = $('#motor_pos option:selected').text() ? $('#motor_pos option:selected').text() : '';
            var motor_price = $('#ctype_price').text() ? $('#ctype_price').text() : '';
            if ($('#motor_cntrl option:selected').val() != '') {
                var channel_name = $('#motor_cntrl option:selected').text() ? $('#motor_cntrl option:selected').text() : '';
            } else {
                var channel_name = '';
            }
            var channel_price = $('#ctype_price1').text() ? $('#ctype_price1').text() : '';
            var motor_arr_price = $('#ctype_arrprice').text() ? $('#ctype_arrprice').text() : '';
            if ($('#manual_sel option:selected').val() != '') {
                var chain_cord = $('#manual_sel option:selected').text() ? $('#manual_sel option:selected').text() : '';
            } else {
                var chain_cord = '';
            }
            if ($('#chain_ctrl option:selected').val() != '') {
                var chain_ctrl = $('#chain_ctrl option:selected').text() ? $('#chain_ctrl option:selected').text() : '';
            } else {
                var chain_ctrl = '';
            }
            if ($('#cord_ctrl option:selected').val() != '') {
                var cord_ctrl = $('#cord_ctrl option:selected').text() ? $('#cord_ctrl option:selected').text() : '';
            } else {
                var cord_ctrl = '';
            }
            var chain_color = $('input[name="chaincolor_arr"]:checked').val() ? $('input[name="chaincolor_arr"]:checked').val() : '';
            var cord_color = $('input[name="cordcolor_arr"]:checked').val() ? $('input[name="cordcolor_arr"]:checked').val() : '';

            var plugin_price = $('#plugin_price').text() ? $('#plugin_price').text() : '';
            var solar_price = $('#solar_price').text() ? $('#solar_price').text() : '';
            var hub_price = $('#hub_price').text() ? $('#hub_price').text() : '';
            var transformer_price = $('#transformer_price').text() ? $('#transformer_price').text() : '';

            var product = {
                "prod_id": prod_id,
                "prod_name": prod_name,
                "dealer_name": dealer_name,
                "order_number": order_number,

                "disc_percent": disc_percent,
                "shade_price": shade_price,
                "mount_price": mount_price,
                "mount_type": mount_type,
                "mount_pos": mount_pos,
                "wrap_expose": wrap_expose,
                "wrap_price": wrap_price,
                "bottom_rail_price": total_bottom_rail_price,
                "bottom_rail": bottom_rail,
                "bottom_rail_color": bottom_rail_color,
                "cassette_price": cassette_price,
                "cassette_type": cassette_type,
                "cassette_color": cassette_color,
                "brackets_opt": brackets_opt,
                "brackets_opt_price": brackets_opt_price,
                "spring_assist_price": spring_assist,

                "cust_side_mark": cust_side_mark,

                "room_type": room_type,
                "window_desc": window_desc,
                "quantity": quantity,
                "width": width,
                "wid_decimal": wid_decimal,
                "length": length,
                "len_decimal": len_decimal,
                "fabric": fabric,
                "stack": stack,
                "brackets": brackets,

                "control_type": control_type,
                "motor_name": motor_name,
                "motor_pos": motor_pos,
                "motor_price": motor_price,
                "motor_arr_price": motor_arr_price,
                "channel_name": channel_name,
                "channel_price": channel_price,
                "plugin_price": plugin_price,
                "solar_price": solar_price,
                "hub_price": hub_price,
                "transformer_price": transformer_price,

                "chain_cord": chain_cord,
                "chain_ctrl": chain_ctrl,
                "chain_color": chain_color,
                "cord_ctrl": cord_ctrl,
                "cord_color": cord_color,

                "sp_instructions": sp_instructions,
                "main_img": img_url,
                "price": parseFloat(price / quantity).toFixed(2),
                "total": price,
                "suggested_price": suggested_price_prod,
                "parts": 0
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('seller_orders.orders.update', $order->id) }}",
                type: 'POST',
                data: {
                    'product': product
                },
                success: function(result) {
                    if (result.msg == 'success') {
                        window.location.href = `{{ route('seller_orders.get_lineitems', $main_order->id) }}`;
                    } else {
                        alert('Please try again.');
                    }
                }
            });



        }


        $('#button').click(function() {
            $('#collapseEleven').removeClass('collapse');
            $('#collapseTwo').removeClass('collapse');
            $('#collapseFour').removeClass('collapse');
            $('#collapseFour').removeClass('collapse');
            $('#collapseFive').removeClass('collapse');
            $('#collapseSix').removeClass('collapse');
            $('#collapseSeven').removeClass('collapse');
            $('#collapseEight').removeClass('collapse');
            $('#collapseThirteen').removeClass('collapse');
            $('#collapseFifteen').removeClass('collapse');
            $('#collapseThree').removeClass('collapse');

        });

        // $('#add_more').click(function () {
        //     $('#collapseEleven').removeClass('collapse');
        //     $('#collapseTwo').removeClass('collapse');
        //     $('#collapseFour').removeClass('collapse');
        //     $('#collapseFour').removeClass('collapse');
        //     $('#collapseFive').removeClass('collapse');    
        //     $('#collapseSix').removeClass('collapse');
        //     $('#collapseSeven').removeClass('collapse');
        //     $('#collapseEight').removeClass('collapse');
        //     $('#collapseThirteen').removeClass('collapse');
        //     $('#collapseFifteen').removeClass('collapse');
        //     $('#collapseThree').removeClass('collapse');

        // });

        // $('form').bind('submit', function (e) {
        //     if (confirm("Do you want to submit this order? No change or cancellation accepted after placing the order.")) {
        //         add_to_cart();
        //         return true;
        //     } else {
        //         return false;
        //     }
        // });

        // validate the form for duplicate
        function validateForm() {
            var valid = false;

            var room_type = $("#room_type").val();
            var quantity = $("#quantity").val();
            var width = $("#width").val();
            var length = $("#length").val();
            var mount = $("#mount").val();
            var cassette_type = $("#cassette_type").val();
            var cassette_color = $("#cassette_color").val();
            var wrap_expose = $("#wrap_expose").val();
            var brackets = $("#brackets").val();

            var room_type = $("#room_type").val();
            if (room_type && quantity && width && length && mount && cassette_type &&
                cassette_color && wrap_expose && brackets) {
                valid = true;
            }
            return valid;
        }


        $('form').bind('submit', function(e) {
            e.preventDefault();
            if (confirm("Do you want to save changes?")) {
                add_to_cart();

                return false;
            } else {
                return false;
            }
        });
        $(document).ready(function() {
            var obj_price = '<?php echo json_encode($price_arr); ?>';
            obj = JSON.parse(obj_price);
            coupon_obj = '<?php echo json_encode($coupon_arr); ?>';
            coupon_obj = JSON.parse(coupon_obj);
            // console.log(obj);
            // var price_json = JSON.stringify(obj_price);
            // console.log(obj[35]['price']);
            // console.log(obj);

            //Trigger all change events

            $('#width').trigger("change");
            $('#length').trigger("change");

            $("#input[name=delivery_chk]").trigger("change");
            $("#mount_price").trigger("change");
            $("#fabric").trigger("change");
            $("#wrap_expose").trigger("change");
            $("#cassette_type").trigger("change");
            $("#bottom_rail").trigger("change");
            $("#cassette_color").trigger("change");
            $("#brackets").trigger("change");
            $("#brackets_opt").trigger("change");
            $("#spring_chk").trigger("change");
            $("#shad_wand_len").trigger("change");
            $("#shad_wand_side").trigger("change");

            $("clr_addons").trigger("change");
            $("#room_type").trigger("change");
            $(".get_fts_prices").trigger("change");
            $(".wm_price").trigger("change");

            $('#fabric').trigger("change");
            $('#mount').trigger("change");
            $('#mount_pos').trigger("change");
            $('#stack').trigger("change");
            $('#brackets').trigger("change");
            $('#quantity').trigger("change");

            $('#wand_length').trigger("change");
            $('#wand_ctrl').trigger("change");

            $('#mount').trigger("change");
            $('#mount_pos').trigger("change");
            $("#cassette_type").trigger("change");
            $('.calc_prices').trigger("change");

            if ($("#manual")[0].checked) {
                if ($("#manual_sel option:selected").text() == "Chain") {
                    $("#chain_ctrl").trigger("change");
                    $('.chain_colors').trigger("change");
                }
                if ($("#manual_sel option:selected").text() == "Cord") {
                    $('#cord_ctrl').trigger("change");
                    $('.cord_colors').trigger("click");
                    $('.cord_colors').trigger("change");
                }
            }
            if ($("#motorization")[0].checked) {
                $("shadoesmart_hub").trigger("change");
                $("shadoesmart_transformer").trigger("change");
                $("solar_panel").trigger("change");
                $("plug_in_charger").trigger("change");
                $("input[name=plugin_charger]:checked").trigger("click");
                $("input[name=solar_panel]:checked").trigger("click");
                $("input[name=shade_smart_hub]:checked").trigger("click");
                $("input[name=shade_smart_transformers]:checked").trigger("click");
                $('#somfy_list').trigger("change");
                $('#motor_type').trigger("change");
                $('#motor_type').trigger("click");
                $('#motor_cntrl').trigger("change");
            }

        });
    </script>
@endsection
