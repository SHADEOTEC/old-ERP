<div class="row gutters-5">
    <div class="col-lg-8">
        <input name="_method" type="hidden" value="POST">
        <input type="hidden" name="lang" value="{{ $lang }}">
        <input type="hidden" name="id" id="id" value="{{ $product->id }}">
        <input type="hidden" id="price_tag_id" name="price_tag_id" value="{{ $product->category->price_tag }}">
        <input type="hidden" id="disc_percent" name="disc_percent" value="{{ ($cust_discount) ? $cust_discount->disc_percent : '' }}">
        @csrf
        <input type="hidden" name="added_by" value="seller">
        <!-- Product Info Card -->
        <div class="card pt-4">
            <!--div class="d-flex justify-content-center align-items-start"-->
            <div class="d-flex align-items-start pl-3">
                <div>
                    <!-- <img src="{{ url('assets/img/products').'/'.$product->thumbnail_img }}" width="250px" class="img-fluid"/> -->
                    <img src="{{ static_asset('products/images/').'/'.$product->thumbnail_img }}" id="main_img" width="235px" height="200px" class=""/>
                </div>
                <div class="pr-2 pl-2 pb-2 pt-0">
                    <p class="font-weight-bold" name="product_name" id="product_name">{{$product->name}}</p>
                    <p class="font-weight-bold">Description</p>
                    <p class="font-weight-lighter" id="shade_desc">{{strip_tags($product->description)}}</p>
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
                        <input type="text" class="form-control" name="dealer_name" id="dealer_name" placeholder="Valid full name is required." value="{{Auth::user()->name}}" readonly>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 pt-2">
                        <label for="">Customer Side Mark</label>
                        <input type="text" class="form-control" name="cust_side_mark" id="cust_side_mark"
                        @if(isset($cust_discount->cs_mark))
                            value="{{$cust_discount->cs_mark}}"
                        @else
                            value=""
                        @endif
                         readonly placeholder="">
                    </div>
                    
                    <div class="col-6 col-md-6 col-lg-6 pt-2">
                        <label for="">Invoice Number</label>
                        <input type="text" class="form-control" name="inv_num" id="inv_num" value="{{$invoice->values}}" required readonly>
                        <input type="text" class="form-control hide" name="order_number" id="order_number"  placeholder="" required value="{{Auth::id().'-'.time().'-'.$product->id}}" readonly>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="accordion" id="add_to_cart">
            <!-- ROOM TYPE -->
            <div class="card">
                <div class="card-header p-2" id="room" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
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
                                    @foreach($roomtype as $item)
                                        @if($item->xztroomtype->state == 'Active')
                                            <option value="{{$item->roomtype_id}}">{{$item->xztroomtype->name}}</option>
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
                        <button class="btn btn-link btn-block text-left collapsed" type="button" >
                        QUANTITY & MEASUREMENTS
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="qty_measure" data-parent="#add_to_cart">
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <div class="col-12 col-md-12 col-lg-12 pt-2">
                                <label for="">Quantity</label>
                                <select class="form-control" name="quantity" id="quantity" required>
                                    <option value="">Select Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>                                    
                                <!-- <input type="text" class="form-control" placeholder="" name="quantity" id="quantity" required> -->
                            </div>
                            
                            <div class="col-12 col-md-6 col-lg-6 pt-2">
                                <label for="">Width</label>
                                <div class="d-flex flex-row mb-3">
                                    <div class="flex-fill" style="width:60%">
                                        <select class="form-control calc_prices get_fts_prices @if(isset($ct_wid_motors) && !empty($ct_wid_motors))wm_price @endif" name="width" id="width"  required style="font-size:13px;">
                                            <option value="">Select Width</option>
                                            @foreach($distinct_wid as $key => $item)
                                                @if ($key == 0)
                                                    @for($j = 12 ; $j < $item->width; $j++)
                                                    <option data-price={{ $item->width }} value="{{$j}}">{{$j}}</option>
                                                    @endfor
                                                @endif
                                                <?php $i = 0 ?>
                                                <option data-price={{ $item->width }} value="{{$item->width}}">{{$item->width}}</option>
                                                @while(isset($distinct_wid[$key + 1]) &&$distinct_wid[$key + 1]->width != $item->width + ++$i)
                                                <option data-price={{ $distinct_wid[$key + 1]->width }} value="{{$item->width + $i}}">{{$item->width + $i}}</option>
                                                @endwhile
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex-fill" style="width:40%">
                                        <select class="form-control calc_prices get_fts_prices @if(isset($ct_wid_motors) && !empty($ct_wid_motors))wm_price @endif" name="wid_decimal" id="wid_decimal" style="font-size:13px;">
                                            <option selected  value="0">Even</option>
                                            <option value="0.125">1/8</option>
                                            <option value="0.25">1/4</option>
                                            <option value="0.375">3/8</option>
                                            <option value="0.5">1/2</option>
                                            <option value="0.625">5/8</option>
                                            <option value="0.75">3/4</option>
                                            <option value="0.875">7/8</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 pt-2">
                                <label for="">Length</label>
                                <div class="d-flex flex-row mb-3">
                                    <div class="flex-fill" style="width:60%">
                                    <select class="form-control calc_prices get_fts_prices @if(isset($ct_wid_motors) && !empty($ct_wid_motors))wm_price @endif" name="length" id="length" required style="font-size:13px;">
                                        <option value="">Select Length</option>
                                        @foreach($distinct_len as $key => $item)
                                                @if ($key == 0)
                                                    @for($j = 12 ; $j < $item->length; $j++)
                                                    <option data-price={{ $item->length }} value="{{$j}}">{{$j}}</option>
                                                    @endfor
                                                @endif
                                            <?php $i = 0 ?>
                                            <option data-price={{ $item->length }} value="{{$item->length}}">{{$item->length}}</option>
                                            @while(isset($distinct_len[$key + 1]) &&$distinct_len[$key + 1]->length != $item->length + ++$i)
                                                <option data-price={{ $distinct_len[$key + 1]->length }} value="{{$item->length + $i}}">{{$item->length + $i}}</option>
                                                @endwhile
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="flex-fill" style="width:40%">
                                        <select class="form-control calc_prices get_fts_prices @if(isset($ct_wid_motors) && !empty($ct_wid_motors))wm_price @endif" name="len_decimal" id="len_decimal" style="font-size:13px;">
                                            <option selected  value="0">Even</option>
                                            <option value="0.125">1/8</option>
                                            <option value="0.25">1/4</option>
                                            <option value="0.375">3/8</option>
                                            <option value="0.5">1/2</option>
                                            <option value="0.625">5/8</option>
                                            <option value="0.75">3/4</option>
                                            <option value="0.875">7/8</option>
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
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
                        CONTROL TYPE
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="Control Type" data-parent="#add_to_cart">
                    <div class="card-body">
                        <div class="form-group row mb-1">
                            <div class="col-12 col-md-12 col-lg-12 pt-2">
                                <div class="form-check d-inline mr-2">
                                    <input class="form-check-input" type="radio" name="controltype" id="motorization" value="motor">
                                    <label class="form-check-label" for="motorization">
                                    Motorization
                                    </label>
                                </div>
                                <div class="form-check d-inline mr-2">
                                    <input class="form-check-input" type="radio" name="controltype" id="manual" value="manual">
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
                                    <option value="Default">Default</option>
                                    <option value="Right">Right</option>
                                    <option value="Left">Left</option>
                                </select>
                                <select class="form-control hide mb-3 mt-3" name="motor_type" id="motor_type">
                                    <option value="">Select your Motor type</option>
                                    @foreach($ct_motors as $item)
                                    @if($item->motor->state == 'Active')
                                    <option value="{{$item->motor->price}}" data-motor-price={{$item->motor->ct_code}}>{{$item->motor->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <input type="hidden" name="motor_name" id="motor_name" value="">
                                <!-- Sub lists -->
                                <select class="form-control hide mb-3 mt-3" name="shad_wand_len" id="shad_wand_len">
                                    <option  value="">Select wand length</option>
                                    <option value="1ft">1ft</option>
                                    <option value="2ft">2ft</option>
                                    <option value="3ft">3ft</option>
                                    <option value="4ft">4ft</option>
                                    <option value="5ft">5ft</option>
                                </select>
                                <select class="form-control hide mb-3 mt-3" name="shad_wand_side" id="shad_wand_side">
                                    <option  value="">Select control side</option>
                                    <option value="Right">Right</option>
                                    <option value="Left">Left</option>
                                </select>
                                <select class="form-control hide mb-3 mt-3" name="motor_cntrl" id="motor_cntrl">
                                    <option value="">Select your Remote</option>
                                    <option value="30">1 Channel</option>
                                    <option value="33">2 Channel</option>
                                    <option value="35">5 Channel</option>
                                    <option value="40">15 Channel</option>
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
                                    <option>Chain</option>
                                    <option>Cord</option>
                                </select>

                                <div class="chain_color_box hide">
                                    <label class="form-check-label pt-1" for="" style="color:#e62e04;">Color</label>
                                </div>
                                <div class="col-4 chain_color_box hide mt-2 mb-2 pl-4">
                                    <input type="checkbox" class="form-check-input chain_colors" value="White" id="chain_white" name="chaincolor_arr">
                                    <label class="form-check-label pt-1" for="chain_white" style="font-size:0.75rem;">White</label>
                                </div>
                                <div class="chain_color_box hide mb-2 pl-4">
                                    <input type="checkbox" class="form-check-input chain_colors" value="Black" id="chain_black" name="chaincolor_arr">
                                    <label class="form-check-label pt-1" for="chain_black" style="font-size:0.75rem;">Black</label>
                                </div>
                                <div class="chain_color_box hide mb-2 pl-4">
                                    <input type="checkbox" class="form-check-input chain_colors" value="Steel" id="chain_steel" name="chaincolor_arr">
                                    <label class="form-check-label pt-1" for="chain_steel" style="font-size:0.75rem;">Steel</label>
                                </div>

                                <div class="cord_color_box hide">
                                    <label class="form-check-label pt-1" for="" style="color:#e62e04;">Color</label>
                                </div>
                                <div class="cord_color_box hide mb-2 pl-4">
                                    <input type="checkbox" class="form-check-input cord_colors" value="Default" id="cord_default" name="cordcolor_arr">
                                    <label class="form-check-label pt-1" for="cord_default" style="font-size:0.75rem;">Default</label>
                                </div>
                                <div class="cord_color_box hide mt-2 mb-2 pl-4">
                                    <input type="checkbox" class="form-check-input cord_colors" value="White" id="cord_white" name="cordcolor_arr">
                                    <label class="form-check-label pt-1" for="cord_white" style="font-size:0.75rem;">White</label>
                                </div>
                                <div class="cord_color_box hide mb-2 pl-4">
                                    <input type="checkbox" class="form-check-input cord_colors" value="Grey" id="cord_grey" name="cordcolor_arr">
                                    <label class="form-check-label pt-1" for="cord_grey" style="font-size:0.75rem;">Grey</label>
                                </div>
                                <div class="cord_color_box hide mb-2 pl-4">
                                    <input type="checkbox" class="form-check-input cord_colors" value="Beige" id="cord_beige" name="cordcolor_arr">
                                    <label class="form-check-label pt-1" for="cord_beige" style="font-size:0.75rem;">Beige</label>
                                </div>
                                <div class="cord_color_box hide mb-2 pl-4">
                                    <input type="checkbox" class="form-check-input cord_colors" value="Black" id="cord_black" name="cordcolor_arr">
                                    <label class="form-check-label pt-1" for="cord_black" style="font-size:0.75rem;">Black</label>
                                </div>
                                <div class="cord_color_box hide mb-2 pl-4">
                                    <input type="checkbox" class="form-check-input cord_colors" value="Brown" id="cord_brown" name="cordcolor_arr">
                                    <label class="form-check-label pt-1" for="cord_brown" style="font-size:0.75rem;">Brown</label>
                                </div>

                                <div class="mt-3 mb-3">
                                    <p class="form-check-label hide" for="motorization" id="manual_control_pos_hdng" style="color:#e62e04;">
                                        Control Position
                                    </p>
                                </div>
                                <select class="form-control hide mb-3 mt-3" name="chain_ctrl" id="chain_ctrl">
                                    <option value="">Select your chain control side</option>
                                    @foreach($ct_manuals as $item)
                                        @if(stripos($item->manual->ct_code, 'chain') !== false)
                                        <option value="{{$item->manual->ct_code}}" data-man-img={{$item->manual->image}}>{{$item->manual->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                                <select class="form-control hide mb-3 mt-3" name="cord_ctrl" id="cord_ctrl">
                                    <option value="">Select your cord control side</option>
                                    @foreach($ct_manuals as $item)
                                        @if(stripos($item->manual->ct_code, 'cord') !== false)
                                        <option value="{{$item->manual->ct_code}}" data-man-img="{{$item->manual->image}}">{{$item->manual->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                <div class="row ml-1 mb-2 hide smart_opts">
                                    <div class="col">
                                        <label class="form-check-label pt-1" for="plugin_charger" style="font-size:0.75rem;">Plugin Charger</label>
                                        <div>
                                            <input type="radio" name="plugin_charger" class="smart_radios" value="35" /> Yes
                                            <input type="radio" name="plugin_charger" class="smart_radios" value="0" checked/> No
                                        </div>
                                    </div>
                                </div>

                                <div class="row ml-1 mb-2 hide smart_opts">
                                    <div class="col">
                                        <label class="form-check-label pt-1" for="solar_panel" style="font-size:0.75rem;">Solar Panel</label>
                                        <div>
                                            <input type="radio" name="solar_panel" class="smart_radios" value="35" /> Yes
                                            <input type="radio" name="solar_panel" class="smart_radios" value="0" checked/> No
                                        </div>
                                    </div>
                                </div>

                                <div class="row ml-1 mb-2 hide smart_opts">
                                    <div class="col">
                                        <label class="form-check-label pt-1" for="shade_smart_hub" style="font-size:0.75rem;">Shade Smart Hub</label>
                                        <div>
                                            <input type="radio" name="shade_smart_hub" class="smart_radios" value="175" /> Yes
                                            <input type="radio" name="shade_smart_hub" class="smart_radios" value="0" checked/> No
                                        </div>
                                    </div>
                                </div>

                                <div class="row ml-1 mb-2 hide smart_opts">
                                    <div class="col">
                                        <label class="form-check-label pt-1" for="shade_smart_transformers" style="font-size:0.75rem;">Shade Smart Transformers</label>
                                        <div>
                                            <input type="radio" name="shade_smart_transformers" class="smart_radios" value="200" /> Yes
                                            <input type="radio" name="shade_smart_transformers" class="smart_radios"value="0" checked/> No
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
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
                        MOUNT
                        </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="m-type" data-parent="#add_to_cart">
                    <div class="card-body">
                        <!-- <div class="col-12 col-md-12 col-lg-12 pt-2">
                            <select class="form-control" name="mount_pos" id="mount_pos" required>
                                <option value="">Select Mount Position</option>
                                    @foreach($mountpos as $item)
                                        @if($item->state == 'Active')
                                            <option data-mountposimg={{ $item->image }} value="{{$item->position}}">{{$item->position}}</option>
                                        @endif
                                    @endforeach
                            </select>
                            <input type="hidden" id="mount_type" name="mount_type" value="">
                        </div> -->
                        <div class="col-6 col-md-6 col-lg-6 pt-2 mb-3 d-none">
                            <img id="mount_pos_img" src="{{ static_asset('assets/img/mount/unnamed.jpg') }}" class="hide mt-4 img-fluid" width="200px" />
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 pt-2">
                            <select class="form-control" name="mount" id="mount" required>
                                <option value="">Select Mount</option>
                                    @foreach($mount as $item)
                                        @if($item->xztmount->state == 'Active')
                                            <option data-mountimg={{ $item->xztmount->image }} value="{{$item->xztmount->price}}">{{$item->xztmount->name}}</option>
                                        @endif
                                    @endforeach
                            </select>
                            <input type="hidden" id="mount_type" name="mount_type" value="">
                        </div>
                        <div class="col-6 col-md-6 col-lg-6 pt-2 mb-3">
                            <img id="mount_img" src="{{ static_asset('assets/img/mount/unnamed.jpg') }}" class="hide mt-4 img-fluid" width="200px" />
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Fabric Selection -->
            <div class="card">
                <div class="card-header p-2" id="fab_sel" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
                        FABRIC SELECTION
                        </button>
                    </h2>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="fab_sel" data-parent="#add_to_cart">
                    <div class="card-body">
                        <div class="col-12 col-md-12 col-lg-12 pt-2">
                            <!--select class="form-control" name="fabric" id="fabric" >
                                @foreach($fabric_all as $item)
                                <option data-img={{ $item->fabric_img }} value="{{$item->id}}">{{$item->fabric_name}}</option>
                                @endforeach
                            </select>
                            <img id="fabric_img" src="" class="hide mt-4 img-fluid" width="200px" /-->
                            <select class="form-control" name="fabric" id="fabric" required>
                                <option value="">Select Fabric</option>
                                @foreach($fabric as $item)
                                @if($item->xztfabric->show_in_gallery == 'Yes')
                                <option data-img="{{ $item->xztfabric->url }}" data-fab-specs="{{ $item->xztfabric->fab_specs }}" value="{{$item->fabric_id}}">{{$item->xztfabric->name}}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="spinner-border m-5 hide" role="status" id="img_spinner">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <img id="fabric_img" src="" class="hide mt-4" width="200px" height="200px"/>
                            <p id="fab_det" class="mt-4"></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cassette Options -->
            <div class="card">
                <div class="card-header p-2" id="cas_opt" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
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
                                    <option value="">Select Cassette</option>
                                        <!--option value="0">Round Cassette</option-->
                                        @foreach($cassette as $item)
                                        @if($item->xztcassette->state == 'Active')
                                            <option value="{{$item->xztcassette->cassette_code}}" data-cassette-id="{{$item->xztcassette->id}}">{{$item->xztcassette->name}}</option>
                                        @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 pt-2">
                                <label for="">Cassette Color</label>
                                <select class="form-control" name="cassette_color" id="cassette_color" required>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Wrapped/Exposed -->
            @if(isset($wrap) && !empty($wrap))
            <div class="card">
                <div class="card-header p-2" id="wrap-exp" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
                        WRAPPED/EXPOSED
                        </button>
                    </h2>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="wrap-exp" data-parent="#add_to_cart">
                    <div class="card-body">
                        <div class="col-12 col-md-12 col-lg-12 pt-2">
                            <select class="form-control get_fts_prices" name="wrap_expose" id="wrap_expose" required>
                                <option value="">Select Wrapped/Exposed</option>
                                <option value="0">Default</option>
                                    @if($wrap->xztwrap->state == 'Active')
                                        <option value="{{$wrap->xztwrap->wrap_code}}">{{$wrap->xztwrap->name}}</option>
                                    @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Brackets -->
            @if(isset($bracket) && count($bracket)>0)
            <div class="card">
                <div class="card-header p-2" id="brkts" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
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
                                    @foreach($bracket as $item)
                                        @if($item->xztbracket->state == 'Active')
                                            <option value="{{$item->id}}" data-bracketimg={{$item->xztbracket->image}}>{{$item->xztbracket->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6 pt-2 mb-3">
                            <img id="bracket_img" src="{{ static_asset('bracket/images/unnamed.jpg') }}" class="hide mt-4 img-fluid" width="200px" />
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Brackets Options-->
            @if($shade_opt->bracket_options)
            @php
                $brkt_opt_chk = 1;
            @endphp
            <div class="card hide" id="brktsoptcard">
                <div class="card-header p-2" id="brktsopt" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
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
                                    <option value="44">Dual Brackets</option>
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
            @if(isset($stack) && count($stack)>0)
            <div class="card" id="stackcard">
                <div class="card-header p-2" id="stackhdr" data-toggle="collapse" data-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
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
                                    @foreach($stack as $item)
                                        @if($item->xztstack->state == 'Active')
                                            <option data-stack-img={{$item->xztstack->image}} value="{{$item->id}}">{{$item->xztstack->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <img id="stack_img" src="{{ asset('stack/images/unnamed.jpg') }}" class="hide pl-3 mt-4 img-fluid" width="200px" />
                            <!--input type="hidden" id="brackets_opt_name" name="brackets_opt_name" value=""-->
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Spring Assist -->
            @if(isset($springassist) && count($springassist)>0)
            @php
                $sa_check = 1;
            @endphp
            <div class="card hide" id="sp_card">
                <div class="card-header p-2" id="sp_assist" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
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
            <div class="card">
                <div class="card-header p-2" id="instr" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button">
                        SPECIAL INSTRUCTIONS
                        </button>
                    </h2>
                </div>
                <div id="collapseTwelve" class="collapse" aria-labelledby="instr" data-parent="#add_to_cart">
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <div class="col-12 col-md-12 col-lg-12 pt-2">
                                <label for="sp_instructions">Special Instructions</label>
                                <textarea class="form-control" id="sp_instructions" name="sp_instructions" rows="3"></textarea>
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
        <h5 style="background-color:#FFF;" class="p-3 mb-4 display_price_box text-center">Price Details</h5>
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
                    <p  class="" id="shade_price"></p>
                </div>
                <input type="hidden" id="shade_amount" name="shade_amount" value="" />
            </div>
        </div>
        <!-- Display Control Type -->
        @if($shade_opt->control_type >0 || $shade_opt->control_type_arr >0)
        <div class="card display_price_box">
            <div class="pt-2 pb-2 pl-3">
                <table style="width: 100%">
                    <thead>
                        <th id="controlhd"> <p class="font-weight-bold">Control Type</p> </th>
                        <th id="controlhdprice"> <p class="font-weight-bold">Price</p> </th>
                    </thead>
                    <tbody>
                        <tr>
                            <p class="font-weight-bold" id="man_type"></p>
                            <td style="width:51%"><p class="" id="txt_ctype"></p></td>
                            <td style="width:49%">
                                @if(isset($ct_wid_motors) && !empty($ct_wid_motors))
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
                            <input type="hidden" id="motor_arr_pri" name="motor_arr_pri" value=""/>
                        </tr>
                        @if($shade_opt->somfy >0)
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
        @if($shade_opt->mount >0)
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
                    <p  class="" id="mount_price"></p>
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
                <!-- <div class="col-md-6">
                    <p class="font-weight-bold">Price</p>
                </div> -->
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
        @if($shade_opt->wrap_expose >0)
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
                    <p  class="" id="wrap_price"></p>
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
                    <p  class="d-inline" id="cassette_price"></p>
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
        @if($shade_opt->brackets >0)
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
                    <p  class="" id="brackets_price"></p>
                </div>
            </div>
        </div>
        @endif
        <!-- Spring Assist -->
        @if($shade_opt->spring_assist >0)
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
                    <p  class="" id="spring_price"></p>
                </div>
            </div>
        </div>
        @endif
        <!-- Display Smart Option -->
        <div class="card display_price_box">
            <div class="pt-2 pb-2 pl-3">
                <div class="row">
                    <div class="col-6 ">
                        <p class="font-weight-bold">Smart Option</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">Price</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 ">
                        <p id="plugin_txt"></p>
                    </div>
                    <div class="col-6">
                        <p id="plugin_price"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 ">
                        <p id="solar_txt"></p>
                    </div>
                    <div class="col-6">
                        <p id="solar_price"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 ">
                        <p id="hub_txt"></p>
                    </div>
                    <div class="col-6">
                        <p id="hub_price"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 ">
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
                    <form id="coupon_form" action="{{url('/xzt.coupon_check')}}" method="post" >
                        @csrf
                        <input type="text" class="form-control mb-3" id="coupon" name="coupon" />
                        <input type="button" class="form-control btn btn-primary text-center" id="coupon_sbmt" name="coupon_sbmt" value="Apply Coupon" style="width:60%;" />
                    </form>
                    <input type="hidden" id="coupon_discount" name="coupon_discount" value=""/>
                </div>
            </div>
        </div>
        <!-- Display Total -->
        <div class="card display_price_box">
            <div class="row pt-2 pb-2 pl-3">
                <table style="width: 100%;font-size: 18px;" class="text-center">
                    <thead class="">
                        <th class="">Total</th>
                        <th class="">Final Price</th>
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
            <div class="row pt-2 pb-2 pl-3 text-center" >
                <div class="col">
                    <button type="submit" name="button" id="button" value="publish" class="btn btn-primary">Add to Cart</button>
                </div>
                <div class="col">
                    <button type="button" id="duplicate-product-cart" class="btn btn-primary">Duplicate</button>
                </div>
                <div class="col">
                    <button type="submit" name="add_more" id="add_more" value="more" class="btn btn-primary">Add More</button>
                </div>
            </div>
        </div>
    </div>
    <!--div class="col-6">
        <div class="mar-all text-right mr-3 mb-5">
            <button type="submit" name="button" id="button" value="publish" class="btn btn-primary">Add to Cart</button>
            <button type="submit" name="button" id="button" value="publish" class="btn btn-primary">Add </button>
        </div>
    </div-->
    <!--div class="col-12">
        <div class="mar-all text-right">
            <button type="button" name="button" id="pdf" value="pdf" class="btn btn-primary" onclick="printJS('choice_form', 'html')">Export to PDF</button>
        </div>
    </div-->
</div>