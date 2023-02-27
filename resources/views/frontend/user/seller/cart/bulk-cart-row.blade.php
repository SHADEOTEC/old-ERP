<tr class="cart-row" id="cart-row-{{ $rowIndex }}" data-index="{{ $rowIndex }}">
    <td>
        <div class="d-flex flex-column align-items-center">
            <span class="product-row-sl"></span>
            <span role="button" title="Remove" class="remove-product-row btn btn-sm btn-soft-danger p-1" data-index="{{ $rowIndex }}"> <i class="la la-trash-alt"></i> </span>
            <span role="button" title="Duplicate" class="duplicate-product-row btn btn-sm btn-soft-primary mt-2 p-1" data-index="{{ $rowIndex }}"> <i class="las la-copy"></i> </span>
        </div>

        {{-- Hidden Inputs --}}
        <input type="hidden" name="id" class="id" value="{{ $product->id }}">
        <input type="hidden" name="product_name" class="product_name" value="{{ $product->name }}">
        <input type="hidden" name="disc_percent" class="disc_percent" value="{{ $cust_discount ? $cust_discount->disc_percent : '' }}">
        <input type="hidden" name="dealer_name" class="dealer_name" value="{{ Auth::user()->name }}">
        <input type="hidden" name="cust_side_mark" class="cust_side_mark" value="{{ isset($cust_discount->cs_mark) ? $cust_discount->cs_mark : '' }}">
        <input type="hidden" name="inv_num" class="inv_num" value="{{ $invoice->values }}">
        <input type="hidden" name="order_number" class="order_number" value="{{ Auth::id() . '-' . time() . '-' . $product->id }}">
        <input type="hidden" value="{{ static_asset('products/images/') . '/' . $product->thumbnail_img }}" class="main_img" />

        <input type="hidden" class="shade_price">
        <input type="hidden" class="shade_amount">
        <input type="hidden" class="cassette_type">
        <input type="hidden" class="w_exp">
        <input type="hidden" class="motor_array_price">
        <input type="hidden" class="motor_arr_pri">
        <input type="hidden" class="spring_price">
        <input type="hidden" class="mount_price">

        <input type="hidden" class="cassette_price">
        <input type="hidden" class="wrap_price">
        <input type="hidden" class="ctype_arrprice">
        <input type="hidden" class="wid_motor_max_field" value="{{ isset($wid_motor_max) ? $wid_motor_max : 0 }}">
        <input type="hidden" class="ct_widmotor_code_field" value="{{ isset($ct_wid_motors->ct_widmotor_code) ? $ct_wid_motors->ct_widmotor_code : 0 }}">

    </td>

    <td>

        <div class="form-group">
            <select class="form-control form-control-sm product_list">

                @foreach ($products as $p)
                    <option value="{{ $p->id }}" @if ($p->id == $product->id) selected @endif> {{ $p->name }} </option>
                @endforeach

            </select>
        </div>

    </td>

    {{-- Room Type --}}
    <td>
        <div class="form-group">
            <select class="form-control form-control-sm room_type" name="room_type" required>
                <option value="">Select Room Type</option>
                @foreach ($roomtype as $item)
                    @if ($item->xztroomtype->state == 'Active')
                        <option value="{{ $item->roomtype_id }}">{{ $item->xztroomtype->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="window_desc_{{ $rowIndex }}" class="hide">Window Description</label>
            <input type="text" class="form-control form-control-sm hide window_desc" name="window_desc" id="window_desc_{{ $rowIndex }}">
        </div>
    </td>

    {{-- QUANTITY & MEASUREMENTS --}}
    <td style="width: 110px;max-width: 110px;">
        <div class="form-group mb-1">
            <select class="form-control form-control-sm p-0 form-control-sm quantity calc_prices" name="quantity" required>
                <option value="">Select QTY</option>
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
        </div>

        <div class="form-group mb-1">
            <p class="mb-1">Width</p>
            <div class="row">
                <div class="col-6 pr-1">
                    <select class="form-control form-control-sm form-control-sm width calc_prices fabric-min-max-width-changes get_fts_prices @if (isset($ct_wid_motors) && !empty($ct_wid_motors)) wm_price @endif p-0" name="width" required>
                        <option value="">Select Width</option>
                        @foreach ($distinct_wid as $key => $item)
                            @if ($key == 0)
                                @for ($j = 12; $j < $item->width; $j++)
                                    <option data-price={{ $item->width }} value="{{ $j }}">{{ $j }}</option>
                                @endfor
                            @endif
                            <?php $i = 0; ?>
                            <option data-price={{ $item->width }} value="{{ $item->width }}">{{ $item->width }}</option>
                            @while (isset($distinct_wid[$key + 1]) && $distinct_wid[$key + 1]->width != $item->width + ++$i)
                                <option data-price={{ $distinct_wid[$key + 1]->width }} value="{{ $item->width + $i }}">{{ $item->width + $i }}</option>
                            @endwhile
                        @endforeach
                    </select>
                </div>

                <div class="col-6 pl-1">
                    <select class="form-control form-control-sm form-control-sm wid_decimal get_fts_prices calc_prices @if (isset($ct_wid_motors) && !empty($ct_wid_motors)) wm_price @endif p-0" name="wid_decimal">
                        <option selected value="0">Even</option>
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
        <div class="form-group">
            <p class="mb-1">Length</p>

            <div class="row">
                <div class="col-6 pr-1">
                    <select class="form-control form-control-sm form-control-sm length get_fts_prices calc_prices @if (isset($ct_wid_motors) && !empty($ct_wid_motors)) wm_price @endif p-0" name="length" required>
                        <option value="">Select Length</option>
                        @foreach ($distinct_len as $key => $item)
                            @if ($key == 0)
                                @for ($j = 12; $j < $item->length; $j++)
                                    <option data-price={{ $item->length }} value="{{ $j }}">{{ $j }}</option>
                                @endfor
                            @endif
                            <?php $i = 0; ?>
                            <option data-price={{ $item->length }} value="{{ $item->length }}">{{ $item->length }}</option>
                            @while (isset($distinct_len[$key + 1]) && $distinct_len[$key + 1]->length != $item->length + ++$i)
                                <option data-price={{ $distinct_len[$key + 1]->length }} value="{{ $item->length + $i }}">{{ $item->length + $i }}</option>
                            @endwhile
                        @endforeach
                    </select>
                </div>

                <div class="col-6 pl-1">
                    <select class="form-control form-control-sm form-control-sm len_decimal get_fts_prices calc_prices @if (isset($ct_wid_motors) && !empty($ct_wid_motors)) wm_price @endif p-0" name="len_decimal" id="len_decimal">
                        <option selected value="0">Even</option>
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
    </td>

    {{-- Control Type --}}
    <td>
        <div class="form-group row mb-1">
            <div class="col-12 col-md-12 col-lg-12">
                <select class="form-control form-control-sm controltype calc_prices" name="controltype">
                    <option selected value="">Control Type</option>
                    <option value="motor">Motorization</option>
                    <option value="manual">Manual</option>
                </select>

                <!-- Motor Position -->
                <select class="form-control form-control-sm hide motor_pos mt-2" name="motor_pos">
                    <option value="">Select your Motor Position</option>
                    <option value="Default">Default</option>
                    <option value="Right">Right</option>
                    <option value="Left">Left</option>
                </select>

                {{-- Motor Type --}}
                <div class="motor-type-wrap">
                    <select class="form-control form-control-sm hide motor_type calc_prices mt-2" name="motor_type">
                        <option value="" data-first="true">Select your Motor type</option>
                        @foreach ($ct_motors as $item)
                            @if ($item->motor->state == 'Active')
                                <option value="{{ $item->motor->price }}" data-motor-price={{ $item->motor->ct_code }}>{{ $item->motor->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input type="hidden" name="motor_name" class="motor_name" value="">
                </div>

                <!-- Motor type Sub lists -->
                <select class="form-control form-control-sm hide shad_wand_len mt-2" name="shad_wand_len">
                    <option value="">Select wand length</option>
                    <option value="1ft">1ft</option>
                    <option value="2ft">2ft</option>
                    <option value="3ft">3ft</option>
                    <option value="4ft">4ft</option>
                    <option value="5ft">5ft</option>
                </select>

                <select class="form-control form-control-sm hide shad_wand_side mt-2" name="shad_wand_side">
                    <option value="">Select control side</option>
                    <option value="Right">Right</option>
                    <option value="Left">Left</option>
                </select>
                <!-- Motor type Sub lists -->

                {{-- Motor Control --}}
                <select class="form-control form-control-sm hide motor_cntrl calc_prices mt-2" name="motor_cntrl">
                    <option value="">Select your Remote</option>
                    <option value="30">1 Channel</option>
                    <option value="33">2 Channel</option>
                    <option value="35">5 Channel</option>
                    <option value="40">15 Channel</option>
                </select>

                <input type="text" class="form-control form-control-sm col-12 hide channel_guideline mt-2" placeholder="Programming Instructions" name="channel_guideline" />
                <input type="hidden" class="remote_ctrl_channel" name="remote_ctrl_channel" value="">
                {{-- Motor Control --}}

                <div class="row hide smart_opts mt-2">
                    <div class="col">
                        <select name="plugin_charger" class="form-control smart_radios plugin_charger calc_prices">
                            <option value="">Plugin Charger</option>
                            <option value="35">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class="row hide smart_opts mt-2">
                    <div class="col">
                        <select name="solar_panel" class="form-control smart_radios solar_panel calc_prices">
                            <option value="">Solar Panel</option>
                            <option value="35">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class="row hide smart_opts mt-2">
                    <div class="col">
                        <select name="shade_smart_hub" class="form-control smart_radios shade_smart_hub calc_prices">
                            <option value="">Shade Smart Hub</option>
                            <option value="175">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class="row hide smart_opts mt-2">
                    <div class="col">
                        <select name="shade_smart_transformers" class="form-control smart_radios shade_smart_transformers calc_prices">
                            <option value="">Shade Smart Transformers</option>
                            <option value="200">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <!-- Sub list -> Somfy -->
                <select class="form-control form-control-sm hide somfy_list mt-2" name="somfy_list">
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
                <input type="hidden" class="somfy_upgrade_name" name="somfy_upgrade_name" value="">

                <!-- Manual -->
                <div class="mt-2">
                    <p class="form-check-label hide manual-sel-ctrl-type font-bold" for="motorization">
                        Control Type
                    </p>
                </div>

                <select class="form-control form-control-sm hide manual_sel mt-2" name="manual_sel">
                    <option value="">Select chain/cord</option>
                    <option>Chain</option>
                    <option>Cord</option>
                </select>

                {{-- Chain Cord Color --}}
                <div class="chain_color_box hide mt-2">
                    <p class="mb-0 font-bold">Color</p>
                    <select name="chaincolor_arr" class="form-control chain_color">
                        <option value="White">White</option>
                        <option value="Black">Black</option>
                        <option value="Steel">Steel</option>
                    </select>
                </div>

                <div class="cord_color_box hide mt-2">
                    <p class="mb-0 font-bold">Color</p>
                    <select name="cordcolor_arr" class="form-control cord_color">
                        <option value="Default">Default</option>
                        <option value="White">White</option>
                        <option value="Grey">Grey</option>
                        <option value="Beige">Beige</option>
                        <option value="Black">Black</option>
                        <option value="Brown">Brown</option>
                    </select>
                </div>

                {{-- Chain Cord Position --}}
                <div class="mt-2">
                    <p class="form-check-label hide chain-cord-ctrl-pos font-bold">
                        Control Position
                    </p>
                </div>

                <select class="form-control form-control-sm hide chain_ctrl mt-2" name="chain_ctrl">
                    <option value="">Select your chain control side</option>
                    @foreach ($ct_manuals as $item)
                        @if (stripos($item->manual->ct_code, 'chain') !== false)
                            <option value="{{ $item->manual->ct_code }}" data-man-img={{ $item->manual->image }}>{{ $item->manual->name }}</option>
                        @endif
                    @endforeach
                </select>

                <select class="form-control form-control-sm hide cord_ctrl mt-2" name="cord_ctrl">
                    <option value="">Select your cord control side</option>
                    @foreach ($ct_manuals as $item)
                        @if (stripos($item->manual->ct_code, 'cord') !== false)
                            <option value="{{ $item->manual->ct_code }}" data-man-img="{{ $item->manual->image }}">{{ $item->manual->name }}</option>
                        @endif
                    @endforeach
                </select>

            </div>
        </div>
    </td>

    {{-- Mount --}}
    <td>
        <div class="form-group">
            <select class="form-control form-control-sm mount p-0" name="mount" required>
                <option value=""></option>
                @foreach ($mount as $item)
                    @if ($item->xztmount->state == 'Active')
                        @if (strtolower($item->xztmount->name) == 'inside')
                            <option data-mountimg={{ $item->xztmount->image }} value="{{ $item->xztmount->price }}" data-text="{{ $item->xztmount->name }}"> IS </option>
                        @elseif(strtolower($item->xztmount->name) == 'outside')
                            <option data-mountimg={{ $item->xztmount->image }} value="{{ $item->xztmount->price }}" data-text="{{ $item->xztmount->name }}"> OS </option>
                        @else
                            <option data-mountimg={{ $item->xztmount->image }} value="{{ $item->xztmount->price }}">{{ $item->xztmount->name }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
            <input type="hidden" class="mount_type" name="mount_type" value="">
        </div>
    </td>

    <!-- Fabric Selection -->
    <td style="width: 130px;">
        <div class="form-group" id="fabric-div-group">
            <select class="form-control form-control-sm fabric fabric-min-max-width-changes" name="fabric" required>
                <option value="">Select Fabric</option>
                @foreach ($fabric as $item)
                    @if ($item->xztfabric->show_in_gallery == 'Yes')
                        <option data-img="{{ $item->xztfabric->url }}" data-fab-specs="{{ $item->xztfabric->fab_specs }}" data-fabric-min-width="{{ $item->xztfabric->min_width }}"
                                data-fabric-max-width="{{ $item->xztfabric->max_width }}" value="{{ $item->fabric_id }}">{{ $item->xztfabric->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </td>

    @php
        $mainCategoryID = get_main_category_id($product->category_id);
    @endphp

    <!-- Cassette Options -->
    <td>
        <div class="form-group mb-1">
            <select data-cassette-type-price='0' data-stdcas-price='0' data-roundcas-price='0' class="form-control form-control-sm calc_prices get_fts_prices cassette_type" name="cassette_type" required>
                @if ($mainCategoryID == 3)
                    <option value="Open Roller">Open Roller</option>
                @else
                    <option value="">Select Cassette</option>
                @endif
                @foreach ($cassette as $item)
                    @if ($item->xztcassette->state == 'Active')
                        <option value="{{ $item->xztcassette->cassette_code }}" data-cassette-id="{{ $item->xztcassette->id }}">{{ $item->xztcassette->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group mt-2">
            <p class="mb-1">Color</p>
            <select class="form-control form-control-sm cassette_color" name="cassette_color" required>
                @if ($mainCategoryID == 3)
                    <option value="default">Default</option>
                @endif
            </select>
        </div>

    </td>

    <td>
        @if ($mainCategoryID == 3)
            <div class="form-group mb-1">
                <select class="form-control form-control-sm bottom_rail" required>
                    <option data-price="0" value="">Select Bottom Rail</option>
                    <option data-price="0" value="Default">Default</option>
                    <option data-price="85" value="Hem Bar Wrapped">Hem Bar Wrapped</option>
                    <option data-price="65" value="Sealed Wrapped">Sealed Wrapped</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <p class="mb-1">Color</p>
                <select class="form-control form-control-sm bottom_rail_color" required>
                </select>
            </div>
        @else
            <div class="form-group mb-1">
                <select class="form-control form-control-sm bottom_rail" required>
                    <option data-price="0" value="">Select Bottom Rail</option>
                    <option data-price="0" value="Default">Default</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <p class="mb-1">Color</p>
                <select class="form-control form-control-sm bottom_rail_color" required>
                </select>
            </div>
        @endif
    </td>

    @if (isset($wrap) && !empty($wrap))
        <!-- Wrapped/Exposed -->
        <td style="width: 80px;">
            <div class="form-group">
                <select class="form-control form-control-sm calc_prices wrap_expose get_fts_prices" name="wrap_expose" required>
                    <option value="">Select Wrapped/Exposed</option>
                    <option value="0">Default</option>
                    @if ($wrap->xztwrap->state == 'Active')
                        <option value="{{ $wrap->xztwrap->wrap_code }}">{{ $wrap->xztwrap->name }}</option>
                    @endif
                </select>
            </div>
        </td>
    @else
        <td>

        </td>
    @endif

    @if (isset($bracket) && count($bracket) > 0)
        <!-- Brackets -->
        <td>
            <div class="form-group">
                <select class="form-control form-control-sm brackets" name="brackets" required>
                    <option value="">Select Bracket</option>
                    @foreach ($bracket as $item)
                        @if ($item->xztbracket->state == 'Active')
                            <option value="{{ $item->id }}" data-bracketimg={{ $item->xztbracket->image }}>{{ $item->xztbracket->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            @if ($shade_opt->bracket_options)
                <div class="form-group">
                    <select class="form-control calc_prices form-control-sm hide brackets_opt" name="brackets_opt">
                        <option value="">Select Bracket Options</option>
                        <option value="44">Dual Brackets</option>
                    </select>
                    <input type="hidden" id="brackets_opt_name" name="brackets_opt_name" value="">
                </div>
            @endif
        </td>
    @else
        <td></td>
    @endif

    @if (isset($stack) && count($stack) > 0)
        <!-- Stack Options-->
        <td>
            <div class="form-group">
                <select class="form-control form-control-sm stack" name="stack" required>
                    <option value="">Select Stack</option>
                    @foreach ($stack as $item)
                        @if ($item->xztstack->state == 'Active')
                            <option data-stack-img={{ $item->xztstack->image }} value="{{ $item->id }}">{{ $item->xztstack->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </td>
    @else
        <td></td>
    @endif

    <!-- Spring Assist -->
    @if (isset($springassist) && count($springassist) > 0)
        @php $sa_check = 1; @endphp
        <td>
            <div class="form-group">
                <select name="spring_chk" class="spring_chk calc_prices form-control form-control-sm">
                    <option value="">Spring Assist</option>
                    <option value="90">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </td>
    @else
        <td></td>
    @endif

    <td class="relative" style="width: 0;padding: 0;margin: 0;">
        <div class="grand-total-table">
            <table class="mb-0 table">
                <tr>
                    <td width="180">Suggested Price</td>
                    <td class="text-right">$ <span class="suggested-price">0.00</span></td>
                </tr>
                <tr>
                    <td width="180">Grand Total</td>
                    <td class="text-right">$ <span class="grand-total">0.00</span></td>
                </tr>
            </table>
        </div>
    </td>


    <!-- Billing and Shipping address -->
</tr>

{{-- <div class="form-group">
    <label for="sp_instructions_{{ $rowIndex }}" class="d-none">Special Instructions</label>
    <textarea class="form-control form-control-sm sp_instructions" id="sp_instructions_{{ $rowIndex }}" name="sp_instructions" rows="3"></textarea>
</div> --}}
