@extends('frontend.layouts.user_panel')
@section('mystyles')
    <link rel="stylesheet" href="{{ static_asset('assets/css/cart.css') }}">
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
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let savedCarts = localStorage.getItem("savedCarts");
            if (savedCarts) {
                savedCarts = JSON.parse(savedCarts);
                let html = "";
                for (let i = 0; i < Object.keys(savedCarts).length; i++) {
                    const cart = JSON.parse(savedCarts[Object.keys(savedCarts)[i]]) ?? [];
                    let cartHTML = "";
                    if (cart.length) {
                        // using forEach, calculate the total price of each item within our cart array
                        cart.forEach(element => {
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
                            figCaptionDetails += '<li>Channel Name: <strong>' + element.channel_name + '</strong></li>';
                            figCaptionDetails += '<li>Wrap Expose: <strong>' + element.wrap_expose + '</strong></li>';
                            figCaptionDetails += '<li>Size: <strong>' + element.width + '(' + element.wid_decimal + ') x ' + element.length + '(' + element.len_decimal + ')</strong></li>';
                            figCaptionDetails += '</ul>';

                            cartHTML += '<tr id="' + element.order_number + '"><td><figure class="itemside align-items-center"><div class="aside"><img src="' + element.main_img +
                                '" class="" width="100px" height="100px"></div><figcaption class="info"><!--<a href="javascript:void(0);" class="text-muted small" data-abc="true">' + element.project_tag + '</a>-->' +
                                figCaptionDetails +
                                '</figcaption></figure></td><td style="width: 130px;">' +
                                '<span id="qty">' + element.quantity + '</span>' +
                                '</td><td><div class="price-wrap"> <var class="price">$<span id="tprice">' + element.price +
                                '</span></var><var class="">$<span id="tprice_single">' + (element.price * element.quantity).toFixed(2) +
                                '</span></var></td> </tr>';
                        });
                    }
                    let cartIdentifier = Object.keys(savedCarts)[i];
                    cartIdentifier = cartIdentifier.split("-");
                    cartIdentifier = cartIdentifier.filter((v, i) => i != cartIdentifier.length - 1).join("-");

                    html += `
                        <div class="row">
                            <div class="col-12">
                                <h4> <b>Cart#</b> ${cartIdentifier} </h4>    
                            </div>
                            <aside class="col-lg-9">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table-borderless table-shopping-cart table" id="cart_table">
                                            <thead class="text-muted">
                                                <tr class="small text-uppercase">
                                                    <th scope="col" style="width:40%">Product</th>
                                                    <th scope="col" style="width:130px">Quantity</th>
                                                    <th scope="col" width="200">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${cartHTML}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-secondary cart-remove" data-id="${Object.keys(savedCarts)[i]}">Remove</button>
                                        <button class="btn btn-primary cart-rollback" data-id="${Object.keys(savedCarts)[i]}">Rollback to Cart</button>
                                    </div>
                                </div>
                            </aside>
                            <aside class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <dl class="dlist-align">
                                            <dt>Total without Discounted:</dt>
                                            <dd class="text-dark b ml-3 text-right"><strike>$ <span id="discount_xauzit${i}"></span></strike></dd>
                                        </dl>
                                        <dl class="dlist-align">
                                            <dt>Grand Total:</dt>
                                            <dd class="text-dark b ml-3 text-right">$ <span id="grandtotal${i}"></span></dd>
                                        </dl>
                                    </div>
                                </div>
                            </aside>
                        </div>`;

                }
                $("#cart-table-body").html(html);
                cal_total();
            }
        });

        function cal_total() {

            let savedCarts = localStorage.getItem("savedCarts");
            if (savedCarts) {
                savedCarts = JSON.parse(savedCarts);
                for (let i = 0; i < Object.keys(savedCarts).length; i++) {
                    const total_cart = JSON.parse(savedCarts[Object.keys(savedCarts)[i]]) ?? [];

                    let grand = 0;
                    var discount_xauzit = 0;
                    let cpn = 0;

                    total_cart.forEach(element => {
                        if (element.parts == 0) {
                            var disc_percent = (element.disc_percent) / 100;
                            var disc_shade_price = element.shade_price - (element.shade_price * disc_percent);

                            var total_shade_price = element.quantity * disc_shade_price;
                            var total_cassette_price = element.quantity * (element.cassette_price ? element.cassette_price : 0);
                            var total_mount_price = element.quantity * (element.mount_price ? element.mount_price : 0);
                            var total_wrap_price = element.quantity * (element.wrap_price ? element.wrap_price : 0);
                            var total_brackets_opt_price = element.quantity * (element.brackets_opt_price ? element.brackets_opt_price : 0);
                            var total_spring_assist_price = element.quantity * (element.spring_assist_price ? element.spring_assist_price : 0);
                            var total_motor_price = element.quantity * (element.motor_price ? element.motor_price : 0);
                            var total_channel_price = element.quantity * (element.channel_price ? element.channel_price : 0);
                            var total_motor_arr_price = element.quantity * (element.motor_arr_price ? element.motor_arr_price : 0);

                            var total_plugin_price = element.quantity * (element.plugin_price ? element.plugin_price : 0);
                            var total_solar_price = element.quantity * (element.solar_price ? element.solar_price : 0);
                            var total_hub_price = element.quantity * (element.hub_price ? element.hub_price : 0);
                            var total_transformer_price = element.quantity * (element.transformer_price ? element.transformer_price : 0);

                            var total = (total_shade_price + total_cassette_price + total_mount_price + total_wrap_price + total_brackets_opt_price + total_spring_assist_price + total_motor_price + total_channel_price +
                                total_motor_arr_price +
                                total_plugin_price + total_solar_price + total_hub_price + total_transformer_price);

                            discount_xauzit = discount_xauzit + (element.shade_price * element.quantity) + (total_cassette_price + total_mount_price + total_wrap_price + total_brackets_opt_price + total_spring_assist_price +
                                total_motor_price +
                                total_channel_price + total_motor_arr_price + total_plugin_price + total_solar_price + total_hub_price + total_transformer_price);

                            grand = grand + total;
                        } else {
                            var total = element.quantity * element.price;
                            discount_xauzit = discount_xauzit + (element.price * element.quantity);
                            grand = grand + total;
                        }
                    });
                    // console.log();
                    grand = grand;
                    grand = grand.toFixed(2);
                    $('#grandtotal' + i).text(grand);
                    $('#discount_xauzit' + i).text(discount_xauzit);

                }
            }

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
    </script>
@endsection
