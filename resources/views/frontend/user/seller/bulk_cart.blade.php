@extends('frontend.layouts.user_panel')
@section('panel_content')
    <style>
        .aiz-user-panel {
            padding-right: 30px;
        }

        img.fabric-group-img {
            width: 80px;
            margin-top: 10px;
            margin-left: 5px;
        }

        .aiz-user-sidenav-wrap {
            transition: 350ms ease-in all;
        }

        .aiz-user-sidenav-wrap.sidebar-transition-hide {
            max-width: 0px !important;
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
            <div class="col-md-6 d-flex align-items-center">
                <span class="btn btn-soft-success mr-2 p-2" onclick="toggleSidebar()">
                    <i class="la la-arrow-alt-circle-left"></i>
                </span>
                <h1 class="h3 m-0">{{ translate('Bulk Order') }}</h1>
            </div>
            <div class="col-md-6">
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
                                    <th>PRODUCTS</th>
                                    <th>ROOM TYPE</th>
                                    <th>QTY & MEASUREMENTS</th>
                                    <th>CONTROL</th>
                                    <th>MOUNT</th>
                                    <th>FABRIC</th>
                                    <th>CASSETTE</th>
                                    <th>B RAIL</th>
                                    <th>WRAPPED</th>
                                    <th>BRACKETS / OPTIONS</th>
                                    <th>STACKS</th>
                                    <th>SPRING ASSIST</th>
                                    <th style="width: 0; display:none"></th>
                                </tr>
                            </thead>
                            <tbody id="bulk-cart-rows">

                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">

                        </div>

                        <div class="col-md-4 d-flex justify-content-end">
                            <button type="button" style="width: 192px; height: 45px" class="btn btn-primary btn-circle newItemBtn">
                                <i class="las la-plus"></i> ADD NEW
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sp_instructions_bulk" class="">Special Instructions</label>
                        <textarea class="form-control form-control-sm sp_instructions" id="sp_instructions_bulk" name="sp_instructions_bulk" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5" style="margin-right: 25px">
        <div class="col-md-6">
            <div class="dlist-align">
                <span>Grand Total:</span>
                <span class="text-dark b ml-3 text-right">$ <span id="grandtotal">0.00</span></dd>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end p-0">
            <button type="button" style="width: 192px; height: 45px" class="btn btn-circle btn-info" id="bulkCartAddition"> <i class="las la-cart-plus"></i> Add To Cart</button>
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
        function toggleSidebar() {
            $(".aiz-user-sidenav-wrap").toggleClass("sidebar-transition-hide");
        }

        $(document).ready(function() {

            var mainObj = [];

            var initialCartIndex = 1;

            function addNewBulkRow() {

                var rows_total_numbers = $("#bulk-cart-rows tr.cart-row").length;
                if (rows_total_numbers >= 50) {
                    alert("You can add upto 50 rows")
                    return;
                }

                $(".loader-service").removeClass('makeItHidden');
                var url = `{{ route('seller.products.bulknewrow') }}`;
                var token = '{{ csrf_token() }}';
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        '_token': token,
                        'rowIndex': initialCartIndex,
                    },
                    success: function(response) {
                        if (response !== 'error') {
                            $("#bulk-cart-rows").append(response.html);
                            mainObj[initialCartIndex] = response.price_arr
                            window.obj = mainObj
                            initialCartIndex++;
                            updareRowNumbers();
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
                if (index >= 1) {
                    $("#cart-row-" + index).remove();
                    updareRowNumbers();
                    getBulkGradndTotal();
                }
            });

            $(document).on("click", ".duplicate-product-row", function() {
                let index = parseInt($(this).data("index"));
                var trElement = $("#cart-row-" + index);

                var cloneTrNew = trElement.clone(true, false);
                cloneTrNew.attr("id", "cart-row-" + initialCartIndex);
                cloneTrNew.attr("data-index", initialCartIndex);
                cloneTrNew.data("index", initialCartIndex);
                cloneTrNew.find("[data-index]").attr("data-index", initialCartIndex);

                //Selecting elements
                var selects = trElement.find("select");
                $(selects).each(function(i) {
                    var select = this;
                    cloneTrNew.find("select").eq(i).val($(select).val());
                });

                cloneTrNew.insertAfter(trElement);

                mainObj[initialCartIndex] = mainObj[index];

                initialCartIndex++;
                updareRowNumbers();
                getBulkGradndTotal();

            });

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
            addNewBulkRow();

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
                        parentElement.find(".wand_length option").prop("selected", false);
                        parentElement.find(".wand_ctrl option").prop("selected", false);
                        parentElement.find(".chain_color option").prop("selected", false);
                        parentElement.find(".chain_ctrl option").prop("selected", false);
                        parentElement.find(".cord_ctrl option").prop("selected", false);
                        parentElement.find(".cord_color option").prop("selected", false);
                        parentElement.find(".manual_sel option").prop("selected", false);
                        break;
                    case 'manual':
                        parentElement.find('.motor_pos, .motor_type, .motor_cntrl, .smart_opts, .shad_wand_len, .shad_wand_side, .channel_guideline').hide();
                        parentElement.find('.manual_sel').show();
                        parentElement.find(".motor_type option").prop("selected", false);
                        parentElement.find(".somfy_list option").prop("selected", false);
                        parentElement.find(".motor_cntrl option").prop("selected", false);
                        parentElement.find(".motor_pos option").prop("selected", false);
                        parentElement.find(".shad_wand_len option").prop("selected", false);
                        parentElement.find(".shad_wand_side option").prop("selected", false);
                        parentElement.find(".smart_radios option").prop("selected", false);
                        break;
                    default:
                        parentElement.find('.manual_sel, .chain_color_box, .cord_color_box, .chain_ctrl, .cord_ctrl').hide();
                        parentElement.find('.motor_pos, .motor_type, .motor_cntrl, .smart_opts, .shad_wand_len, .shad_wand_side, .channel_guideline').hide();

                }
            });

            $(document).on("change", ".fabric-min-max-width-changes", function() {
                var parentElement = getParentTableRow($(this));

                let fabricMinWidth = parentElement.find(".fabric option:selected").data("fabric-min-width");
                let fabricMaxWidth = parentElement.find(".fabric option:selected").data("fabric-max-width");

                let selectedWidth = parentElement.find(".width").val();

                if (selectedWidth < fabricMinWidth && fabricMinWidth > 0) {
                    alert("Fabric min width required is " + fabricMinWidth);
                }
                if (selectedWidth > fabricMaxWidth && fabricMaxWidth > 0) {
                    alert("Fabric max width required is " + fabricMaxWidth);
                }

            });

            //Product Change
            $(document).on("change", ".product_list", function() {
                window.$this = $(this);
                let product_id = parseInt($(this).val());
                let parentElement = getParentTableRow($(this));
                let indexNumber = parseInt(parentElement.data("index"));
                console.log(indexNumber);
                if (product_id && product_id > 0 && indexNumber && indexNumber > 0) {

                    $(".loader-service").removeClass('makeItHidden');
                    var url = `{{ route('seller.products.bulknewrow') }}`;
                    var token = '{{ csrf_token() }}';
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {
                            '_token': token,
                            'rowIndex': indexNumber,
                            'productId': product_id
                        },
                        success: function(response) {
                            if (response !== 'error') {
                                parentElement.replaceWith(response.html);
                                mainObj[indexNumber] = response.price_arr;
                                updareRowNumbers();
                                getBulkGradndTotal();
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
            $(document).on('change', '.quantity', function() {
                var val = parseInt($(this).find('option:selected').val()) ? parseInt($(this).find('option:selected').val()) : 0;
                var parentElement = getParentTableRow($(this));
                if (val > 1) {
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


            // Mount
            $(document).on('change', '.mount', function() {
                var parentElement = getParentTableRow($(this));
                parentElement.find('.mount_price').val($(this).find('option:selected').val());
                parentElement.find('.mount_type').val($(this).find('option:selected').data("text"));
            });

            // Cassette Color
            $(document).on('change', '.cassette_type', function(e) {
                var parentElement = getParentTableRow($(this));
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (parentElement.find('.cassette_type option:selected').text() == "Open Roller") {
                    parentElement.find('.cassette_color').find('option').remove();
                    parentElement.find('.cassette_color').append(`
                        <option value="default">Default</option>
                    `);
                    return;
                }
                $(".loader-service").removeClass('makeItHidden');
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

            $(document).on("change", ".bottom_rail", function() {
                var parentElement = getParentTableRow($(this));
                let val = $(this).val();
                if (val == "") {
                    parentElement.find(".bottom_rail_color").html("");
                }
                if (val == "Default") {
                    parentElement.find(".bottom_rail_color").html(`
                    <option value="default">Default</option><option value="white">White</option><option value="ivory">Ivory</option><option value="grey">Grey</option><option value="black">Black</option>
                `);
                }
                if (val == "Hem Bar Wrapped" || val == "Sealed Wrapped") {
                    parentElement.find(".bottom_rail_color").html(`
                    <option value="default">Default</option>
                `);
                }
                getBulkGradndTotal();

            })

            function getBulkGradndTotal() {
                var rows = $("#bulk-cart-rows tr.cart-row");
                var bulkTotal = 0;
                rows.each(function() {
                    var singleRowPrice = singleRowTotal($(this));
                    if (singleRowPrice && singleRowPrice.grand_total > 0) {
                        bulkTotal += singleRowPrice.grand_total;
                    }
                });

                if (bulkTotal != NaN || bulkTotal != null) {
                    $("#grandtotal").text(bulkTotal.toFixed(2));
                }
            }

            function singleRowTotal(element) {
                var parentElement = getParentTableRow(element);
                let dataIndexOfRow = parentElement.data("index");
                let obj = mainObj[dataIndexOfRow];

                var qty = parentElement.find('.quantity').val() != "" ? parseInt(parentElement.find('.quantity').val()) : 0;
                var width_calc = parentElement.find('.width').find(":selected").data('price');
                var width_calc_val = parseInt(parentElement.find('.width').find(":selected").val());
                var width_decimal_calc = parseFloat(parentElement.find('.wid_decimal').find(":selected").val());
                var length_calc = parentElement.find('.length').find(":selected").data('price');
                var length_calc_val = parseInt(parentElement.find('.length').find(":selected").val());
                var length_decimal_calc = parseFloat(parentElement.find('.len_decimal').find(":selected").val());
                var wrap_expose = parentElement.find('.wrap_expose').find(":selected").val();
                var cassette_price = parseFloat(parentElement.find('.cassette_price').text()) ?? 0;
                var bottom_rail_price = parseFloat(parentElement.find('.bottom_rail option:selected').data("price")) ?? 0;
                if (!bottom_rail_price) {
                    bottom_rail_price = 0;
                }
                var wrap_price = parseFloat(parentElement.find('.wrap_price').text()) ?? 0;
                var cassette_type = parentElement.find('.cassette_type').find(":selected").val();
                var controltype = parentElement.find('.controltype').find(":selected").val();
                var motor_type_price = parseInt(parentElement.find('.motor_type').find(":selected").val()) ? parseInt(parentElement.find('.motor_type').find(":selected").val()) : 0;
                var motor_cntrl_price = parseInt(parentElement.find('.motor_cntrl').find(":selected").val()) ? parseInt(parentElement.find('.motor_cntrl').find(":selected").val()) : 0; // Channel
                var plugin_charger_price = parseInt(parentElement.find('.plugin_charger').find(":selected").val() ?? 0);
                var solar_panel_price = parseInt(parentElement.find('.solar_panel').find(":selected").val() ?? 0);
                var shade_smart_hub_price = parseInt(parentElement.find('.shade_smart_hub').find(":selected").val() ?? 0);
                var shade_smart_transformers_price = parseInt(parentElement.find('.shade_smart_transformers').find(":selected").val() ?? 0);
                var brackets_opt_price = parentElement.find('.brackets_opt option:selected').val() ? parentElement.find('.brackets_opt option:selected').val() : 0;
                var spring_assist = parentElement.find('.spring_chk option:selected').val() ? parentElement.find('.spring_chk option:selected').val() : 0;
                var mount_price = parseFloat(parentElement.find(".mount_price").val()) ? parentElement.find(".mount_price").val() : 0;
                var motor_arr = parseFloat(parentElement.find(".ctype_arrprice").val()) ? parseFloat(parentElement.find(".ctype_arrprice").val()) : 0;
                brackets_opt_price = parseFloat(brackets_opt_price) ? parseFloat(brackets_opt_price) : 0;
                spring_assist = parseFloat(spring_assist) ? parseFloat(spring_assist) : 0;

                if (!width_calc || !length_calc || !qty) {
                    return {
                        suggested_price: 0,
                        grand_total: 0
                    }
                }

                //Start
                var findObjVal = calculateShadePriceFromSize(obj, width_calc, length_calc, width_decimal_calc, length_decimal_calc, width_calc_val, length_calc_val);

                //Ends

                var suggestedPrice = 0;
                var grandTotal = 0;
                var commonPrice = 0;
                var priceArr = findObjVal;
                if (priceArr) {
                    Object.keys(priceArr).forEach((i) => {
                        return priceArr[i] = parseFloat(priceArr[i]);
                    });
                }
                if (!cassette_price) {
                    cassette_price = 0;
                }
                if (!wrap_price) {
                    wrap_price = 0;
                }
                if (!bottom_rail_price) {
                    bottom_rail_price = 0;
                }


                if (priceArr) {
                    var discount = parseFloat(parentElement.find('.disc_percent').val());
                    if (!discount) {
                        discount = 0;
                    }
                    var disc_percent = discount / 100;
                    var disc_shade_price = qty * (priceArr.price - (priceArr.price * disc_percent));
                    var disc_cassette_price = qty * (cassette_price - (cassette_price * disc_percent));
                    var disc_wrap_price = qty * (wrap_price - (wrap_price * disc_percent));
                    var disc_bottom_rail_price = qty * (bottom_rail_price - (bottom_rail_price * disc_percent));

                    grandTotal = disc_shade_price + disc_bottom_rail_price + disc_cassette_price + disc_wrap_price;
                    suggestedPrice = (priceArr.price + cassette_price + wrap_price + bottom_rail_price) * qty;
                }

                commonPrice += motor_arr * qty;
                commonPrice += mount_price * qty;
                // Motorization
                if (controltype === 'motor' && motor_type_price > 0) {
                    commonPrice += parseFloat(motor_type_price) * qty;

                }
                if (controltype === 'motor' && motor_cntrl_price > 0) {
                    commonPrice += parseFloat(motor_cntrl_price) * qty;
                }
                if (controltype === 'motor' && plugin_charger_price > 0) {
                    commonPrice += parseFloat(plugin_charger_price) * qty;
                }
                if (controltype === 'motor' && solar_panel_price > 0) {
                    commonPrice += parseFloat(solar_panel_price) * qty;
                }
                if (controltype === 'motor' && shade_smart_hub_price > 0) {
                    commonPrice += parseFloat(shade_smart_hub_price) * qty;
                }
                if (controltype === 'motor' && shade_smart_transformers_price > 0) {
                    commonPrice += parseFloat(shade_smart_transformers_price) * qty;
                }
                commonPrice += brackets_opt_price * qty;
                commonPrice += spring_assist * qty;

                grandTotal += commonPrice;
                suggestedPrice += commonPrice;

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


            $(document).on('change', '.get_fts_prices', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var parentElement = getParentTableRow($(this));

                var width = parentElement.find('.width option:selected').val() ? parentElement.find('.width option:selected').val() : -1;
                var fraction = parentElement.find('.wid_decimal option:selected').val() ? parentElement.find('.wid_decimal option:selected').val() : -1;

                var cassette_code = -1;
                if (parentElement.find('.cassette_type option:selected').val()) {
                    cassette_code = parentElement.find('.cassette_type option:selected').val();
                }
                if (parentElement.find('.cassette_type option:selected').val() == "Open Roller") {
                    var cassette_code = -1;
                }
                var wrap_code = -1;
                if (parentElement.find(".wrap_expose").length) {
                    if (parentElement.find('.wrap_expose option:selected').val() && parentElement.find('.wrap_expose option:selected').val() != "0") {
                        var wrap_code = parentElement.find('.wrap_expose option:selected').val();
                    }
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
                        parentElement.find('.cassette_price').text(result[0].cassette_price);
                        parentElement.find('.wrap_price').text(result[0].wrap_price);

                        getBulkGradndTotal();
                    }
                });
            });

            $(document).on('change', '.wm_price', function(e) {

                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var parentElement = getParentTableRow($(this));

                var width = parentElement.find('.width option:selected').val() ? parentElement.find('.width option:selected').val() : 0;
                var decimal = parentElement.find('.wid_decimal option:selected').val() ? parentElement.find('.wid_decimal option:selected').val() : 0;

                var max = parentElement.find(".wid_motor_max_field").val();
                var code = parentElement.find(".ct_widmotor_code_field").val();

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
                        parentElement.find('.ctype_arrprice').val(result);
                    }
                });
            });

            $(document).on("change", ".fabric", function() {
                let imgSrc = $(this).find("option:selected").data("img");
                let img = $(this).closest("#fabric-div-group").find("img");
                if (imgSrc) {
                    if (img && img.length > 0) {
                        img.attr("src", `/public/fabric/images/${imgSrc}`)
                        img.attr("class", "fabric-group-img")
                    } else {
                        $(this).closest("#fabric-div-group").append(`
                            <img class="fabric-group-img" src="/public/fabric/images/${imgSrc}" />
                        `)
                    }
                } else {
                    if (img && img.length > 0) {
                        img.remove();
                    }
                }
            });

            function getTotalOrderQuantity() {
                var rows = $("#bulk-cart-rows tr.cart-row");
                let total_quantity = 0;
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    var parentElement = getParentTableRow($(row));
                    var quantity = parentElement.find('.quantity').val() ? parentElement.find('.quantity').val() : '';
                    total_quantity += parseInt(quantity);
                }
                return total_quantity ? total_quantity : 0;
            }


            function addBulkToCart() {
                var rows = $("#bulk-cart-rows tr.cart-row");
                if (rows.length <= 0) {
                    alert("No item present to add into cart");
                    return false;
                }
                let to_add = true;
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    to_add = validateBeforeSave($(row));
                    if (!to_add) {
                        break;
                    }
                }
                if (to_add) {
                    if (confirm("Do you want to add " + getTotalOrderQuantity() + " products into cart")) {
                        for (let i = 0; i < rows.length; i++) {
                            const row = rows[i];
                            addToCart($(row));
                        }
                    } else {
                        to_add = false;
                    }
                }
                return to_add;
            }

            function validateBeforeSave(row) {
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
                    if (parentElement.find(".motor_type option:selected").val() == "" || parentElement.find(".motor_type option:selected").data("first") == "true") {
                        parentElement.find(".motor_type")[0].setCustomValidity("Choose Motor Type");
                        parentElement.find(".motor_type")[0].reportValidity();
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
                    parentElement.find(".cassette_type")[0].setCustomValidity("Choose Cassette Type");
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
                return true;
            }

            function addToCart(row) {
                var parentElement = getParentTableRow(row);

                let key = 0;
                if (localStorage.getItem('key') != null) {
                    key = parseInt(localStorage.getItem('key')) ? parseInt(localStorage.getItem('key')) : 0;
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
                var width_calc_val = parseInt(parentElement.find('.width').find(":selected").val());
                var width_decimal_calc = parseFloat(parentElement.find('.wid_decimal').find(":selected").val());
                var length_calc = parentElement.find('.length').find(":selected").data('price');
                var length_calc_val = parseInt(parentElement.find('.length').find(":selected").val());
                var length_decimal_calc = parseFloat(parentElement.find('.len_decimal').find(":selected").val());

                //Getting obj
                let dataIndexOfRow = parentElement.data("index");
                let obj = mainObj[dataIndexOfRow];

                var findObjVal = calculateShadePriceFromSize(obj, width_calc, length_calc, width_decimal_calc, length_decimal_calc, width_calc_val, length_calc_val);

                priceArr = findObjVal;
                if (priceArr) {
                    Object.keys(priceArr).forEach((i) => {
                        return priceArr[i] = parseFloat(priceArr[i]);
                    });
                }

                var priceObj = singleRowTotal(row);
                price = priceObj.grand_total;
                var suggested_price_prod = priceObj.suggested_price;
                var disc_percent = parentElement.find('.disc_percent').val() ? parentElement.find('.disc_percent').val() : '';
                var shade_price = priceArr.price;
                var cassette_type = parentElement.find('.cassette_type option:selected').val() ? parentElement.find('.cassette_type option:selected').val() : '';
                var cassette_color = parentElement.find('.cassette_color option:selected').text() ? parentElement.find('.cassette_color option:selected').text() : '';

                let total_bottom_rail_price = parseFloat(parentElement.find(".bottom_rail option:selected").data("price") ?? 0) ?? 0;
                var bottom_rail = parentElement.find(".bottom_rail option:selected").val();
                var bottom_rail_color = parentElement.find(".bottom_rail_color option:selected").val();

                var mount_price = parentElement.find('.mount option:selected').val() ? parentElement.find('.mount option:selected').val() : '';
                var mount_type = parentElement.find('.mount option:selected').data("text") ? parentElement.find('.mount option:selected').data("text") : '';
                var mount_pos = parentElement.find('.mount_pos option:selected').text() ? parentElement.find('.mount_pos option:selected').text() : '';
                var wrap_expose = parentElement.find('.wrap_expose option:selected').val() ? parentElement.find('.wrap_expose option:selected').val() : '';
                var brackets_opt = parentElement.find('.brackets_opt option:selected').val() != "" ? parentElement.find('.brackets_opt option:selected').text() : '';
                var brackets_opt_price = parentElement.find('.brackets_opt option:selected').val() ? parentElement.find('.brackets_opt option:selected').val() : 0;
                var stack = parentElement.find('.stack option:selected').text() ? parentElement.find('.stack option:selected').text() : '';
                var spring_assist = parentElement.find('.spring_chk option:selected').val() ? parentElement.find('.spring_chk option:selected').val() : 0;

                var cassette_price = parseFloat(parentElement.find('.cassette_price').text()) ?? 0;
                var wrap_price = parseFloat(parentElement.find('.wrap_price').text()) ?? 0;

                var control_type = parentElement.find('.controltype option:selected').val() ? parentElement.find('.controltype option:selected').val() : '';
                if (parentElement.find('.motor_type option:selected').val() != '' && parentElement.find('.motor_type option:selected').data('motor-price') != '') {
                    var motor_name = parentElement.find('.motor_type option:selected').text() ? parentElement.find('.motor_type option:selected').text() : '';
                } else {
                    var motor_name = '';
                }
                var motor_pos = parentElement.find('.motor_pos option:selected').val() ? parentElement.find('.motor_pos option:selected').val() : '';
                var motor_price = parentElement.find('.motor_type').find(":selected").val() ? parentElement.find('.motor_type').find(":selected").val() : 0;
                if (parentElement.find('.motor_cntrl option:selected').val() != '') {
                    var channel_name = parentElement.find('.motor_cntrl option:selected').text() ? parentElement.find('.motor_cntrl option:selected').text() : '';
                } else {
                    var channel_name = '';
                }
                var channel_price = parentElement.find('.motor_cntrl').find(":selected").val() ? parentElement.find('.motor_cntrl').find(":selected").val() : 0;
                var motor_arr_price = parentElement.find('.ctype_arrprice').val() ? parentElement.find('.ctype_arrprice').val() : 0;
                if (parentElement.find('.manual_sel option:selected').val() != '') {
                    var chain_cord = parentElement.find('.manual_sel option:selected').text() ? parentElement.find('.manual_sel option:selected').text() : '';
                } else {
                    var chain_cord = '';
                }
                if (parentElement.find('.chain_ctrl option:selected').val() != '') {
                    var chain_ctrl = parentElement.find('.chain_ctrl option:selected').text() ? parentElement.find('.chain_ctrl option:selected').text() : '';
                    var chain_color = parentElement.find('.chain_color option:selected').val() ? parentElement.find('.chain_color option:selected').val() : '';
                } else {
                    var chain_ctrl = '';
                    var chain_color = '';
                }
                if (parentElement.find('.cord_ctrl option:selected').val() != '') {
                    var cord_ctrl = parentElement.find('.cord_ctrl option:selected').text() ? parentElement.find('.cord_ctrl option:selected').text() : '';
                    var cord_color = parentElement.find('.cord_color option:selected').val() ? parentElement.find('.cord_color option:selected').val() : '';
                } else {
                    var cord_ctrl = '';
                    var cord_color = '';
                }

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
                    "bottom_rail_price": total_bottom_rail_price,
                    "bottom_rail": bottom_rail,
                    "bottom_rail_color": bottom_rail_color,
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
                    "suggested_price": parseFloat(suggested_price_prod).toFixed(2),
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

        function updareRowNumbers() {
            var rows = $("#bulk-cart-rows tr.cart-row");
            for (let i = 0; i < rows.length; i++) {
                const element = rows[i];
                $(element).find(".product-row-sl").text(i + 1);
            }
        }


        function calculateShadePriceFromSize(obj, width_calc, length_calc, width_decimal_calc, length_decimal_calc, width_calc_val, length_calc_val) {
            var findObjVal;

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

            return findObjVal;
        }
    </script>
@endsection
