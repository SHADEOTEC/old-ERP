@extends('frontend.layouts.user_panel')
@section('panel_content')
    <style>
        .aiz-user-panel {
            padding-right: 30px;
        }

        .modal-dialog {
            width: 100% !important;
            max-width: 960px;
        }

        .dlist-align {
            font-size: 30px;
        }

        #bulk-cart-table .form-control {
            max-width: 200px;
            font-size: 11px;
        }

        #bulk-cart-table th,
        #bulk-cart-table td {
            max-width: 200px;
            font-weight: bold;
            font-size: 12px;
        }

        .relative {
            position: relative;
        }

        .grand-total-table {
            position: absolute;
            width: 300px;
            right: 10px;
            bottom: 10px;
            background: #f5f5f5;
            font-size: 16px;
            box-shadow: 0 0 5px 5px #ccc;
            border-radius: 5px;
        }

        span.cart-row-index {
            width: 40px;
            height: 40px;
            background: #1a1a27;
            border-radius: 50%;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            color: #FFF;
            font-weight: bold;
            margin: 15px;
        }

        .aiz-user-sidenav-wrap {
            height: 100vh;
        }

        .aiz-user-sidenav {
            height: 100%;
        }

        .widget-balance {
            height: 200px !important;
        }
    </style>
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ $error }}</strong> You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach

    <div class="aiz-titlebar bulkorder-title mt-2 mb-2">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Bulk Order') }}</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary newItemBtn">
                    <i class="las la-plus"></i> ADD NEW
                </button>
            </div>
        </div>
    </div>

    <!-- Bulk order products table -->
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-bordered table-sm table" id="bulk-cart-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>SL</th>
                                    <th>Room Type</th>
                                    <th>QUANTITY & MEASUREMENTS</th>
                                    <th>CONTROL TYPE</th>
                                    <th>MOUNT</th>
                                    <th>FABRIC SELECTION</th>
                                    <th>CASSETTE OPTIONS</th>
                                    @if (isset($wrap) && !empty($wrap))
                                        <th>WRAPPED/EXPOSED</th>
                                    @endif

                                    @if (isset($bracket) && count($bracket) > 0)
                                        <th>BRACKETS</th>
                                    @endif

                                    @if ($shade_opt->bracket_options)
                                        <th>BRACKETS OPTIONS</th>
                                    @endif

                                    @if (isset($stack) && count($stack) > 0)
                                        <th>STACKS</th>
                                    @endif

                                    @if (isset($springassist) && count($springassist) > 0)
                                        <th>SPRING ASSIST</th>
                                    @endif

                                    <th style="width: 0; display:none"></th>
                                </tr>
                            </thead>
                            <tbody id="bulk-cart-rows">

                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <label for="sp_instructions_bulk" class="">Special Instructions</label>
                        <textarea class="form-control form-control-sm sp_instructions" id="sp_instructions_bulk" name="sp_instructions_bulk" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <div class="dlist-align">
                <span>Grand Total:</span>
                <span class="text-dark b ml-3 text-right">$ <span id="grandtotal">0.00</span></dd>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <button type="button" class="btn btn-secondary" id="bulkCartAddition">Add To Cart</button>
        </div>
    </div>

    <div class="loader-service makeItHidden">
        <i class="las la-circle-notch"></i>
    </div>
@endsection

{{-- TODO: Calculation problems --}}

@section('script')
    <script src="{{ static_asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ static_asset('assets/js/print.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var obj_price = '<?php echo json_encode($price_arr); ?>';
            var obj = JSON.parse(obj_price); // Price list obj
            window.obj = obj;

            var initialCartIndex = 1;

            function addNewBulkRow() {
                $(".loader-service").removeClass('makeItHidden');
                var url = `{{ route('seller.products.bulknewrow') }}`;
                var token = '{{ csrf_token() }}';
                var productId = '{{ $product->id }}';
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        '_token': token,
                        'rowIndex': initialCartIndex,
                        'productId': productId
                    },
                    dataType: 'html',
                    success: function(response) {
                        if (response !== 'error') {
                            $("#bulk-cart-rows").append(response);
                            initialCartIndex++;
                        } else {
                            alert("You can add maximum 50 items as bulk.");
                        }
                    },
                    error: function(error) {
                        alert("Unknown error occurred");
                    },
                    complete: function(result) {
                        $(".loader-service").addClass('makeItHidden');
                    }
                });
            }

            $(document).on("click", ".remove-product-row", function() {
                let index = parseInt($(this).data("index"));
                if (index > 1) {
                    $("#cart-row-" + index).remove();
                    getBulkGradndTotal();
                }
            });

            // Add a row when loaded
            addNewBulkRow();

            function getParentTableRow(currentElem) {
                var index = currentElem.closest(".cart-row").attr('data-index');
                return $("#cart-row-" + index);
            }

            function getRowIndex(currentElem) {
                return currentElem.closest(".cart-row").attr('data-index');
            }

            $(".newItemBtn").click(function() {
                addNewBulkRow();
            });

            //Room type & Window Description Relatino
            $(document).on('change', '.room_type', function() {
                var parentElement = getParentTableRow($(this));
                if ((parentElement.find('.room_type option:selected').text()).toLowerCase() == 'other') {
                    parentElement.find(".window_desc").removeClass("hide");
                    parentElement.find(".window_desc").closest('.form-group').find('label').removeClass("hide");
                } else {
                    parentElement.find(".window_desc").addClass("hide");
                    parentElement.find(".window_desc").closest('.form-group').find('label').addClass("hide");
                }
            });

            // Control Type
            $(document).on('change', '.controltype', function() {
                var controltype = $(this).val();
                var parentElement = getParentTableRow($(this));

                switch (controltype) {
                    case 'motor':
                        parentElement.find('.manual_sel, .chain_color_box, .cord_color_box, .chain_ctrl, .cord_ctrl').hide();
                        parentElement.find('.motor_pos, .motor_type, .motor_cntrl, .smart_opts').show();
                        break;
                    case 'manual':
                        parentElement.find('.motor_pos, .motor_type, .motor_cntrl, .smart_opts, .shad_wand_len, .shad_wand_side, .channel_guideline').hide();
                        parentElement.find('.manual_sel').show();
                        break;
                    default:
                        parentElement.find('.manual_sel, .chain_color_box, .cord_color_box, .chain_ctrl, .cord_ctrl').hide();
                        parentElement.find('.motor_pos, .motor_type, .motor_cntrl, .smart_opts, .shad_wand_len, .shad_wand_side, .channel_guideline').hide();

                }
            });

            // Motor Type
            $(document).on('change', '.motor_type', function() {
                var name = $(this).find('option:selected').text();
                var parentElement = getParentTableRow($(this));
                if (name == 'Shadeowand') {
                    parentElement.find('.shad_wand_len').show();
                    parentElement.find('.shad_wand_side').show();
                } else {
                    parentElement.find('.shad_wand_len').hide();
                    parentElement.find('.shad_wand_side').hide();
                }
                parentElement.find('.motor_name').val(name);
            });
            $(document).on('change', '.brackets', function() {
                var val = $(this).find('option:selected').val();
                var parentElement = getParentTableRow($(this));
                if (val) {
                    parentElement.find(".brackets_opt").show();
                } else {
                    parentElement.find(".brackets_opt").hide();
                }
            });

            // Motor Control / Remote
            $(document).on('change', '.motor_cntrl', function() {
                var motor_cntrl = $(this).val();
                var parentElement = getParentTableRow($(this));
                if (motor_cntrl) {
                    parentElement.find('.channel_guideline').show();
                } else {
                    parentElement.find('.channel_guideline').hide();
                }
                parentElement.find('.remote_ctrl_channel').val(motor_cntrl);
            });

            // Manual
            $(document).on('change', '.manual_sel', function() {
                var name = $(this).find('option:selected').text();
                var parentElement = getParentTableRow($(this));
                if (name == 'Chain') {
                    parentElement.find('.cord_color_box, .cord_ctrl, .cord_color').hide();
                    parentElement.find('.chain_color_box, .chain_ctrl, .chain_color').show();
                } else if (name == 'Cord') {
                    parentElement.find('.chain_color_box, .chain_ctrl, .chain_color').hide();
                    parentElement.find('.cord_color_box, .cord_ctrl, .cord_color').show();
                }
            });

            // Quantity
            $(document).on('change', '.quantity', function() {
                var parentElement = getParentTableRow($(this));
                var quantity = $(this).find('option:selected').val();
                if (quantity > 1) {
                    var chk = `@php
                        if (isset($brkt_opt_chk)) {
                            echo $brkt_opt_chk;
                    } @endphp`;

                    if (chk > 0) {
                        parentElement.find(".brackets_opt").removeClass('hide');
                    }
                } else {
                    parentElement.find(".brackets_opt").addClass('hide');
                    parentElement.find(".brackets_opt option").prop("selected", false);
                }
            });

            // Mount
            $(document).on('change', '.mount', function() {
                var parentElement = getParentTableRow($(this));
                parentElement.find('.mount_type').val($(this).find('option:selected').text());
            });

            // Cassette Color
            $(document).on('change', '.cassette_type', function(e) {
                var parentElement = getParentTableRow($(this));
                $(".loader-service").removeClass('makeItHidden');
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var cass_id = $(this).find('option:selected').data('cassette-id') ? $(this).find('option:selected').data('cassette-id') : 0;
                $.ajax({
                    url: "{{ route('cassette.color') }}",
                    type: "post",
                    data: {
                        cass_id: cass_id
                    },
                    success: function(result) {
                        parentElement.find('.cassette_color').find('option').remove();
                        parentElement.find('.cassette_color').append(result);
                        $(".loader-service").addClass('makeItHidden');
                    }
                });
            });

            function getBulkGradndTotal() {
                var rows = $("#bulk-cart-rows tr.cart-row");
                var bulkTotal = 0;
                rows.each(function() {
                    var singleRowPrice = singleRowTotal($(this));
                    if (singleRowPrice && singleRowPrice.grand_total > 0) {
                        bulkTotal += singleRowPrice.grand_total;
                    }
                });

                if (bulkTotal && bulkTotal > 0) {
                    $("#grandtotal").text(bulkTotal.toFixed(2));
                }
            }

            function singleRowTotal(element) {
                var parentElement = getParentTableRow(element);

                var qty = parentElement.find('.quantity').val() != "" ? parseInt(parentElement.find('.quantity').val()) : 0;
                var width_calc = parentElement.find('.width').find(":selected").data('price');
                var width_calc_val = parseInt(parentElement.find('.width').find(":selected").val());
                var width_decimal_calc = parseFloat(parentElement.find('.wid_decimal').find(":selected").val());
                var length_calc = parentElement.find('.length').find(":selected").data('price');
                var length_calc_val = parseInt(parentElement.find('.length').find(":selected").val());
                var length_decimal_calc = parseFloat(parentElement.find('.len_decimal').find(":selected").val());
                var wrap_expose = parentElement.find('.wrap_expose').find(":selected").val();
                var cassette_type = parentElement.find('.cassette_type').find(":selected").val();
                var controltype = parentElement.find('.controltype').find(":selected").val();
                var motor_type_price = parseInt(parentElement.find('.motor_type').find(":selected").val());
                var motor_cntrl_price = parseInt(parentElement.find('.motor_cntrl').find(":selected").val()); // Channel
                var plugin_charger_price = parseInt(parentElement.find('.plugin_charger').find(":selected").val() ?? 0);
                var solar_panel_price = parseInt(parentElement.find('.solar_panel').find(":selected").val() ?? 0);
                var shade_smart_hub_price = parseInt(parentElement.find('.shade_smart_hub').find(":selected").val() ?? 0);
                var shade_smart_transformers_price = parseInt(parentElement.find('.shade_smart_transformers').find(":selected").val() ?? 0);
                var brackets_opt_price = parentElement.find('.brackets_opt option:selected').val() ? parentElement.find('.brackets_opt option:selected').val() : 0;
                var spring_assist = parentElement.find('.spring_chk option:selected').val() ? parentElement.find('.spring_chk option:selected').val() : 0;

                brackets_opt_price = parseFloat(brackets_opt_price) ? parseFloat(brackets_opt_price) : 0;
                spring_assist = parseFloat(spring_assist) ? parseFloat(spring_assist) : 0;

                if (!width_calc || !length_calc || !qty) {
                    return {
                        suggested_price: 0,
                        grand_total: 0
                    }
                }

                //Start
                var findObjVal = [];

                if (obj[obj.length - 1].width == width_calc) {
                    width_decimal_calc = 0;
                }

                if ((obj[0].width > width_calc_val && obj[0].length > length_calc_val) ||
                    (
                        (parseInt(width_calc) > parseInt(width_calc_val)) &&
                        (parseInt(length_calc) > parseInt(length_calc_val)) ||
                        (width_decimal_calc < 0.125 && width_calc && length_calc && length_decimal_calc < 0.125)
                    )
                ) {
                    $.each(obj, function(key, value) {
                        if (value.width == width_calc && value.length == length_calc) {
                            findObjVal = value;
                        }
                    });
                } else {
                    let width_key = 0;
                    let length_key = 0;
                    $.each(obj, function(key, value) {
                        // If width Increase
                        if (width_decimal_calc >= 0.125 && length_decimal_calc < 0.125) {
                            if (value.width == width_calc && value.length == length_calc) {
                                width_key = key;
                                while (parseInt(obj[width_key++].width) <= parseInt(width_calc) + parseInt(obj[width_key - 1].wid_diff) && obj.length != width_key) {
                                    if ((parseInt(width_calc) > parseInt(width_calc_val))) {
                                        width_key--;
                                    }
                                    if (obj[width_key].length == length_calc) {
                                        findObjVal = obj[width_key];
                                        return false;
                                    }
                                }
                            }
                            // If length Increase
                        } else if (width_decimal_calc < 0.125 && length_decimal_calc >= 0.125) {
                            if (value.width == width_calc && value.length == length_calc) {
                                findObjVal = obj[key];
                                length_key = key;
                                //motor array price

                                while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) {
                                    if ((parseInt(length_calc) > parseInt(length_calc_val))) {
                                        length_key--;
                                    }
                                    // code ..
                                    if (obj[length_key].width == width_calc) {
                                        findObjVal = obj[length_key];
                                        return false;
                                    }
                                }
                            }
                            // If both Increase
                        } else {
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

                                        findObjVal = obj[width_key];

                                        while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) {
                                            if ((parseInt(length_calc) > parseInt(length_calc_val))) {
                                                length_key--;
                                            }
                                            // code ..
                                            if (obj[length_key].width == width_calc) {
                                                findObjVal = obj[length_key];
                                                return false;
                                            }
                                        }
                                        return false;
                                    }
                                }
                            }
                        }
                    });
                }

                //Ends

                var suggestedPrice = 0;
                var grandTotal = 0;
                var priceArr = findObjVal;

                //Basically calculates shade_amount and we are apllying only discount on shade_amount:TODO:

                window.priceArr = priceArr;

                if (priceArr) {
                    suggestedPrice = priceArr.price;
                    var discount = parentElement.find('.disc_percent').val();
                    if (discount) {
                        discount = ((discount / 100) * suggestedPrice) * qty;
                    }
                }

                // Wrapped / Exposed
                if (wrap_expose === 'duo_fabwrap_01') {
                    suggestedPrice += parseFloat(priceArr.fabric_wrap);
                }

                // Cassette
                if (cassette_type === 'duo_sqcass_01') {
                    suggestedPrice += parseFloat(priceArr.square_cassette);
                }

                // Motorization
                if (controltype === 'motor' && motor_type_price > 0) {
                    suggestedPrice += parseFloat(motor_type_price);
                }
                if (controltype === 'motor' && motor_cntrl_price > 0) {
                    suggestedPrice += parseFloat(motor_cntrl_price);
                }
                if (controltype === 'motor' && plugin_charger_price > 0) {
                    suggestedPrice += parseFloat(plugin_charger_price);
                }
                if (controltype === 'motor' && solar_panel_price > 0) {
                    suggestedPrice += parseFloat(solar_panel_price);
                }
                if (controltype === 'motor' && shade_smart_hub_price > 0) {
                    suggestedPrice += parseFloat(shade_smart_hub_price);
                }
                if (controltype === 'motor' && shade_smart_transformers_price > 0) {
                    suggestedPrice += parseFloat(shade_smart_transformers_price);
                }
                suggestedPrice += brackets_opt_price;
                suggestedPrice += spring_assist;

                suggestedPrice *= qty;
                grandTotal = suggestedPrice - discount;

                parentElement.find('.suggested-price').text(suggestedPrice.toFixed(2));
                parentElement.find('.grand-total').text(grandTotal.toFixed(2));
                return ({
                    suggested_price: suggestedPrice,
                    grand_total: grandTotal
                });
            }

            $(document).on('change', '.calc_prices', function(e) {
                getBulkGradndTotal();
            });


            $('.calc_prices').on('change', function() {

                var parentElement = getParentTableRow($(this));

                if (parentElement.find('.width').val() > 96) {
                    parentElement.find('.spring_chk option[value="90"]').prop("selected", true);
                    parentElement.find('.spring_price').text(90);
                }

                width_calc = parentElement.find('.width').find(":selected").data('price');
                width_calc_val = parentElement.find('.width').find(":selected").val();
                width_decimal_calc = parentElement.find('.wid_decimal').find(":selected").val();
                length_calc = parentElement.find('.length').find(":selected").data('price');
                length_calc_val = parentElement.find('.length').find(":selected").val();
                length_decimal_calc = parentElement.find('.len_decimal').find(":selected").val();

                if (obj[obj.length - 1].width == width_calc) {
                    width_decimal_calc = 0;
                }

                if (
                    (obj[0].width > width_calc_val && obj[0].length > length_calc_val) ||
                    (
                        (parseInt(width_calc) > parseInt(width_calc_val)) &&
                        (parseInt(length_calc) > parseInt(length_calc_val)) ||
                        (width_decimal_calc < 0.125 && width_calc && length_calc && length_decimal_calc < 0.125)
                    )
                ) {
                    $.each(obj, function(key, value) {
                        if (value.width == width_calc && value.length == length_calc) {
                            parentElement.find('.shade_price').text(value.price);
                            parentElement.find('.shade_amount').val(value.price);
                            parentElement.find('.cassette_type').attr("data-cassette-type-price", obj[key].square_cassette);
                            parentElement.find('.cassette_type').attr("data-stdcas-price", obj[key].std_r_cassette);
                            parentElement.find('.cassette_type').attr("data-roundcas-price", obj[key].round_cassette);
                            parentElement.find('.w_exp').attr("data-wrap-expose-price", obj[key].fabric_wrap);
                        }
                    });
                } else {
                    let width_key = 0;
                    let length_key = 0;
                    $.each(obj, function(key, value) {
                        // If width Increase
                        if (width_decimal_calc >= 0.125 && length_decimal_calc < 0.125) {
                            if (value.width == width_calc && value.length == length_calc) {
                                width_key = key;
                                while (parseInt(obj[width_key++].width) <= parseInt(width_calc) + parseInt(obj[width_key - 1].wid_diff) && obj.length != width_key) {
                                    if ((parseInt(width_calc) > parseInt(width_calc_val))) {
                                        width_key--;
                                    }
                                    if (obj[width_key].length == length_calc) {
                                        parentElement.find('.shade_price').text(obj[width_key].price);
                                        parentElement.find('.shade_amount').val(obj[width_key].price);
                                        parentElement.find('.cassette_type').attr("data-cassette-type-price", obj[width_key].square_cassette);
                                        parentElement.find('.cassette_type').attr("data-stdcas-price", obj[width_key].std_r_cassette);
                                        parentElement.find('.cassette_type').attr("data-roundcas-price", obj[width_key].round_cassette);
                                        parentElement.find('.w_exp').attr("data-wrap-expose-price", obj[width_key].fabric_wrap);
                                        //motor array price
                                        if ((obj[width_key].price_tag == 11) || (obj[width_key].price_tag = 12)) {
                                            parentElement.find('.motor_array_price').text(obj[width_key].motor_array);
                                            parentElement.find('.motor_arr_pri').val(obj[width_key].motor_array);
                                        }

                                        return false;
                                    }
                                }
                            }
                            // If length Increase
                        } else if (width_decimal_calc < 0.125 && length_decimal_calc >= 0.125) {
                            if (value.width == width_calc && value.length == length_calc) {
                                parentElement.find('.cassette_type').attr("data-cassette-type-price", obj[key].square_cassette);
                                parentElement.find('.cassette_type').attr("data-stdcas-price", obj[key].std_r_cassette);
                                parentElement.find('.cassette_type').attr("data-roundcas-price", obj[key].round_cassette);
                                parentElement.find('.w_exp').attr("data-wrap-expose-price", obj[key].fabric_wrap);
                                length_key = key;
                                //motor array price
                                if ((obj[key].price_tag == 11) || (obj[key].price_tag = 12)) {
                                    parentElement.find('.motor_array_price').text(obj[key].motor_array);
                                    parentElement.find('.motor_arr_pri').val(obj[key].motor_array)
                                }

                                while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) {
                                    if ((parseInt(length_calc) > parseInt(length_calc_val))) {
                                        length_key--;
                                    }
                                    // code ..
                                    if (obj[length_key].width == width_calc) {
                                        parentElement.find('.shade_price').text(obj[length_key].price);
                                        console.log(obj[length_key].price);
                                        parentElement.find('.shade_amount').val(obj[length_key].price);
                                        return false;
                                    }
                                }
                            }
                            // If both Increase
                        } else {
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

                                        parentElement.find('.shade_price').text(obj[width_key].price);
                                        parentElement.find('.shade_amount').val(obj[width_key].price);
                                        parentElement.find('.cassette_type').attr("data-cassette-type-price", obj[width_key].square_cassette);
                                        parentElement.find('.cassette_type').attr("data-stdcas-price", obj[width_key].std_r_cassette);
                                        parentElement.find('.cassette_type').attr("data-roundcas-price", obj[width_key].round_cassette);
                                        parentElement.find('.w_exp').attr("data-wrap-expose-price", obj[width_key].fabric_wrap);
                                        //motor array price
                                        if ((obj[width_key].price_tag == 11) || (obj[width_key].price_tag = 12)) {
                                            parentElement.find('.motor_array_price').text(obj[width_key].motor_array);
                                        }

                                        while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) {
                                            if ((parseInt(length_calc) > parseInt(length_calc_val))) {
                                                length_key--;
                                            }
                                            // code ..
                                            if (obj[length_key].width == width_calc) {
                                                parentElement.find('.shade_price').text(obj[length_key].price);
                                                parentElement.find('.shade_amount').val(obj[length_key].price);
                                                return false;
                                            }
                                        }
                                        return false;
                                    }
                                }
                            }
                        }
                    });
                }

            });

            function addBulkToCart() {
                var rows = $("#bulk-cart-rows tr.cart-row");
                let to_add = true;
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    to_add = addToCart($(row));
                    if (!to_add) {
                        break;
                    }
                }
                return to_add;
            }

            function addToCart(row) {
                var parentElement = getParentTableRow(row);

                /* First of all validate */
                if (!parentElement.find('.room_type option:selected').val()) {
                    parentElement.find('.room_type')[0].reportValidity();
                    return false;
                }
                if (!parentElement.find('.quantity').val()) {
                    parentElement.find('.quantity')[0].reportValidity();
                    return false;
                }
                if (!parentElement.find('.width').val()) {
                    parentElement.find('.width')[0].reportValidity();
                    return false;
                }
                if (!parentElement.find('.wid_decimal').val()) {
                    parentElement.find('.wid_decimal')[0].reportValidity();
                    return false;
                }
                if (!parentElement.find('.length').val()) {
                    parentElement.find('.length')[0].reportValidity();
                    return false;
                }
                if (!parentElement.find('.len_decimal').val()) {
                    parentElement.find('.len_decimal')[0].reportValidity();
                    return false;
                }
                if (!parentElement.find('.controltype option:selected').val()) {
                    parentElement.find('.controltype')[0].setCustomValidity("Choose a control type");
                    parentElement.find('.controltype')[0].reportValidity();
                    return false;
                }

                if (parentElement.find(".controltype option:selected").val() == "manual") {
                    if (parentElement.find(".manual_sel option:selected").val() == "") {
                        parentElement.find('.manual_sel')[0].setCustomValidity("Choose chain/cord type");
                        parentElement.find('.manual_sel')[0].reportValidity();
                        return false;
                    }
                    if (parentElement.find(".manual_sel option:selected").text() == "Chain") {
                        if (parentElement.find(".chain_ctrl option:selected").val() == "") {
                            parentElement.find('.chain_ctrl')[0].setCustomValidity("Choose a chain control side");
                            parentElement.find('.chain_ctrl')[0].reportValidity();
                            return false;
                        }
                    } else if (parentElement.find(".manual_sel option:selected").text() == "Cord") {
                        if (parentElement.find(".cord_ctrl option:selected").val() == "") {
                            parentElement.find('.cord_ctrl')[0].setCustomValidity("Choose a cord control side");
                            parentElement.find('.cord_ctrl')[0].reportValidity();
                            return false;
                        }
                    }
                }

                if (parentElement.find(".controltype option:selected").val() == "motor") {
                    if (parentElement.find(".motor_pos option:selected").val() == "") {
                        parentElement.find(".motor_pos")[0].setCustomValidity("Choose Motor Position");
                        parentElement.find(".motor_pos")[0].reportValidity();
                        return false;
                    }
                    if (parentElement.find(".motor_type option:selected").val() == "") {
                        parentElement.find(".motor_type")[0].setCustomValidity("Choose Motor Type");
                        parentElement.find(".motor_type")[0].reportValidity();
                        return false;
                    }
                    if (parentElement.find(".motor_cntrl option:selected").val() == "") {
                        parentElement.find(".motor_cntrl")[0].setCustomValidity("Choose Motor Control");
                        parentElement.find(".motor_cntrl")[0].reportValidity();
                        return false;
                    }
                }

                if (parentElement.find("[name='mount'] option:selected").val() == "") {
                    parentElement.find("[name='mount']")[0].reportValidity();
                    return false;
                }

                if (!parentElement.find('.fabric option:selected').val()) {
                    parentElement.find('.fabric')[0].setCustomValidity("Choose a fabric type");
                    parentElement.find('.fabric')[0].reportValidity();
                    return false;
                }
                if (parentElement.find(".cassette_type option:selected").val() == "") {
                    parentElement.find(".cassette_type")[0].reportValidity();
                    return false;
                }
                if (parentElement.find(".wrap_expose option:selected").val() == "") {
                    parentElement.find(".wrap_expose")[0].reportValidity();
                    return false;
                }
                if (parentElement.find(".brackets option:selected").val() == "") {
                    parentElement.find(".brackets")[0].reportValidity();
                    return false;
                }


                if (localStorage.getItem('key') != null) {
                    key = parseInt(localStorage.getItem('key'));
                } else {
                    localStorage.setItem('key', 0);
                }
                var dealer_name = parentElement.find('.dealer_name').val() ? parentElement.find('.dealer_name').val() : '';
                var cust_side_mark = parentElement.find('.cust_side_mark').val() ? parentElement.find('.cust_side_mark').val() : '';
                var order_number = parentElement.find('.order_number').val() ? parentElement.find('.order_number').val() : '';
                var room_type = parentElement.find('.room_type option:selected').text() ? parentElement.find('.room_type option:selected').text() : '';
                var window_desc = parentElement.find('.window_desc').val() ? parentElement.find('.window_desc').val() : '';

                var quantity = parentElement.find('.quantity').val() ? parentElement.find('.quantity').val() : '';
                var width = parentElement.find('.width').val() ? parentElement.find('.width').val() : '';
                var wid_decimal = parentElement.find('.wid_decimal').val() ? parentElement.find('.wid_decimal').val() : '';
                var length = parentElement.find('.length').val() ? parentElement.find('.length').val() : '';
                var len_decimal = parentElement.find('.len_decimal').val() ? parentElement.find('.len_decimal').val() : '';

                var fabric = parentElement.find('.fabric option:selected').text() ? parentElement.find('.fabric option:selected').text() : '';
                var brackets = parentElement.find('.brackets option:selected').text() ? parentElement.find('.brackets option:selected').text() : '';
                var sp_instructions = $('.sp_instructions').val() ? $('.sp_instructions').val() : '';

                //Product Info
                var prod_id = parentElement.find('.id').val() ? parentElement.find('.id').val() : '';
                var img_url = parentElement.find('.main_img').val() ? parentElement.find('.main_img').val() : '';
                var prod_name = parentElement.find('.product_name').val() ? parentElement.find('.product_name').val() : '';

                //Price
                var width_calc = parentElement.find('.width').find(":selected").data('price');
                var width_decimal_calc = parseFloat(parentElement.find('.wid_decimal').find(":selected").val());
                var length_calc = parentElement.find('.length').find(":selected").data('price');
                var length_decimal_calc = parseFloat(parentElement.find('.len_decimal').find(":selected").val());
                var width_key = width_calc;
                var length_key = length_calc;

                if (width_decimal_calc > 0) {
                    width_key = obj.filter(function(element, index) {
                        return (element.width > width_key);
                    });
                    width_key = width_key[0].width;
                }
                if (length_decimal_calc > 0) {
                    length_key = obj.filter(function(element, index) {
                        return (element.length > length_key);
                    });
                    length_key = length_key[0].length;
                }

                console.log(width_key, length_key);

                var priceArr = obj.filter(function(element, index) {
                    return (element.width === width_key && element.length === length_key);
                });
                priceArr = priceArr[0];

                var priceObj = singleRowTotal(row);
                price = priceObj.grand_total;
                var disc_percent = parentElement.find('.disc_percent').val() ? parentElement.find('.disc_percent').val() : '';
                var shade_price = priceArr.price;
                var cassette_type = parentElement.find('.cassette_type option:selected').val() ? parentElement.find('.cassette_type option:selected').val() : '';
                var cassette_price = (cassette_type == 'duo_sqcass_01') ? priceArr.square_cassette : 0;
                var cassette_color = parentElement.find('.cassette_color option:selected').text() ? parentElement.find('.cassette_color option:selected').text() : '';
                var mount_price = parentElement.find('.mount option:selected').val() ? parentElement.find('.mount option:selected').val() : '';
                var mount_type = parentElement.find('.mount option:selected').text() ? parentElement.find('.mount option:selected').text() : '';
                var mount_pos = parentElement.find('.mount_pos option:selected').text() ? parentElement.find('.mount_pos option:selected').text() : '';
                var wrap_expose = parentElement.find('.wrap_expose option:selected').val() ? parentElement.find('.wrap_expose option:selected').val() : '';
                var wrap_price = (wrap_expose == 'duo_fabwrap_01') ? priceArr.fabric_wrap : 0;
                var brackets_opt = parentElement.find('.brackets_opt option:selected').val() != "" ? parentElement.find('.brackets_opt option:selected').text() : '';
                var brackets_opt_price = parentElement.find('.brackets_opt option:selected').val() ? parentElement.find('.brackets_opt option:selected').val() : 0;
                var stack = parentElement.find('.stack option:selected').text() ? parentElement.find('.stack option:selected').text() : '';
                var spring_assist = parentElement.find('.spring_chk option:selected').val() ? parentElement.find('.spring_chk option:selected').val() : 0;

                var control_type = parentElement.find('.controltype option:selected').val() ? parentElement.find('.controltype option:selected').val() : '';
                if (parentElement.find('.motor_type option:selected').val() != '') {
                    var motor_name = parentElement.find('.motor_type option:selected').text() ? parentElement.find('.motor_type option:selected').text() : '';
                } else {
                    var motor_name = '';
                }
                var motor_pos = parentElement.find('.motor_pos option:selected').text() ? parentElement.find('.motor_pos option:selected').text() : '';
                var motor_price = parentElement.find('.motor_type').find(":selected").val() ? parentElement.find('.motor_type').find(":selected").val() : 0;
                if (parentElement.find('.motor_cntrl option:selected').val() != '') {
                    var channel_name = parentElement.find('.motor_cntrl option:selected').text() ? parentElement.find('.motor_cntrl option:selected').text() : '';
                } else {
                    var channel_name = '';
                }
                var channel_price = parentElement.find('.motor_cntrl').find(":selected").val() ? parentElement.find('.motor_cntrl').find(":selected").val() : 0;
                var motor_arr_price = parentElement.find('.ctype_arrprice').text() ? parentElement.find('.ctype_arrprice').text() : '';
                if (parentElement.find('.manual_sel option:selected').val() != '') {
                    var chain_cord = parentElement.find('.manual_sel option:selected').text() ? parentElement.find('.manual_sel option:selected').text() : '';
                } else {
                    var chain_cord = '';
                }
                if (parentElement.find('.chain_ctrl option:selected').val() != '') {
                    var chain_ctrl = parentElement.find('.chain_ctrl option:selected').text() ? parentElement.find('.chain_ctrl option:selected').text() : '';
                } else {
                    var chain_ctrl = '';
                }
                if (parentElement.find('.cord_ctrl option:selected').val() != '') {
                    var cord_ctrl = parentElement.find('.cord_ctrl option:selected').text() ? parentElement.find('.cord_ctrl option:selected').text() : '';
                } else {
                    var cord_ctrl = '';
                }
                var chain_color = $('input[name="chaincolor_arr"]:checked').val() ? $('input[name="chaincolor_arr"]:checked').val() : '';
                var cord_color = $('input[name="cordcolor_arr"]:checked').val() ? $('input[name="cordcolor_arr"]:checked').val() : '';

                var plugin_price = parentElement.find('.plugin_charger').val() ? parentElement.find('.plugin_charger').val() : 0;
                var solar_price = parentElement.find('.solar_panel').val() ? parentElement.find('.solar_panel').val() : 0;
                var hub_price = parentElement.find('.shade_smart_hub').val() ? parentElement.find('.shade_smart_hub').val() : 0;
                var transformer_price = parentElement.find('.shade_smart_transformers').val() ? parentElement.find('.shade_smart_transformers').val() : 0;

                var product = {
                    "cart_id": key,
                    "prod_id": prod_id,
                    "prod_name": prod_name,
                    "dealer_name": dealer_name,
                    "order_number": order_number,
                    "disc_percent": parseFloat(disc_percent),
                    "shade_price": parseInt(shade_price),
                    "mount_price": parseInt(mount_price),
                    "mount_type": mount_type,
                    "mount_pos": mount_pos,
                    "wrap_expose": wrap_expose,
                    "wrap_price": parseInt(wrap_price),
                    "cassette_price": parseInt(cassette_price),
                    "cassette_type": cassette_type,
                    "cassette_color": cassette_color,
                    "brackets_opt": brackets_opt,
                    "brackets_opt_price": brackets_opt_price,
                    "spring_assist_price": spring_assist == "" ? 0 : spring_assist,
                    "cust_side_mark": cust_side_mark,
                    "room_type": room_type,
                    "window_desc": window_desc,
                    "quantity": quantity,
                    "width": width,
                    "wid_decimal": parseFloat(wid_decimal),
                    "length": length,
                    "len_decimal": parseFloat(len_decimal),
                    "fabric": fabric,
                    "stack": stack,
                    "brackets": brackets,
                    "control_type": control_type,
                    "motor_name": motor_name,
                    "motor_pos": motor_pos,
                    "motor_price": motor_price,
                    "motor_arr_price": motor_arr_price,
                    "channel_name": channel_name,
                    "channel_price": parseInt(channel_price),
                    "plugin_price": parseInt(plugin_price),
                    "solar_price": parseInt(solar_price),
                    "hub_price": parseInt(hub_price),
                    "transformer_price": parseInt(transformer_price),
                    "chain_cord": chain_cord,
                    "chain_ctrl": chain_ctrl,
                    "chain_color": chain_color,
                    "cord_ctrl": cord_ctrl,
                    "cord_color": cord_color,
                    "sp_instructions": sp_instructions,
                    "main_img": img_url,
                    "price": parseFloat(price / quantity).toFixed(2),
                    "total": parseFloat(price).toFixed(2),
                    "parts": 0
                }
                window.product = product;
                let cart = JSON.parse(localStorage.getItem("cart") ?? "[]") ?? [];
                cart.push(product);
                localStorage.setItem("cart", JSON.stringify(cart));
                localStorage.setItem('key', parseInt(key) + parseInt(1));
                return true;
            }

            $("#bulkCartAddition").click(function() {
                if (addBulkToCart()) {
                    window.location.href = '{{ route('cart.seller.index') }}';
                }
            });

        });
    </script>
@endsection


<!-- 

    $('.calc_prices').on('change', function() {
                console.log("Changes calc here");

                var parentElement = getParentTableRow($(this));
                let dataIndexOfRow = parentElement.data("index");
                let obj = mainObj[dataIndexOfRow];

                if (parentElement.find('.width').val() > 96) {
                    parentElement.find('.spring_chk option[value="90"]').prop("selected", true);
                    parentElement.find('.spring_price').text(90);
                }

                width_calc = parentElement.find('.width').find(":selected").data('price');
                width_calc_val = parentElement.find('.width').find(":selected").val();
                width_decimal_calc = parentElement.find('.wid_decimal').find(":selected").val();
                length_calc = parentElement.find('.length').find(":selected").data('price');
                length_calc_val = parentElement.find('.length').find(":selected").val();
                length_decimal_calc = parentElement.find('.len_decimal').find(":selected").val();

                if (obj[obj.length - 1].width == width_calc) {
                    width_decimal_calc = 0;
                }

                if (
                    (obj[0].width > width_calc_val && obj[0].length > length_calc_val) ||
                    (
                        (parseInt(width_calc) > parseInt(width_calc_val)) &&
                        (parseInt(length_calc) > parseInt(length_calc_val)) ||
                        (width_decimal_calc < 0.125 && width_calc && length_calc && length_decimal_calc < 0.125)
                    )
                ) {
                    $.each(obj, function(key, value) {
                        if (value.width == width_calc && value.length == length_calc) {
                            parentElement.find('.shade_price').text(value.price);
                            parentElement.find('.shade_amount').val(value.price);
                            parentElement.find('.cassette_type').attr("data-cassette-type-price", obj[key].square_cassette);
                            parentElement.find('.cassette_type').attr("data-stdcas-price", obj[key].std_r_cassette);
                            parentElement.find('.cassette_type').attr("data-roundcas-price", obj[key].round_cassette);
                            parentElement.find('.w_exp').attr("data-wrap-expose-price", obj[key].fabric_wrap);
                        }
                    });
                } else {
                    let width_key = 0;
                    let length_key = 0;
                    $.each(obj, function(key, value) {
                        // If width Increase
                        if (width_decimal_calc >= 0.125 && length_decimal_calc < 0.125) {
                            if (value.width == width_calc && value.length == length_calc) {
                                width_key = key;
                                while (parseInt(obj[width_key++].width) <= parseInt(width_calc) + parseInt(obj[width_key - 1].wid_diff) && obj.length != width_key) {
                                    if ((parseInt(width_calc) > parseInt(width_calc_val))) {
                                        width_key--;
                                    }
                                    if (obj[width_key].length == length_calc) {
                                        parentElement.find('.shade_price').text(obj[width_key].price);
                                        parentElement.find('.shade_amount').val(obj[width_key].price);
                                        parentElement.find('.cassette_type').attr("data-cassette-type-price", obj[width_key].square_cassette);
                                        parentElement.find('.cassette_type').attr("data-stdcas-price", obj[width_key].std_r_cassette);
                                        parentElement.find('.cassette_type').attr("data-roundcas-price", obj[width_key].round_cassette);
                                        parentElement.find('.w_exp').attr("data-wrap-expose-price", obj[width_key].fabric_wrap);
                                        //motor array price
                                        if ((obj[width_key].price_tag == 11) || (obj[width_key].price_tag = 12)) {
                                            parentElement.find('.motor_array_price').text(obj[width_key].motor_array);
                                            parentElement.find('.motor_arr_pri').val(obj[width_key].motor_array);
                                        }

                                        return false;
                                    }
                                }
                            }
                            // If length Increase
                        } else if (width_decimal_calc < 0.125 && length_decimal_calc >= 0.125) {
                            if (value.width == width_calc && value.length == length_calc) {
                                parentElement.find('.cassette_type').attr("data-cassette-type-price", obj[key].square_cassette);
                                parentElement.find('.cassette_type').attr("data-stdcas-price", obj[key].std_r_cassette);
                                parentElement.find('.cassette_type').attr("data-roundcas-price", obj[key].round_cassette);
                                parentElement.find('.w_exp').attr("data-wrap-expose-price", obj[key].fabric_wrap);
                                length_key = key;
                                //motor array price
                                if ((obj[key].price_tag == 11) || (obj[key].price_tag = 12)) {
                                    parentElement.find('.motor_array_price').text(obj[key].motor_array);
                                    parentElement.find('.motor_arr_pri').val(obj[key].motor_array)
                                }

                                while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) {
                                    if ((parseInt(length_calc) > parseInt(length_calc_val))) {
                                        length_key--;
                                    }
                                    // code ..
                                    if (obj[length_key].width == width_calc) {
                                        parentElement.find('.shade_price').text(obj[length_key].price);
                                        console.log(obj[length_key].price);
                                        parentElement.find('.shade_amount').val(obj[length_key].price);
                                        return false;
                                    }
                                }
                            }
                            // If both Increase
                        } else {
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

                                        parentElement.find('.shade_price').text(obj[width_key].price);
                                        parentElement.find('.shade_amount').val(obj[width_key].price);
                                        parentElement.find('.cassette_type').attr("data-cassette-type-price", obj[width_key].square_cassette);
                                        parentElement.find('.cassette_type').attr("data-stdcas-price", obj[width_key].std_r_cassette);
                                        parentElement.find('.cassette_type').attr("data-roundcas-price", obj[width_key].round_cassette);
                                        parentElement.find('.w_exp').attr("data-wrap-expose-price", obj[width_key].fabric_wrap);
                                        //motor array price
                                        if ((obj[width_key].price_tag == 11) || (obj[width_key].price_tag = 12)) {
                                            parentElement.find('.motor_array_price').text(obj[width_key].motor_array);
                                        }

                                        while (parseInt(obj[length_key++].length) <= parseInt(length_calc) + parseInt(obj[length_key - 1].len_diff)) {
                                            if ((parseInt(length_calc) > parseInt(length_calc_val))) {
                                                length_key--;
                                            }
                                            // code ..
                                            if (obj[length_key].width == width_calc) {
                                                parentElement.find('.shade_price').text(obj[length_key].price);
                                                parentElement.find('.shade_amount').val(obj[length_key].price);
                                                return false;
                                            }
                                        }
                                        return false;
                                    }
                                }
                            }
                        }
                    });
                }

            });

 -->