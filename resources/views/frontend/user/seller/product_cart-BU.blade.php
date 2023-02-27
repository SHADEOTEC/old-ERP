@extends('frontend.layouts.user_panel')
@section('panel_content')
@foreach($errors->all() as $error)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{$error}}</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endforeach

<div class="aiz-titlebar mt-2 mb-2">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Add to Cart') }}</h1>
        </div>
    </div>
</div>
<form class="" action="{{route('xzt.store.order', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
<!-- <form class="" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form"> -->
    <div class="row gutters-5">
        <div class="col-lg-8">
            <input name="_method" type="hidden" value="POST">
            <input type="hidden" name="lang" value="{{ $lang }}">
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" id="price_tag_id" name="price_tag_id" value="{{ $product->category->price_tag }}">
            @csrf
            <input type="hidden" name="added_by" value="seller">
            <!-- Product Info Card -->
            <div class="card pt-4">
                <!--div class="d-flex justify-content-center align-items-start"-->
                <div class="d-flex align-items-start pl-3">
                    <div>
                        <img src="{{ public_path('assets/img/products/').$product->thumbnail_img }}" width="250px" class="img-fluid"/>
                    </div>
                    <div class="pr-2 pl-2 pb-2 pt-0">
                        <p class="font-weight-bold" name="product_name" id="product_name">{{$product->name}}</p>
                        <p class="font-weight-bold">Description</p>
                        <p class="font-weight-lighter" id="shade_desc">{{strip_tags($product->description)}}</p>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="d-inline pt-2 pb-2">Product Details</h6>
                    <div class="form-group row mb-4">
                        <div class="col-12 col-md-6 col-lg-6 pt-2">
                            <label for="">Dealer Name</label>
                            <input type="text" class="form-control" name="dealer_name" placeholder="Valid full name is required." required>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 pt-2">
                            <label for="">Customer Side Mark</label>
                            <input type="text" class="form-control" name="cust_side_mark" value="{{Auth::id().'-'.time().'-'.$product->id}}" readonly placeholder="Enter customer side mark.">
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 pt-2">
                            <label for="">Tags</label>
                            <input type="text" class="form-control" name="project_tag"  placeholder="" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="add_to_cart">
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
                                    <input type="text" class="form-control" placeholder="" name="quantity" id="quantity" required>
                                </div>
                                
                                <div class="col-12 col-md-6 col-lg-6 pt-2">
                                    <label for="">Width</label>
                                    <div class="d-flex flex-row mb-3">
                                        <div class="flex-fill" style="width:60%">
                                            <select class="form-control calc_prices" name="width" id="width"  required>
                                                <option value="">Select Width</option>
                                                @foreach($distinct_wid as $item)
                                                    <option data-price={{ $item->width }} value="{{$item->width}}">{{$item->width}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex-fill" style="width:40%">
                                            <select class="form-control calc_prices" name="wid_decimal" id="wid_decimal">
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
                                        <select class="form-control calc_prices" name="length" id="length" required>
                                            <option value="">Select Length</option>
                                            @foreach($distinct_len as $item)
                                                <option data-price={{ $item->length }} value="{{$item->length}}">{{$item->length}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="flex-fill" style="width:40%">
                                            <select class="form-control calc_prices" name="len_decimal" id="len_decimal">
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
                <!-- Control Type -->
                @if($shade_opt->control_type >0 || $shade_opt->control_type_arr >0)
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
                            <div class="form-group row mb-3">
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
                                    <select class="form-control hide mb-3 mt-3" name="motor_type" id="motor_type">
                                        <option value="">Select your Motor type</option>
                                        @if(stripos($product->name, "willow") !==false || stripos($product->description, "willow") !==false)
                                        <option>110 Volt Motor</option>
                                        @else
                                        <option value="125">Rechargeable Battery Motor</option>
                                        <option value="155">12 Volt Motor</option>
                                        <option value="155">24 Volt Motor</option>
                                        <option value="155">110 Volt Motor</option>
                                        <option value="155">Shadeowand</option>
                                        
                                        @if($shade_opt->somfy >0)
                                        <option value="400">Somfy</option>
                                        @endif
                                        
                                        @endif
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
                                        <option value="25">1 Channel</option>
                                        <option value="25">2 Channel</option>
                                        <option value="25">5 Channel</option>
                                        <option value="40">15 Channel</option>
                                    </select>
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
                                    <select class="form-control hide mb-3 mt-3" name="chain_color" id="chain_color">
                                        <option value="">Select chain color</option>
                                        <option>White</option>
                                        <option>Black</option>
                                        <option>Steel</option>
                                    </select>
                                    <select class="form-control hide mb-3 mt-3" name="chain_ctrl" id="chain_ctrl">
                                        <option value="">Select your chain control side</option>
                                        <option>Right</option>
                                        <option>Left</option>
                                    </select>
                                    <select class="form-control hide mb-3 mt-3" name="cord_ctrl" id="cord_ctrl">
                                        <option value="">Select your cord control side</option>
                                        <option>Standard</option>
                                        <option>Right</option>
                                        <option>Left</option>
                                    </select>
                                    <select class="form-control hide mb-3 mt-3" name="cord_color" id="cord_color">
                                        <option value="">Select your cord color</option>
                                        <option>Standard</option>
                                        <option>White</option>
                                        <option>Ivory</option>
                                        <option>Black</option>
                                        <option>Brown</option>
                                        <option>Grey</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($shade_opt->control_type_arr >0)

                @endif
                <!-- Mount Types -->
                @if($shade_opt->mount >0)
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
                            <div class="col-12 col-md-12 col-lg-12 pt-2">
                                <div class="form-check d-inline mr-2">
                                    <input class="form-check-input" type="radio" data-mount-type="inside" name="mount" id="rad1" value="35">
                                    <label class="form-check-label" for="rad1">
                                    Inside Mount
                                    </label>
                                </div>
                                <div class="form-check d-inline mr-2">
                                    <input class="form-check-input" type="radio" data-mount-type="outside" name="mount" id="rad2" value="35">
                                    <label class="form-check-label" for="rad2">
                                    Outside Mount
                                    </label>
                                </div>
                                <input type="hidden" id="mount_type" name="mount_type" value="">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
                                <select class="form-control" name="fabric" id="fabric" >
                                    <option value="">Select Fabric</option>
                                    @foreach($fab_opt as $item)
                                    <option data-img={{ $item->fabric_image }} value="{{$item->fabric_name}}">{{$item->fabric_name}}</option>
                                    @endforeach
                                </select>
                                
                                <img id="fabric_img" src="" class="hide mt-4 img-fluid" width="200px" />
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Wrapped/Exposed -->
                @if($shade_opt->wrap_expose >0)
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
                                <div class="form-check d-inline mr-2">
                                    <input class="form-check-input" type="radio" name="wrap_expose" id="d_wrp" value="default" >
                                    <label class="form-check-label" for="d_wrp">
                                    Default
                                    </label>
                                </div>
                                <div class="form-check d-inline mr-2">
                                    <input class="form-check-input" type="radio" name="wrap_expose" value="wrap" id="w_exp" data-wrap-expose-price='0'>
                                    <label class="form-check-label" for="w_exp" required>
                                    Wrapped
                                    </label>
                                </div>
                                <div class="form-check d-inline mr-2">
                                    <input class="form-check-input" type="radio" name="wrap_expose" id="w_exp_1" value="exposed">
                                    <label class="form-check-label" for="w_exp_1" >
                                    Exposed
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
                                    <select data-cassette-type-price='0' data-stdcas-price='0' data-roundcas-price='0' class="form-control" name="cassette_type" id="cassette_type">
                                        <option value="default">Default</option>
                                        @if(stripos($product->name, "willow") !==false || stripos($product->description, "willow") !==false)
                                        <option value="priced_round_cassette">Round Cassette</option>
                                        @else
                                        <option value="round_cassette">Round Cassette</option>
                                        @endif
                                        <option value="square_cassette">Square Cassette</option>
                                        @if(stripos($product->name, "roller") !==false || stripos($product->description, "roller") !==false || stripos($product->slug, "roller") !==false)
                                        <option value="std_r_cassette">Standard.R Cassette</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 pt-2">
                                    <label for="">Cassette Color</label>
                                    <select class="form-control" name="cassette_color" id="cassette_color">
                                        <option  value="">Select Color</option>
                                        <option value="black">Black</option>
                                        <option value="white">White</option>
                                        <option value="blue">Blue</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Brackets -->
                @if($shade_opt->brackets >0)
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
                                    <select class="form-control" name="brackets" id="brackets">
                                        <option value="">Select Bracket</option>
                                        <option value="wall">Wall</option>
                                        <option value="cieling">Cieling</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-12 col-md-6 col-lg-6 pt-2">
                                    <select class="form-control hide" name="brackets_opt" id="brackets_opt">
                                        <option value="">Select Bracket Options</option>
                                        <option value="44">Dual Brackets</option>
                                        <option value="76">Intermediate Breackets</option>
                                        <option value="76">Center Support Breackets</option>
                                    </select>
                                </div>
                                <input type="hidden" id="brackets_opt_name" name="brackets_opt_name" value="">
                             </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- Spring Assist -->
                @if($shade_opt->spring_assist >0)
                <div class="card">
                    <div class="card-header p-2" id="sp_assist" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button">
                            SPRING ASSIST
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTen" class="collapse" aria-labelledby="sp_assist" data-parent="#add_to_cart">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <div class="form-check pl-5">
                                    <input type="checkbox" class="form-check-input" value="90" id="spring_chk">
                                    <label class="form-check-label pt-1" for="spring_chk">Add Spring Assist</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- Smart Options and Add ons -->
                <div class="card">
                    <div class="card-header p-2" id="s_o_a_o" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button">
                            SMART OPTIONS AND ADD ONS
                            </button>
                        </h2>
                    </div>
                    <div id="collapseNine" class="collapse" aria-labelledby="s_o_a_o" data-parent="#add_to_cart">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <div class="col-12 col-md-6 col-lg-6 pt-2">
                                    <select multiple class="form-control" name="smart_addons" id="smart_addons" data-role="tagsinput">
                                        <option data-smartprice="175" value="shadoesmart_hub">ShadoeSmart Hub</option>
                                        <option data-smartprice="200" value="shadoesmart_transformer">ShadoeSmart Transformer</option>
                                        <option data-smartprice="75" value="solar_panel">Solar Panel</option>
                                        <option data-smartprice="35" value="plug_in_charger">Plug in Charger</option>
                                    </select>
                                    <button type="button" id="clr_addons" class="mt-1 btn btn-sm btn-secondary">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Billing and Shipping address -->
                <div class="card mb-3">
                    <div class="card-header p-2" id="billing_shipping" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" >
                            BILLING AND SHIPPING ADDRESS
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="billing_shipping" data-parent="#add_to_cart">
                        <div class="form-check" style="padding-left: 8%;padding-top: 2%;" >
                            <input class="form-check-input" type="radio" name="delivery_chk" id="pickup" value="pick" >
                            <label class="form-check-labe pr-5" for="pickup">
                                Pick Up
                            </label>
                            <input class="form-check-input" type="radio" name="delivery_chk" id="deliver" value="ship" checked>
                            <label class="form-check-label" for="deliver">
                                Shipping Address
                            </label>
                        </div>
                        <div class="card-body" id="addr_to_ship">
                            <div class="form-group row mb-3">
                                <div class="col-12 col-md-6 col-lg-6 pt-2">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control for_reqd" name="first_name" required>
                                    <span class="form-text text-muted">Valid first name is required.</span>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 pt-2">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control for_reqd" name="last_name" required>
                                    <span class="form-text text-muted">Valid last name is required.</span>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <label for="">Email <span class="text-muted">(Optional)</span></label>
                                    <input type="email" class="form-control for_reqd" placeholder="you@example.com" name="email" >
                                    <span class="form-text text-muted">Enter a valid email for shipping updates.</span>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control for_reqd" placeholder="1234 Main St." name="address" required>
                                    <span class="form-text text-muted">Enter your shipping address.</span>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <label for="">Address 2 <span class="text-muted">(Optional)</span></label>
                                    <input type="text" class="form-control" placeholder="Appartment or Suite" name="address2">
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 pt-2">
                                    <label for="">Country</label>
                                    <select class="form-control for_reqd" name="country" required>
                                        <option>Choose...</option>
                                        <option>Pakistan</option>
                                    </select>
                                    <span class="form-text text-muted">Select a valid country.</span>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 pt-2">
                                    <label for="">State</label>
                                    <select class="form-control for_reqd" name="state" required>
                                        <option>Choose...</option>
                                        <option>Sindh</option>
                                    </select>
                                    <span class="form-text text-muted">Select a valid state.</span>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 pt-2">
                                    <label for="">Zip</label>
                                    <input type="text" class="form-control for_reqd" placeholder="" name="zip" required>
                                    <span class="form-text text-muted">Zip code required.</span>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="same" id="same_address" name="same_address" checked>
                                        <label class="form-check-label pt-1" for="same_address">
                                        Shipping address is same as my billing address.
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="save_info">
                                        <label class="form-check-label pt-1" for="flexCheckDefault">
                                        Save this information for next time.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Billing Address -->
                        <div class="card-body hide" id="addr_to_bill">
                            <h6 style="color:#e62e04;font-size:0.875rem;">BILLING ADDRESS</h6>
                            <div class="form-group row mb-3">
                                <div class="col-12 col-md-6 col-lg-6 pt-2">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control bill_reqd" name="bil_first_name">
                                    <span class="form-text text-muted">Valid first name is required.</span>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 pt-2">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control bill_reqd" name="bil_last_name">
                                    <span class="form-text text-muted">Valid last name is required.</span>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <label for="">Email <span class="text-muted">(Optional)</span></label>
                                    <input type="email" class="form-control" placeholder="you@example.com" name="bil_email" >
                                    <span class="form-text text-muted">Enter a valid email for billing updates.</span>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control bill_reqd" placeholder="1234 Main St." name="bil_address">
                                    <span class="form-text text-muted">Enter your billing address.</span>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <label for="">Address 2 <span class="text-muted">(Optional)</span></label>
                                    <input type="text" class="form-control" placeholder="Appartment or Suite" name="bil_address2">
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 pt-2">
                                    <label for="">Country</label>
                                    <select class="form-control bill_reqd" name="bil_country">
                                        <option>Choose...</option>
                                        <option>Pakistan</option>
                                    </select>
                                    <span class="form-text text-muted">Select a valid country.</span>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 pt-2">
                                    <label for="">State</label>
                                    <select class="form-control bill_reqd" name="bil_state">
                                        <option>Choose...</option>
                                        <option>Sindh</option>
                                    </select>
                                    <span class="form-text text-muted">Select a valid state.</span>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 pt-2">
                                    <label for="">Zip</label>
                                    <input type="text" class="form-control bill_reqd" placeholder="" name="bil_zip">
                                    <span class="form-text text-muted">Zip code required.</span>
                                </div>
                                <!--div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="same_address" checked>
                                        <label class="form-check-label pt-1" for="flexCheckDefault">
                                        Shipping address is same as my billing address.
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="save_info">
                                        <label class="form-check-label pt-1" for="flexCheckDefault">
                                        Save this information for next time.
                                        </label>
                                    </div>
                                </div-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- 
            P R I C E 
        -->
        <div class="col-lg-4">
            <h5 style="background-color:#FFF;" class="p-3 display_price_box text-center">Price Details</h5>
            <!-- Display Quantity -->
            <div class="card display_price_box">
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
                </div>
            </div>
            <!-- Display Control Type -->
            @if($shade_opt->control_type >0 || $shade_opt->control_type_arr >0)
            <div class="card display_price_box">
                <!--<div class="row pt-3 pl-3 pr-3">-->
                <!--    <div class="col-md-6">-->
                <!--        <p class="font-weight-bold">Control Type</p>-->
                <!--    </div>-->
                <!--    <div class="col-md-6">-->
                <!--        <p class="font-weight-bold">Price</p>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="p-2">
                    <table style="width: 100%">
                        <thead>
                            <th> <p class="font-weight-bold">Control Type</p> </th>
                            <th> <p class="font-weight-bold">Price</p> </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><p class="" id="txt_ctype"></p></td>
                                <td>
                                    @if($shade_opt->control_type_arr >0)
                                    <p class="" id="motor_array_price"></p>
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
                    <!--<div class="col-9 col-sm-9 col-md-9 col-lg-9 text-left">-->
                    <!--    <p class="" id="txt_ctype"></p>-->
                    <!--    <p class="" id="txt_ctype1"></p>-->
                    <!--</div>-->
                    <!--<div class="col-3 col-sm-3 col-md-3 col-lg-3 text-center">-->
                    <!--    @if($shade_opt->control_type_arr >0)-->
                    <!--    <p class="" id="motor_array_price"></p>-->
                    <!--    @else-->
                    <!--    <p class="" id="ctype_price"></p>-->
                    <!--    @endif-->
                    <!--    <p class="" id="ctype_price1"></p>-->
                    <!--    <p class="" id="txt_shad_wand_len"></p>-->
                    <!--    <p class="" id="txt_shad_wand_side"></p>-->
                    <!--</div>-->
                </div>
                <!--@if($shade_opt->somfy >0)-->
                <!--<div class="row">-->
                <!--    <div class="col-9 col-sm-9 col-md-9 col-lg-9 text-left">-->
                <!--        <p class="pl-2" id="txt_somfy_upgrade"></p>-->
                <!--    </div>-->
                <!--    <div class="col-3 col-sm-3 col-md-3 col-lg-3 text-center">-->
                <!--        <p class="pr-2" id="somfy_upgrade_price"></p>-->
                <!--    </div>-->
                <!--</div>-->
                <!--@endif-->
            </div>
            @endif
            <!-- Display Mount -->
            @if($shade_opt->mount >0)
            <div class="card display_price_box">
                <div class="row pl-3 pr-3 pb-3">
                    <div class="col-md-6">
                        <p class="font-weight-bold">Mount</p>
                    </div>
                    <div class="col-md-6">
                        <p class="font-weight-bold">Price</p>
                    </div>
                </div>
                <div class="row pl-3 pr-3 pb-3">
                    <div class="col-md-6">
                        <p class="" id="txt_mount"></p>
                    </div>
                    <div class="col-md-6">
                        <p  class="" id="mount_price"></p>
                    </div>
                </div>
            </div>
            @endif
            <!-- Display Fabric -->
            <div class="card display_price_box">
                <div class="row pl-3 pr-3 pb-3">
                    <div class="col-md-6">
                        <p class="font-weight-bold">Fabric</p>
                    </div>
                    <div class="col-md-6">
                        <p class="font-weight-bold">Price</p>
                    </div>
                </div>
                <div class="row pl-3 pr-3 pb-3">
                    <div class="col-md-6">
                        <p class="" id="txt_fabric"></p>
                    </div>
                    <div class="col-md-6">
                        <p  class="" id="fabric_price"></p>
                    </div>
                </div>
            </div>
            <!-- Display Wrapped -->
            @if($shade_opt->wrap_expose >0)
            <div class="card display_price_box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pt-4">
                        <p class="pl-5 font-weight-bold">Wrapped</p>
                    </div>
                    <div class="pt-4">
                        <p class="pr-5 font-weight-bold">Price</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pb-0">
                        <p class="pl-5" id="txt_wrap"></p>
                    </div>
                    <div class="pb-0">
                        <p  class="pr-5" id="wrap_price"></p>
                    </div>
                    <input type="hidden" id="wrap_exp_price" name="wrap_exp_price" value="">
                </div>
            </div>
            @endif
            <!-- Display Cassette -->
            <div class="card display_price_box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pt-4">
                        <p class="pl-5 font-weight-bold">Cassette</p>
                    </div>
                    <div class="pt-4">
                        <p class="pr-5 font-weight-bold">Price</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <p class="pl-5 d-inline" id="txt_cassette"></p>
                        <p class="d-inline">&nbsp;</p>
                    </div>
                    <div class="">
                        <p  class="pr-5 d-inline" id="cassette_price"></p>
                    </div>
                    <input type="hidden" id="casprice" name="casprice" value="">
                </div>
                <div>
                    <p class="pl-5" id="txt_casscolor"></p>
                </div>      
            </div>
            <!-- Display Brackets -->
            @if($shade_opt->brackets >0)
            <div class="card display_price_box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pt-4">
                        <p class="pl-5 font-weight-bold">Brackets</p>
                    </div>
                    <div class="pt-4">
                        <p class="pr-5 font-weight-bold">Price</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pb-0">
                        <p class="pl-5" id="txt_brackets"></p>
                    </div>
                    <div class="pb-0">
                        <p  class="pr-5" id="brackets_price"></p>
                    </div>
                </div>
            </div>
            @endif
            @if($shade_opt->spring_assist >0)
            <div class="card display_price_box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pt-4">
                        <p class="pl-5 font-weight-bold">Spring Assist</p>
                    </div>
                    <div class="pt-4">
                        <p class="pr-5 font-weight-bold">Price</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pb-0">
                        <p class="pl-5" id="txt_spring"></p>
                    </div>
                    <div class="pb-0">
                        <p  class="pr-5" id="spring_price"></p>
                    </div>
                </div>
            </div>
            @endif
            <!-- Display Smart Option -->
            <div class="card display_price_box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pt-4 font-weight-bold">
                        <p class="pl-2">Smart Option</p>
                    </div>
                    <div class="pt-4">
                        <p class="pr-3 font-weight-bold">Price</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pb-0">
                        <p class="pl-1 pr-5 line-wrap" id="txt_sm_option"></p>
                    </div>
                    <div class="pb-0">
                        <p class="pr-3" id="sm_option_price"></p>
                    </div>
                    <input type="hidden" id="smartopts" name="smartopts" value="">
                    <input type="hidden" id="smartopts_pri" name="smartopts_pri" value="">
                </div>
            </div>
            <!-- Coupon -->
            <div class="card display_price_box">
                <div class="row p-2 mb-3">
                    <div class="col-12 text-center">
                        <p class="font-weight-bold text-center">Coupon</p>
                        <form id="coupon_form" action="{{url('/xzt.coupon_check')}}" method="post" >
                            @csrf
                            <input type="text" class="form-control mb-2" id="coupon" name="coupon" />
                            <input type="button" class="form-control btn btn-primary text-center" id="coupon_sbmt" name="coupon_sbmt" value="Apply Coupon" style="width:60%;" />
                        </form>
                        <input type="hidden" id="coupon_discount" name="coupon_discount" value=""/>
                    </div>
                </div>
            </div>
            <!-- Display Total -->
            <div class="card display_price_box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pt-3 pb-3">
                        <p class="pl-5 font-weight-bold">Total</p>
                    </div>
                    <div class="pt-3 pb-3">
                        <input type="hidden" name="t_price" id="t_price" value="">
                        <p class="pr-5 font-weight-bold" name="ttl_price" id="ttl_price"></p>
                    </div>
                </div>
            </div>
            <!--div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6" class="dropdown-toggle" data-toggle="collapse" data-target="#collapse_2">
                        {{translate('Shipping Configuration')}}
                    </h5>
                </div>
                <div class="card-body collapse show" id="collapse_2">
                    @if (get_setting('shipping_type') == 'product_wise_shipping')
                    <div class="form-group row">
                        <label class="col-lg-6 col-from-label">{{translate('Free Shipping')}}</label>
                        <div class="col-lg-6">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="radio" name="shipping_type" value="free" @if($product->shipping_type == 'free')
                                checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-lg-6 col-from-label">{{translate('Flat Rate')}}</label>
                        <div class="col-lg-6">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="radio" name="shipping_type" value="flat_rate" @if($product->shipping_type ==
                                'flat_rate') checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                
                    <div class="flat_rate_shipping_div" style="display: none">
                        <div class="form-group row">
                            <label class="col-lg-6 col-from-label">{{translate('Shipping cost')}}</label>
                            <div class="col-lg-6">
                                <input type="number" lang="en" min="0" value="{{ $product->shipping_cost }}" step="0.01"
                                    placeholder="{{ translate('Shipping cost') }}" name="flat_shipping_cost"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                
                
                    @else
                    <p>
                        {{ translate('Shipping configuration is maintained by Admin.') }}
                    </p>
                    @endif
                </div>
                </div>
                
                <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Low Stock Quantity Warning')}}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name">
                            {{translate('Quantity')}}
                        </label>
                        <input type="number" name="low_stock_quantity" value="{{ $product->low_stock_quantity }}" min="0"
                            step="1" class="form-control">
                    </div>
                </div>
                </div>
                
                <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">
                        {{translate('Stock Visibility State')}}
                    </h5>
                </div>
                
                <div class="card-body">
                
                    <div class="form-group row">
                        <label class="col-md-6 col-from-label">{{translate('Show Stock Quantity')}}</label>
                        <div class="col-md-6">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="radio" name="stock_visibility_state" value="quantity"
                                    @if($product->stock_visibility_state == 'quantity') checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-md-6 col-from-label">{{translate('Show Stock With Text Only')}}</label>
                        <div class="col-md-6">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="radio" name="stock_visibility_state" value="text"
                                    @if($product->stock_visibility_state == 'text') checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-md-6 col-from-label">{{translate('Hide Stock')}}</label>
                        <div class="col-md-6">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="radio" name="stock_visibility_state" value="hide"
                                    @if($product->stock_visibility_state == 'hide') checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                
                </div>
                </div>
                
                <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Cash On Delivery')}}</h5>
                </div>
                <div class="card-body">
                    @if (get_setting('cash_payment') == '1')
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">{{translate('Status')}}</label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" name="cash_on_delivery" value="1"
                                            @if($product->cash_on_delivery == 1) checked @endif>
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <p>
                        {{ translate('Cash On Delivery activation is maintained by Admin.') }}
                    </p>
                    @endif
                </div>
                </div>
                
                <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Estimate Shipping Time')}}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name">
                            {{translate('Shipping Days')}}
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="est_shipping_days"
                                value="{{ $product->est_shipping_days }}" min="1" step="1" placeholder="{{translate('Shipping Days')}}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">{{translate('Days')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('VAT & Tax')}}</h5>
                </div>
                <div class="card-body">
                    @foreach(\App\Tax::where('tax_status', 1)->get() as $tax)
                    <label for="name">
                        {{$tax->name}}
                        <input type="hidden" value="{{$tax->id}}" name="tax_id[]">
                    </label>
                
                    @php
                    $tax_amount = 0;
                    $tax_type = '';
                    foreach($tax->product_taxes as $row) {
                    if($product->id == $row->product_id) {
                    $tax_amount = $row->tax;
                    $tax_type = $row->tax_type;
                    }
                    }
                    @endphp
                
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="number" lang="en" min="0" value="{{ $tax_amount }}" step="0.01"
                                placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control aiz-selectpicker" name="tax_type[]">
                                <option value="amount" @if($tax_type=='amount' ) selected @endif>
                                    {{translate('Flat')}}
                                </option>
                                <option value="percent" @if($tax_type=='percent' ) selected @endif>
                                    {{translate('Percent')}}
                                </option>
                            </select>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div-->
        </div>
        <div class="col-12">
            <div class="mar-all text-right">
                <button type="submit" name="button" value="publish"
                    class="btn btn-primary">{{ translate('Check Out') }}</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function (){
        show_hide_shipping_div();
    });
    
    $("[name=shipping_type]").on("change", function (){
        show_hide_shipping_div();
    });
    
    function show_hide_shipping_div() {
        var shipping_val = $("[name=shipping_type]:checked").val();
    
        $(".flat_rate_shipping_div").hide();
    
        if(shipping_val == 'flat_rate'){
            $(".flat_rate_shipping_div").show();
        }
    }
    
    
    function add_more_customer_choice_option(i, name){
        $.ajax({
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
       });
    
    
    }
    
    $('input[name="colors_active"]').on('change', function() {
        if(!$('input[name="colors_active"]').is(':checked')){
            $('#colors').prop('disabled', true);
            AIZ.plugins.bootstrapSelect('refresh');
        }
        else{
            $('#colors').prop('disabled', false);
            AIZ.plugins.bootstrapSelect('refresh');
        }
        update_sku();
    });
    
    $(document).on("change", ".attribute_choice",function() {
        update_sku();
    });
    
    $('#colors').on('change', function() {
        update_sku();
    });
    
    function delete_row(em){
        $(em).closest('.form-group').remove();
        update_sku();
    }
    
    function delete_variant(em){
        $(em).closest('.variant').remove();
    }
    
    function update_sku(){
        $.ajax({
           type:"POST",
           url:'{{ route('products.sku_combination_edit') }}',
           data:$('#choice_form').serialize(),
           success: function(data){
               $('#sku_combination').html(data);
               AIZ.uploader.previewGenerate();
                AIZ.plugins.fooTable();
               if (data.length > 1) {
                   $('#show-hide-div').hide();
               }
               else {
                    $('#show-hide-div').show();
               }
           }
       });
    }
    
    AIZ.plugins.tagify();
    
    
    $(document).ready(function(){
        update_sku();
    
        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
    });
    
    $('#choice_attributes').on('change', function() {
        $.each($("#choice_attributes option:selected"), function(j, attribute){
            flag = false;
            $('input[name="choice_no[]"]').each(function(i, choice_no) {
                if($(attribute).val() == $(choice_no).val()){
                    flag = true;
                }
            });
            if(!flag){
                add_more_customer_choice_option($(attribute).val(), $(attribute).text());
            }
        });
    
        var str = @php echo $product->attributes @endphp;
    
        $.each(str, function(index, value){
            flag = false;
            $.each($("#choice_attributes option:selected"), function(j, attribute){
                if(value == $(attribute).val()){
                    flag = true;
                }
            });
            if(!flag){
                $('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
            }
        });
    
        update_sku();
    });

    //Billing address or pick up
    $('#pickup').click(function() {
        $("#addr_to_ship").addClass("hide");
        if($("#addr_to_bill").not("hide")) {
            $("#addr_to_bill").addClass("hide");
        }
        $('#same_address')[0].checked = true;
    });

    $('#deliver').click(function() {
        $("#addr_to_ship").removeClass("hide");
    });

    //Billing address is different
    $('#same_address').click(function() {
        $("#addr_to_bill").toggleClass("hide");
    });

    $('#same_address').change(function() {
        if ($(this).prop("checked") == false) {
            $('.bill_reqd').prop("required", true);
        }else {
            $('.bill_reqd').prop("required", false);
        }
    });

    $('#motorization').click(function() {
        $('#motor_type').show();
        $('#motor_cntrl').show();
        $('#txt_ctype').text('');
        $('#txt_ctype1').text('');
        $('#ctype_price').text('');
        $('#ctype_price1').text('');
        $('#txt_somfy_upgrade').text('');
        $('#somfy_upgrade_price').text('');
        
        $('#wand_length').hide();
        $("#wand_length option").prop("selected", false);
        $('#wand_ctrl').hide();
        $("#wand_ctrl option").prop("selected", false);
        $('#chain_color').hide();
        $("#chain_color option").prop("selected", false);
        $('#chain_ctrl').hide();
        $("#chain_ctrl option").prop("selected", false);
        $('#cord_ctrl').hide();
        $("#cord_ctrl option").prop("selected", false);
        $('#cord_color').hide();
        $("#cord_color option").prop("selected", false);
        $('#manual_sel').hide();
        $("#manual_sel option").prop("selected", false);
    });

    $('#motor_type').click(function() {
        var name = $(this).find('option:selected').text();
        if(name == 'Shadeowand') {
            $('#shad_wand_len').show();
            $('#shad_wand_side').show();
            $('#txt_somfy_upgrade').text('');
            $('#somfy_upgrade_price').text('');
        }else {
            $('#shad_wand_len').hide();
            $('#shad_wand_side').hide();
        }
        if(name == 'Somfy') {
            $('#somfy_list').show();
            $('#motor_cntrl').hide();
            $('#txt_ctype1').text('');
            $('#ctype_price1').text('');
            $('#txt_shad_wand_len').text('');
            $('#txt_shad_wand_side').text('');
            $('#motor_cntrl').prop('required',false);
            $('#somfy_list').prop('required',true);
        }else {
            $('#somfy_list').hide();
            $('#motor_cntrl').show();
            $('#motor_cntrl').prop('required',true);
            $('#somfy_list').prop('required',false);
        }
        if(name == 'Rechargeable Battery Motor' || name == '12 Volt Motor' || name == '24 Volt Motor' || name == '24 Volt Motor' || name == '110 Volt Motor' ) {
            $('#txt_shad_wand_len').text('');
            $('#txt_shad_wand_side').text('');
            $('#txt_somfy_upgrade').text('');
            $('#somfy_upgrade_price').text('');
            // $('#txt_ctype1').text('');
            // $('#ctype_price1').text('');
        }
        
        $('#motor_name').val($(this).find('option:selected').text());
    });

    $('#manual').click(function() {
        $('#manual_sel').show();
        $('#txt_ctype').text('');
        $('#txt_ctype1').text('');
        $('#ctype_price').text('');
        $('#ctype_price1').text('');
        $('#txt_somfy_upgrade').text('');
        $('#somfy_upgrade_price').text('');
        $('#txt_shad_wand_len').text('');
        $('#txt_shad_wand_side').text('');
        $('#motor_array_price').text('');
        
        $('#motor_type').hide();
        $("#motor_type option").prop("selected", false);
        $('#somfy_list').hide();
        $("#somfy_list option").prop("selected", false);
        $('#motor_cntrl').hide();
        $("#motor_cntrl option").prop("selected", false);
        $('#shad_wand_len').hide();
        $("#shad_wand_len option").prop("selected", false);
        $('#shad_wand_side').hide();
        $("#shad_wand_side option").prop("selected", false);
    });

    $('#manual_sel').click(function() {
        var name = $(this).find('option:selected').text();
        if(name == 'Chain') {
            $('#chain_color').show();
            $('#chain_ctrl').show();
            $('#cord_ctrl').hide();
            $('#cord_color').hide();
            
            $('#chain_color').prop('required',true);
            $('#chain_ctrl').prop('required',true);
            $('#cord_ctrl').prop('required',false);
            $('#cord_color').prop('required',false);

        }else if(name == 'Cord') {
            $('#cord_ctrl').show();
            $('#cord_color').show();
            $('#chain_color').hide();
            $('#chain_ctrl').hide();

            $('#chain_color').prop('required',false);
            $('#chain_ctrl').prop('required',false);
            $('#cord_ctrl').prop('required',true);
            $('#cord_color').prop('required',true);
        }
    });

    $('input[name="controltype"]').click(function() {
        if($('input[name="controltype"]:checked').val() == 'manual') {
            $('#manual_sel').prop('required',true);
            $('#motor_type').prop('required',false);
            $('#motor_cntrl').prop('required',false);
        }else if ($('input[name="controltype"]:checked').val() == 'motor') {
            $('#manual_sel').prop('required',false);
            $('#motor_type').prop('required',true);
            $('#motor_cntrl').prop('required',true);
            var name = $('#motor_type').find('option:selected').text();
            if(name == 'Somfy') {
                $('#motor_cntrl').prop('required',false);
            }
        }
    });
    
    $('#fabric').click(function() {
        let image = $(this).find(':selected').attr('data-img')
        //console.log(image);
        $('#fabric_img').attr("src", "{{ url('assets/img/fabric').'/'}}" + image);
        $('#fabric_img').show();
    });
    
    $('#quantity').change(function() {
        $( "#txt_qty" ).text($(this).val());
        if($('#quantity').val() > 1)  {
            // if(($('#price_tag_id').val() == 6) || ($('#price_tag_id').val() == 7) || ($('#price_tag_id').val() == 8) || ($('#price_tag_id').val() == 9) || ($('#price_tag_id').val() == 13)) {
            //     $( "#brackets_opt" ).removeClass('hide');
            //     alert('You can now select the bracket options.');
            // }
            if($('#product_name').text().toLowerCase().includes("roller") || $('#shade_desc').text().toLowerCase().includes("roller")) {
                $( "#brackets_opt" ).removeClass('hide');
                //alert('You can now select the bracket options.');
            }
        }else {
            $( "#brackets_opt" ).addClass('hide');
            $("#brackets_opt option").prop("selected", false);
            $( "#brackets_price" ).text('0');
            $( "#txt_brackets" ).text('');
        }
    });
    $('#width').change(function() {
        $( "#txt_wid" ).text($(this).val()+' ('+ $('#wid_decimal option:selected').text()+')');
    });
    $('#length').change(function() {
        $( "#txt_len" ).text($(this).val()+' ('+ $('#len_decimal option:selected').text()+')');
    });
    
    $('.calc_prices').change(function (){
        if($('#width').val() > 96 || $('#length').val() > 96) {
            $('#spring_chk').prop("checked", true);
            $( "#spring_price" ).text($('#spring_chk:checked').val());
        }
    });

    $('#motor_type').change(function() {
        $( "#txt_ctype" ).text($("#motor_type option:selected").text());
        $( "#ctype_price" ).text($("#motor_type option:selected").val());
        grandTotalCalc();
    });
    $('#motor_cntrl').change(function() {
        $( "#txt_ctype1" ).text($("#motor_cntrl option:selected").text());
        $( "#ctype_price1" ).text($("#motor_cntrl option:selected").val());
        $('#remote_ctrl_channel').val($("#motor_cntrl option:selected").text());
        grandTotalCalc();
    });
    $('#somfy_list').change(function() {
        $( "#txt_somfy_upgrade" ).text($("#somfy_list option:selected").text());
        $( "#somfy_upgrade_price" ).text($("#somfy_list option:selected").val());
        $('#somfy_upgrade_name').val($("#somfy_list option:selected").text());
        grandTotalCalc();
    });
    $('#wand_length').change(function() {
        $( "#txt_ctype" ).text($(this).val());
    });
    $('#wand_ctrl').change(function() {
        $( "#txt_ctype1" ).text($(this).val());
    });
    $('#chain_color').change(function() {
        $( "#txt_ctype" ).text($(this).val());
    });
    $('#chain_ctrl').change(function() {
        $( "#txt_ctype1" ).text($(this).val());
    });
    $('#cord_ctrl').change(function() {
        $( "#txt_ctype" ).text($(this).val());
    });
    $('#cord_color').change(function() {
        $( "#txt_ctype1" ).text($(this).val());
    });
    
    $("input[name=mount]").change(function() {
        $( "#mount_price" ).text($('input[name=mount]:checked').val());
        $('#mount_type').val($('input[name=mount]:checked').attr('data-mount-type'));
        grandTotalCalc();
    });

    $("input[name=delivery_chk]").change(function() {
        if($('input[name=delivery_chk]:checked').val() == 'pick'){
            $('.for_reqd').prop('required', false);
        }else {
            $('.for_reqd').prop('required', true);
        }
    });

    $( "#mount_price" ).change(function() {
        grandTotalCalc();
    });

    $('#fabric').change(function() {
        $( "#txt_fabric" ).text($('#fabric option:selected').text());
    });
    $('#wrap_expose').change(function() {
        $( "#txt_wrap" ).text($(this).val());
    });
    $('#cassette_type').change(function() {
        var cass_type = $("#cassette_type option:selected").html();
        $( "#txt_cassette" ).text(cass_type);
    });
    $('#cassette_color').change(function() {
        var color = $("#cassette_color option:selected").html();
        $( "#txt_casscolor" ).text(color);
    });
    $('#brackets_opt').change(function() {
        $( "#txt_brackets" ).text($('#brackets_opt option:selected').text());
        $('#brackets_opt_name').val($('#brackets_opt option:selected').text());
        
    });
    $('#brackets_opt').change(function() {
        $( "#brackets_price" ).text($('#brackets_opt option:selected').val());
        grandTotalCalc();
    });

    $('#spring_chk').change(function() {
        // $( "#spring_price" ).text($('#spring_chk:checked').val());
        if($("#spring_chk").prop('checked') == true){
            $( "#spring_price" ).text($('#spring_chk:checked').val());
        }else {
            $( "#spring_price" ).text('0');
        }
        grandTotalCalc();
    });


    $('#shad_wand_len').change(function() {
        $( "#txt_shad_wand_len" ).text($(this).val());
    });
    $('#shad_wand_side').change(function() {
        $( "#txt_shad_wand_side" ).text($(this).val());
    });
    // $('#txt_qty').change(function() {
    //     grandTotalCalc();
    // });
    $('#quantity').change(function() {
        grandTotalCalc();
    });
    
    // $('#smart_addons').change(function() {
    //     $( "#txt_sm_option" ).text($(this).val());
    // });

    $('#smart_addons').change(function() {
        var values = $('#smart_addons').val();
        values = values.toString();
        values = values.replace(/,/g, ' +\n');
        $( "#txt_sm_option" ).text(values).css('textTransform', 'capitalize');
        $('#smartopts').val($( "#txt_sm_option" ).text());
        var sum = 0;
        $('#smart_addons option:selected').each(function() {
            sum = parseInt($(this).attr("data-smartprice"))+sum;
            $('#sm_option_price').text(sum);
        });
        $('#smartopts_pri').val($('#sm_option_price').text());
        if(($("#smart_addons :selected").length) == 0) {
            $('#sm_option_price').text('0');
        }
        grandTotalCalc();
    });

    $('#clr_addons').on('click', function() {
        $('#smart_addons').val('');
        $('#sm_option_price').text('0');
        $( "#txt_sm_option" ).text('');
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
    
    //Get price from php
    $(document).ready(function(){
        var obj_price = '<?php echo json_encode($price_arr); ?>';
        obj = JSON.parse(obj_price);
        coupon_obj = '<?php echo json_encode($coupon_arr); ?>';
        coupon_obj = JSON.parse(coupon_obj);
        // console.log(coupon_obj);
        // var price_json = JSON.stringify(obj_price);
        // console.log(obj[35]['price']);
        // console.log(obj);
    });

    function grandTotalCalc() {
        //shade
        let total_shade_price = $('#shade_price').text() != "" ? parseInt($('#shade_price').text()) : 0;
        //wrap
        let total_wrap_price = $('#wrap_price').text() != "" ? parseInt($('#wrap_price').text()) : 0;
        //cassette
        let total_cassette_price = $('#cassette_price').text() != "" ? parseInt($('#cassette_price').text()) : 0;
        sm_option_price
        //sm_option
        let ttl_sm_option_price = $('#sm_option_price').text() != "" ? parseInt($('#sm_option_price').text()) : 0;
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
        let somfy_upg_price = $('#somfy_upgrade_price').val() != "" ? parseInt($('#somfy_upgrade_price').val()) : 0;

        //Coupon Discount
        let coupon_disc_price = $('#coupon_discount').val() != "" ? parseInt($('#coupon_discount').val()) : 0;

        var ttl_price = (qty*(total_shade_price + total_wrap_price + total_cassette_price + ttl_sm_option_price + motor_price + channel_price + brack_opt_price + mnt_price + spring_price + somfy_upg_price)) - coupon_disc_price;
        ttl_price = isNaN(parseFloat(ttl_price)) ? 0 : ttl_price;
        //console.log(ttl_price);
        $('#ttl_price').text('$ ' + ttl_price || 0);
        $('#t_price').val($('#ttl_price').text());
    }

    $('.calc_prices').on('change', function() {
        width_calc = $('#width').find(":selected").val();
        width_decimal_calc = $('#wid_decimal').find(":selected").val();
        length_calc = $('#length').find(":selected").val();
        length_decimal_calc = $('#len_decimal').find(":selected").val();

        // console.log(width_calc, width_decimal_calc, length_calc, length_decimal_calc)

        if(width_decimal_calc < 0.5 && width_calc && length_calc && length_decimal_calc  < 0.5) {
            $.each(obj, function(key, value) { 
                if(value.width == width_calc && value.length == length_calc) {
                    $( "#txt_wid" ).text(value.width +' ('+ $('#wid_decimal option:selected').text()+')');
                    $( "#txt_len" ).text(value.length +' ('+ $('#len_decimal option:selected').text()+')');
                    $('#shade_price').text(value.price);
                    $("#cassette_type").attr("data-cassette-type-price", obj[key].square_cassette);
                    $("#cassette_type").attr("data-stdcas-price", obj[key].std_r_cassette);
                    $("#cassette_type").attr("data-roundcas-price", obj[key].round_cassette);
                    var v1 = $('#cassette_type').children("option:selected").val();
                    if(v1 == 'square_cassette') {
                        $('#cassette_price').text($('#cassette_type').attr("data-cassette-type-price"));
                    }
                    
                    $("#w_exp").attr("data-wrap-expose-price", obj[key].fabric_wrap);
                    var v1 = $("input[name='wrap_expose']:checked").val();
                    if(v1 == 'wrap') {
                        $('#wrap_price').text($('#w_exp').attr("data-wrap-expose-price"));
                    }
                    
                    //motor array price
                    if((obj[key].price_tag == 11) || (obj[key].price_tag = 12)) {
                        $('#motor_array_price').text(obj[key].motor_array);
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
                if (width_decimal_calc >= 0.5 && length_decimal_calc < 0.5) {
                    if(value.width == width_calc && value.length == length_calc) {
                        width_key = key;
                        
                        while (parseInt(obj[width_key++].width) <= parseInt(width_calc) + parseInt(obj[width_key - 1].wid_diff)) { // obj[width_key - 1].diff_width or WIDTH_SIZE
                            // code ..
                            // console.log("key: ", width_key);
                            if (obj[width_key].length == length_calc) {
                                $( "#txt_wid" ).text(obj[width_key].width +' ('+ $('#wid_decimal option:selected').text()+')');
                                
                                $('#shade_price').text(obj[width_key].price);
                                $("#cassette_type").attr("data-cassette-type-price", obj[width_key].square_cassette);
                                $("#cassette_type").attr("data-stdcas-price", obj[width_key].std_r_cassette);
                                $("#cassette_type").attr("data-roundcas-price", obj[width_key].round_cassette);
                                var v1 = $('#cassette_type').children("option:selected").val();
                                if(v1 == 'square_cassette') {
                                    $('#cassette_price').text($('#cassette_type').attr("data-cassette-type-price"));
                                }
                                
                                $("#w_exp").attr("data-wrap-expose-price", obj[width_key].fabric_wrap);
                                var v1 = $("input[name='wrap_expose']:checked").val();
                                if(v1 == 'wrap') {
                                    $('#wrap_price').text($('#w_exp').attr("data-wrap-expose-price"));
                                }

                                //motor array price
                                if((obj[width_key].price_tag == 11) || (obj[width_key].price_tag = 12)) {
                                    $('#motor_array_price').text(obj[width_key].motor_array);
                                    // console.log(obj[key].motor_array);
                                }

                                return false;
                            }
                        }
                    }
                // If length Increase
                } else if (width_decimal_calc < 0.5 && length_decimal_calc >= 0.5) {
                    if(value.width == width_calc && value.length == length_calc) {
                        $("#cassette_type").attr("data-cassette-type-price", obj[key].square_cassette);
                        $("#cassette_type").attr("data-stdcas-price", obj[key].std_r_cassette);
                        $("#cassette_type").attr("data-roundcas-price", obj[key].round_cassette);
                        $("#w_exp").attr("data-wrap-expose-price", obj[key].fabric_wrap);
                        length_key = key;
                        //motor array price
                        if((obj[key].price_tag == 11) || (obj[key].price_tag = 12)) {
                            $('#motor_array_price').text(obj[key].motor_array);
                            // console.log(obj[key].motor_array);
                        }
                        
                        while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) {   //obj[length_key - 1].len_diff or LENGTH_SIZE
                            // code ..
                            if (obj[length_key].width == width_calc) {
                                // console.log("length: ", obj[length_key]);
                                $( "#txt_len" ).text(obj[length_key].length+' ('+ $('#len_decimal option:selected').text()+')');
                                $('#shade_price').text(obj[length_key].price);
                                return false;
                            }
                        }
                    }
                // If both Increase
                } else {
                    if(value.width == width_calc && value.length == length_calc) {
                        width_key = key;
                        
                        while (parseInt(obj[width_key++].width) <= parseInt(width_calc) + parseInt(obj[width_key - 1].wid_diff)) {
                            // code ..
                            if (obj[width_key].length == length_calc) {
                                length_key = width_key;
                                width_calc = obj[width_key].width;
                                $( "#txt_wid" ).text(obj[width_key].width+' ('+ $('#wid_decimal option:selected').text()+')');
                                $("#cassette_type").attr("data-cassette-type-price", obj[width_key].square_cassette);
                                $("#cassette_type").attr("data-stdcas-price", obj[width_key].std_r_cassette);
                                $("#cassette_type").attr("data-roundcas-price", obj[width_key].round_cassette);
                                var v1 = $('#cassette_type').children("option:selected").val();
                                if(v1 == 'square_cassette') {
                                    $('#cassette_price').text($('#cassette_type').attr("data-cassette-type-price"));
                                }
                                $("#w_exp").attr("data-wrap-expose-price", obj[width_key].fabric_wrap);
                                var v1 = $("input[name='wrap_expose']:checked").val();
                                if(v1 == 'wrap') {
                                    $('#wrap_price').text($('#w_exp').attr("data-wrap-expose-price"));
                                }
                                //motor array price
                                if((obj[width_key].price_tag == 11) || (obj[width_key].price_tag = 12)) {
                                    $('#motor_array_price').text(obj[width_key].motor_array);
                                    // console.log(obj[key].motor_array);
                                }
                                
                                while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) {
                                    // code ..
                                    if (obj[length_key].width == width_calc) {
                                        // console.log("length: ", obj[length_key]);
                                        $( "#txt_len" ).text(obj[length_key].length+' ('+ $('#len_decimal option:selected').text()+')');
                                        $('#shade_price').text(obj[length_key].price);
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
    });

    $('#cassette_type').on('change', function() {
        var v1 = $(this).children("option:selected").val();
        // console.log(v1);
        if(v1 == 'square_cassette') {
            $('#cassette_price').text($(this).attr("data-cassette-type-price"));
            $('#casprice').val($('#cassette_price').text());
        }
        else if(v1 == 'std_r_cassette') {
            $('#cassette_price').text($(this).attr("data-stdcas-price"));
            $('#casprice').val($('#cassette_price').text());
        }
        else if(v1 == 'priced_round_cassette') {
            $('#cassette_price').text($(this).attr("data-roundcas-price"));
            $('#casprice').val($('#cassette_price').text());
        }
        else {
            $('#cassette_price').text('0');
            $('#casprice').val($('#cassette_price').text());
        }
        grandTotalCalc(); 
    });

    $("input[name='wrap_expose']").on('change', function() {
        // var v1 = $(this).children("option:checked").val();
        var v1 = $("input[name='wrap_expose']:checked").val();
        // console.log(v1);
        if(v1 == 'wrap') {
            $('#wrap_price').text($('#w_exp').attr("data-wrap-expose-price"));
            $('#wrap_exp_price').val($('#wrap_price').text());
        }else {
            $('#wrap_price').text('0');
            $('#wrap_exp_price').val($('#wrap_price').text());
        }
        grandTotalCalc();
    });

    //Coupon
    jQuery(document).ready(function(){
        jQuery('#coupon_sbmt').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var mycoupon = $('#coupon').val();
            // console.log(mycoupon);
            jQuery.ajax({
                url: "{{ url('/coupon_check') }}",
                type: 'POST',
                data: {'coupon': mycoupon },
                success: function(result){
                    // console.log(result['msg']);
                    if(result['msg'] == 'success') {
                        var deduction = 0;
                        if(result['discount_type'] == 'amount') {
                            deduction = result['discount'];
                            // console.log(deduction);
                        }else {
                            deduction = result['discount']/100;
                            // console.log(deduction);
                        }
                        console.log(deduction);
                        $('#coupon_discount').val(deduction);
                        grandTotalCalc();
                    }else {
                        alert(result['msg']);
                    }
                }
            });
        });
    });

    //Total
    grandTotalCalc();

    //Accordion out of view issue fix
    $('.collapse').on('shown.bs.collapse', function(e) {
        var $card = $(this).closest('.card');
        $('html,body').animate({
            scrollTop: $card.offset().top
        }, 500);
    });

</script>
@endsection