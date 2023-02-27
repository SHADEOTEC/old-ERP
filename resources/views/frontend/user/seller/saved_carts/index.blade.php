@extends('frontend.layouts.user_panel')
@section('mystyles')
    <link rel="stylesheet" href="{{ static_asset('assets/css/cart.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-1 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">All Saved Carts</h1>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <h4>{{ $errors->first() }}</h4>
    @endif
    <div class="container-fluid" id="cart-table-body">
        <table class="table" id="main-saved-cart-table">
            <thead>
                <tr>
                    <th>Project# (Tag)</th>
                    <th>Total Suggested Price</th>
                    <th>Grand Total</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" style="overflow-y: scroll" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="card position-relative">
                    <span role="button" class="position-absolute right-0 px-2 py-1" style="font-size: 1.2rem" data-dismiss="modal" aria-label="Close" title="Close">
                        <i class="la la-close"></i>
                    </span>
                    <div class="table-responsive">
                        <table class="table-borderless table-shopping-cart table" id="cart_table">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col" style="width:40%">Product</th>
                                    <th scope="col" style="width:130px">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" style="overflow-y: scroll" id="modalEmailSys" tabindex="-1" role="dialog" aria-labelledby="modalEmailSysTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card position-relative mb-0 pb-3">
                    <span role="button" class="position-absolute right-0 px-2 py-1" style="font-size: 1.2rem" data-dismiss="modal" aria-label="Close" title="Close">
                        <i class="la la-close"></i>
                    </span>
                    <h3 class="h3 mt-2 mb-2 text-center">Email Quote Invoice</h3>
                    <div class="form-group row mt-2 px-5">
                        <div class="col-12">
                            <label for="" class="label">Choose Destination</label>
                        </div>
                        <div class="col-12">
                            <select id="email-user-type" class="form-control form-control-sm">
                                <option value="0"> Email to Self </option>
                                <option value="1"> Email to Customer </option>
                            </select>
                        </div>
                    </div>
                    <div id="customer-email-info">

                    </div>
                    <div id="customer-email-price-info" class="hide mt-2 px-5">

                    </div>


                    <div class="d-flex justify-content-center mt-4">
                        <button class="btn btn-soft-primary" id="send-email-btn">Send Email</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        var modelHtmls = [];
        $(document).ready(function() {
            let savedCarts = localStorage.getItem("savedCarts");
            if (savedCarts) {
                savedCarts = JSON.parse(savedCarts);
                let html = "";
                for (let i = 0; i < Object.keys(savedCarts).length; i++) {
                    const cart = JSON.parse(savedCarts[Object.keys(savedCarts)[i]]) ?? [];
                    let cartHTML = "";
                    let cartIdentifier = Object.keys(savedCarts)[i];
                    cartIdentifier = cartIdentifier.split("-");
                    let date = (new Date(parseInt(cartIdentifier.at(-1)))).toDateString();
                    cartIdentifier = cartIdentifier.filter((v, i) => i != cartIdentifier.length - 1).join("-");
                    let [grand, dis] = get_grand_total(cart);

                    let modelHTML = "";
                    if (cart.length > 0) {
                        // using forEach, calculate the total price of each item within our cart array
                        cart.forEach((element, j) => {
                            var figCaptionDetails = '';
                            figCaptionDetails += '<ul class="text-muted small product-details-ul">';
                            figCaptionDetails += '<li><strong>' + element.prod_name + '</strong></li>';
                            figCaptionDetails += '<li><strong>' + element.order_number + '</strong></li>';
                            figCaptionDetails += '<li><strong>' + element.dealer_name + '</strong></li>';
                            figCaptionDetails += '<li>Room Type: <strong>' + element.room_type + '</strong></li>';
                            figCaptionDetails += '<li>Fabric: <strong>' + element.fabric + '</strong></li>';
                            figCaptionDetails += '<li>Mount Type: <strong>' + element.mount_type + '</strong></li>';
                            figCaptionDetails += '<li>Control Type: <strong>' + element.control_type + '</strong></li>';
                            figCaptionDetails += '<li>Cassette Type: <strong>' + element.cassette_type + '</strong></li>';
                            figCaptionDetails += '<li>Cassette Color: <strong>' + element.cassette_color + '</strong></li>';
                            if (element.bottom_rail) {
                                figCaptionDetails += '<li>Bottom Rail: <strong>' + element.bottom_rail + '</strong></li>';
                                figCaptionDetails += '<li>Bottom Rail Color: <strong>' + element.bottom_rail_color + '</strong></li>';
                            }
                            figCaptionDetails += '<li>Channel Name: <strong>' + element.channel_name + '</strong></li>';
                            figCaptionDetails += '<li>Wrap Expose: <strong>' + element.wrap_expose + '</strong></li>';
                            figCaptionDetails += '<li>Size: <strong>' + element.width + '(' + element.wid_decimal + ') x ' + element.length + '(' + element.len_decimal + ')</strong></li>';
                            figCaptionDetails += '</ul>';

                            modelHTML += '<tr id="' + element.order_number + '"><td><figure class="itemside align-items-center"><div class="aside"><img src="' + element.main_img +
                                '" class="" width="100px" height="100px"></div><figcaption class="info"><!--<a href="javascript:void(0);" class="text-muted small" data-abc="true">' + element.project_tag + '</a>-->' +
                                figCaptionDetails +
                                '</figcaption></figure></td><td style="width: 130px;">' +
                                '<span id="qty">' + element.quantity + '</span>' +
                                '</td><td><div class="price-wrap"> <var class="price">$<span id="tprice">' + element.price +
                                '</span></var><var class="">$<span id="tprice_single">' + (element.price * element.quantity).toFixed(2) +
                                '</span></var></td> ';
                            modelHTML += `
                                    <td> 
                                        <button onclick="editCartItem('${Object.keys(savedCarts)[i]}', ${j})" class="btn btn-soft-primary"> <i class="la la-edit"></i> </button> 
                                        <button onclick="deleteCartItem('${Object.keys(savedCarts)[i]}', ${j})" class="btn btn-soft-danger"> <i class="la la-trash"></i> </button> 
                                    </td>
                            `;
                            modelHTML += "</tr>";
                        });
                    }

                    modelHtmls[i] = modelHTML;
                    html += `
                        <tr>
                            <td>${cartIdentifier}</td>
                            <td>  ${dis} </td>
                            <td>${grand}</td>
                            <td>${date}</td>
                            <td> 
                                <button onclick="showModel(${i})" class="btn btn-soft-primary px-2 py-1" style="font-size: 18px;"> <i class="las la-eye"></i> </button>

                                <button class="cart-rollback btn btn-soft-primary px-2 py-1" style="font-size: 18px;" data-id="${Object.keys(savedCarts)[i]}">
                                    <i class="la la-cart-plus"></i>
                                </button>
                                <button class="cart-remove btn btn-soft-primary px-2 py-1" style="font-size: 18px;" data-id="${Object.keys(savedCarts)[i]}">
                                    <i class="la la-trash-alt"></i>
                                </button>
                                <button title="Email" onclick="emailSys(this)" style="font-size: 18px;" class="btn btn-outline-secondary px-2 py-1" data-id="${Object.keys(savedCarts)[i]}">
                                    <i class="las la-envelope-open-text"></i>
                                </button>
                            </td>
                        </tr>   
                    `;

                }
                $("#main-saved-cart-table tbody").html(html);
            }
            let table = new DataTable('#main-saved-cart-table', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1]
                }],
            });

        });

        function get_grand_total(total_cart) {
            let grand = 0;
            var discount_xauzit = 0;
            let cpn = 0;

            total_cart.forEach(element => {
                if (element.parts == 0) {
                    grand = grand + parseFloat(element.total);
                    discount_xauzit = discount_xauzit + parseFloat(element.suggested_price);
                } else {
                    var total = element.quantity * parseFloat(element.price);
                    discount_xauzit = discount_xauzit + (element.price * element.quantity);
                    grand = grand + total;
                }
            });
            grand = grand.toFixed(2);

            return [grand, discount_xauzit];

        }

        $(document).on("click", ".cart-rollback", function() {
            if (confirm("This will clear your current cart") == true) {
                let id = $(this).attr("data-id");
                let savedCarts = localStorage.getItem("savedCarts") ?? "{}";
                savedCarts = JSON.parse(savedCarts);

                let clickedCart = savedCarts[id];
                if (clickedCart) {
                    localStorage.setItem("cart", clickedCart);
                    delete savedCarts[id];
                    localStorage.setItem("savedCarts", JSON.stringify(savedCarts));
                    window.location.href = `{{ route('cart.seller.index') }}`;
                }
            }
        });

        $(document).on("click", ".cart-remove", function() {
            if (confirm("This will remove selected cart") == true) {
                let id = $(this).attr("data-id");
                let savedCarts = localStorage.getItem("savedCarts") ?? "{}";
                savedCarts = JSON.parse(savedCarts);

                delete savedCarts[id];
                localStorage.setItem("savedCarts", JSON.stringify(savedCarts));
                window.location.reload();
            }
        })

        function showModel(i) {
            $("#exampleModalLong .modal-content tbody").html(modelHtmls[i]);
            $("#exampleModalLong").modal('show');
        }

        function editCartItem(cartIndex, itemIndex) {
            let savedCarts = localStorage.getItem("savedCarts") ?? "{}";
            savedCarts = JSON.parse(savedCarts);
            let cart = JSON.parse(savedCarts[cartIndex]);
            if (cart) {
                let element = cart[itemIndex];
                if (element) {
                    let product = {
                        "cart_id": element.cart_id,
                        "prod_id": element.prod_id,
                        "prod_name": element.prod_name,
                        "dealer_name": element.dealer_name,
                        "order_number": element.order_number,

                        "disc_percent": element.disc_percent,
                        "shade_price": element.shade_price,
                        "mount_price": element.mount_price,
                        "mount_type": element.mount_type,
                        "mount_pos": element.mount_pos,
                        "wrap_expose": element.wrap_expose,
                        "wrap_price": element.wrap_price,
                        "cassette_price": element.cassette_price,
                        "cassette_type": element.cassette_type,
                        "cassette_color": element.cassette_color,
                        "bottom_rail_price": element.bottom_rail_price,
                        "bottom_rail": element.bottom_rail,
                        "bottom_rail_color": element.bottom_rail_color,

                        "brackets_opt": element.brackets_opt,
                        "brackets_opt_price": element.brackets_opt_price,
                        "spring_assist_price": element.spring_assist_price,

                        "cust_side_mark": element.cust_side_mark,

                        "room_type": element.room_type,
                        "window_desc": element.window_desc,
                        "quantity": element.quantity,
                        "width": element.width,
                        "wid_decimal": element.wid_decimal,
                        "length": element.length,
                        "len_decimal": element.len_decimal,
                        "fabric": element.fabric,
                        "stack": element.stack,

                        "control_type": element.control_type,
                        "motor_name": element.motor_name,
                        "motor_pos": element.motor_pos,
                        "motor_price": element.motor_price,
                        "motor_arr_price": element.motor_arr_price,
                        "channel_name": element.channel_name,
                        "channel_price": element.channel_price,

                        "plugin_price": element.plugin_price,
                        "solar_price": element.solar_price,
                        "hub_price": element.hub_price,
                        "transformer_price": element.transformer_price,

                        "chain_cord": element.chain_cord,
                        "chain_ctrl": element.chain_ctrl,
                        "chain_color": element.chain_color,
                        "cord_ctrl": element.cord_ctrl,
                        "cord_color": element.cord_color,

                        "brackets": element.brackets,
                        "sp_instructions": element.sp_instructions,
                        "main_img": element.img_url,
                        "parts": element.parts,
                        "price": element.price,
                        "suggested_price": element.suggested_price,
                        "total": element.total,
                    }

                    let productString = JSON.stringify(product).replaceAll("'", "&singlequote");


                    $(`<form action="{{ route('seller.cart.edit') }}" method="POST">
                @csrf
                <input type="hidden" name="product" value='${productString}' />
                <input type="hidden" name="cart_type" value="savedCarts" />
                <input type="hidden" name="cartIndex" value="${cartIndex}" />
                <input type="hidden" name="itemIndex" value="${itemIndex}" />
                </form>`).appendTo('body').submit();

                }
            }

        }

        function emailSys(btn) {
            $("#modalEmailSys").modal("show");
            let cartKey = $(btn).data("id");

            let cart = JSON.parse(localStorage.getItem("savedCarts"))[cartKey];
            cart = JSON.parse(cart);

            let cartFormBodyTableInnerHtml = "";
            let quantity = 0;
            let grand_total = 0;
            let profit_grand_total = 0;
            for (let i = 0; i < cart.length; i++) {
                const product = cart[i];
                cartFormBodyTableInnerHtml += `
                    <tr class="to-cal-grand-total-values-rows">
                        <td> ${product.prod_name} </td>    
                        <td> ${product.quantity} </td>    
                        <td class="original_price_product_ki"> ${product.total} </td>    
                        <td> <input style="width: 80px;" class="profit_perecent_ki" type="number" value="${0}" /> </td>
                        <td> <input style="width: 80px;" class="profit_product_price_ki" type="number" value="${product.total}" />  </td>    
                    </tr>
                `;
                quantity += parseInt(product.quantity);
                grand_total += parseFloat(product.total);
                profit_grand_total += parseFloat(product.total);
            }
            let cartFormHtml = `
                <div>Price Margins</div>
                <table class="table table-striped" data-key="${cartKey}" id="price-margins-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Profit%</th>
                            <th>Profit Price</th>
                        </tr>
                    </thead>   
                    <tbody>
                        ${cartFormBodyTableInnerHtml}
                        <tr>
                            <th>Grand Total</th>
                            <th>${quantity}</th>
                            <th class="grand_total_price">${grand_total}</th>
                            <th class="grand_profit_percent">0</th>
                            <th class="grand_total_profit_price">${profit_grand_total}</th>
                        </tr>
                    </tbody> 
                </table>
            `;
            $("#customer-email-price-info").html(cartFormHtml);

        }

        function deleteCartItem(cartIndex, itemIndex) {
            if (confirm("Do you want to delete quote product")) {
                let savedCarts = localStorage.getItem("savedCarts") ?? "{}";
                savedCarts = JSON.parse(savedCarts);

                let cart = JSON.parse(savedCarts[cartIndex]);
                if (cart && cart.length > itemIndex) {
                    if (cart.length > 1) {
                        cart = cart.filter((_, i) => i != itemIndex);
                        savedCarts[cartIndex] = JSON.stringify(cart);
                        localStorage.setItem("savedCarts", JSON.stringify(savedCarts));
                    } else {
                        delete savedCarts[cartIndex];
                        localStorage.setItem("savedCarts", JSON.stringify(savedCarts));
                    }
                    window.location.reload();
                }
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#email-user-type").on("change", function() {
                let type = parseInt($(this).val());
                let parentElement = $("#customer-email-info");
                if (type == 1) {
                    //Email to customer
                    parentElement.append(
                        `
                    <div class="form-group row mt-2 px-5">
                        <div class="col-md-6 d-flex flex-column">
                            <div>
                                <label for="" class="label">Customer Name</label>
                            </div>
                            <div >
                                <input class="form-control form-control-sm" type="text" id="email_customer_name" />
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column">
                            <div>
                                <label for="" class="label">Customer Email</label>
                            </div>
                            <div >
                                <input class="form-control form-control-sm" type="email" id="email_customer_email" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-2 px-5">
                        <div class="col-12">
                            <label for="" class="label">Message for Customer</label>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control form-control-sm" id="email_customer_message" ></textarea>
                        </div>
                    </div>
                    `
                    );
                    $("#customer-email-price-info").removeClass("hide");

                } else {
                    parentElement.html("");
                    $("#customer-email-price-info").addClass("hide");
                }
            });

            $(document).on("keyup", ".profit_perecent_ki", function() {
                let parentTrElement = $(this).parent().parent();
                let profit_precent = $(this).val();
                let profit_price_input = parentTrElement.find(".profit_product_price_ki");
                let original_price = parseFloat(parentTrElement.find(".original_price_product_ki").text());
                if (profit_precent && profit_precent > 0) {

                    profit_price_input.val(((original_price / 100 * profit_precent) + original_price).toFixed(2));
                } else {
                    profit_price_input.val(original_price);

                }
                recalculateTotalsForProfit();

            });
            $(document).on("keyup", ".profit_product_price_ki", function() {
                let parentTrElement = $(this).parent().parent();
                let profit_value = $(this).val();
                let profit_percent_input = parentTrElement.find(".profit_perecent_ki");
                let original_price = parseFloat(parentTrElement.find(".original_price_product_ki").text());
                if (profit_value && profit_value > 0) {
                    let profit_percent = ((profit_value - original_price) * 100) / original_price;
                    profit_percent_input.val(profit_percent.toFixed(2));
                } else {
                    profit_percent_input.val(0);
                    $(this).val(original_price)
                }
                recalculateTotalsForProfit();
            });

        });

        function recalculateTotalsForProfit(cart = null) {
            let allTrElements = $(".to-cal-grand-total-values-rows");
            let grandTotalPrice = 0;
            let grandTotalProfitPrice = 0;
            for (let i = 0; i < allTrElements.length; i++) {
                const parentTrElement = $(allTrElements[i]);
                let original_price = parseFloat(parentTrElement.find(".original_price_product_ki").text());
                let profit_percent_input = parseFloat(parentTrElement.find(".profit_perecent_ki").val());
                let profit_price = parseFloat(parentTrElement.find(".profit_product_price_ki").val());
                
                if (cart) {
                    let suggested_price = parseFloat(cart[i].suggested_price);
                    let new_suggested_price = (suggested_price / 100 * profit_percent_input) + suggested_price;
                    cart[i].total = profit_price;
                    cart[i].suggested_price = new_suggested_price;
                    cart[i].price = profit_price / cart[i].quantity;
                }
                grandTotalPrice += original_price;
                grandTotalProfitPrice += profit_price;
            }

            $(".grand_total_price").text(grandTotalPrice.toFixed(2));
            $(".grand_total_profit_price").text(grandTotalProfitPrice.toFixed(2));

            $(".grand_profit_percent").text(((grandTotalProfitPrice - grandTotalPrice) * 100 / grandTotalPrice).toFixed(2));
            return cart;
        }

        $("#send-email-btn").on("click", function() {
            let type = parseInt($("#email-user-type").val());
            let cartKey = $("#price-margins-table").data("key");
            let cartIdentifier = cartKey
            cartIdentifier = cartIdentifier.split("-");
            let date = (new Date(parseInt(cartIdentifier.at(-1)))).toDateString();
            cartIdentifier = cartIdentifier.filter((v, i) => i != cartIdentifier.length - 1).join("-");

            let cart = JSON.parse(localStorage.getItem("savedCarts"))[cartKey];
            cart = JSON.parse(cart);

            if (type == 0) {
                if (confirm("Do you want to send quote invoice to yourself?")) {
                    let data = {
                        userType: 0,
                        tag: cartIdentifier,
                        date: date,
                        cart: cart,
                        grandTotal: calculateGrandTotal(cart),
                        name: `{{ Auth::user()->name }}`,
                        email: `{{ Auth::user()->email }}`,
                        message: "",
                    }
                    sendEmailToUser(data);
                }
            } else if (type == 1) {

                if ($("#email_customer_name").val() == "") {
                    alert("Customer name is required")
                    return;
                }
                if ($("#email_customer_email").val() == "") {
                    alert("Customer email is required")
                    return;
                }
                cart = recalculateTotalsForProfit(cart);

                if (confirm("Do you want to send email to customer")) {

                    let data = {
                        userType: 1,
                        tag: cartIdentifier,
                        date: date,
                        cart: cart,
                        grandTotal: calculateGrandTotal(cart),
                        name: $("#email_customer_name").val(),
                        email: $("#email_customer_email").val(),
                        message: $("#email_customer_message").val(),
                    }
                    sendEmailToUser(data);
                }

            }

        });

        function sendEmailToUser(data) {
            let stringData = JSON.stringify(data).replaceAll("'", "&singlequote");

            $(`
                <form method="POST" action="{{ route('saved_carts.seller.send_email') }}" >
                    @csrf
                    <input type="hidden" name="data" value='${stringData}' />
                </form>
            `).appendTo('body').submit();

        }

        function calculateGrandTotal(cart) {
            let val = 0;
            for (let i = 0; i < cart.length; i++) {
                const element = cart[i];
                val += parseFloat(element.total) ? parseFloat(element.total) : 0;
            }
            return val;
        }
    </script>
@endsection
