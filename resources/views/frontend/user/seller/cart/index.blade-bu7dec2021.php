@extends('frontend.layouts.user_panel')
@section('mystyles')
<link rel="stylesheet" href="{{ static_asset('assets/css/cart.css') }}">
@endsection
@section('panel_content')
<div class="aiz-titlebar text-left mt-2 mb-1">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Carts</h1>
        </div>
    </div>
</div>
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
<div class="container-fluid">
    <div class="row">
        <aside class="col-lg-9">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-borderless table-shopping-cart" id="cart_table">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col" style="width:40%">Product</th>
                                <th scope="col" style="width:35%">Quantity</th>
                                <th scope="col" width="200">Price</th>
                                <th scope="col" class="text-right d-none d-md-block" width="200"></th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </aside>
        <aside class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <!--dl class="dlist-align">
                        <dt>Total price:</dt>
                        <dd class="text-right ml-3">$69.97</dd>
                    </dl>
                    <dl class="dlist-align">
                        <dt>Discount:</dt>
                        <dd class="text-right text-danger ml-3">- $10.00</dd>
                    </dl-->
                    <dl class="dlist-align">
                        <dt>Total:</dt>
                        <dd class="text-right text-dark b ml-3">$ <span id="grandtotal"></span></dd>
                    </dl>
                    <hr><a href="{{ route('seller.products') }}" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Continue: Products</a> <a href="{{route('parts.list')}}" id="sbtorder" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Continue: Parts </a> 
                    <label class="col-from-label mt-3" for="name">Coupon</label>
                    <form id="coupon_form" action="" method="post" >
                        @csrf
                        <input type="text" class="form-control mb-3" id="coupon" name="coupon" />
                        <input type="button" class="form-control btn btn-info text-center" id="coupon_sbmt" name="coupon_sbmt" value="Apply Coupon" style="" />
                    </form>
                    <h5 id="show_discount" class="mt-2"></h5>
                </div>
            </div>
        </aside>
    </div>
</div>

<div class="card">
    <form class="" id="shipaddress" action="{{route('cart.seller.store')}}" method="post">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-0 h6">Shipping Address</h5>
            </div>
        </div>
    
        <div class="card-body" style="padding-left:0;">
            <div class="container">
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Full Name" id="ship_name" name="ship_name" class="form-control" value="{{$ship->ship_name}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_email">Email</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Email" id="ship_email" name="ship_email" class="form-control"  value="{{$ship->ship_email}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_addr">Shipping Address</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Shipping Address" id="ship_addr" name="ship_addr" class="form-control"  value="{{$ship->ship_addr}}" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_addr">Shipping Address 2</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Shipping Address Optional" id="ship_addr2" name="ship_addr2" class="form-control"  value="{{$ship->ship_addr2}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_country">Country</label>
                    <div class="col-sm-9">
                        <!--input type="text" placeholder="Country" id="ship_country" name="ship_country" class="form-control" required-->
                        <select id="ship_country" name="ship_country" class="form-control country" required>
                            <option value="">Select Country</option>
                            @foreach($destinations as $item)
                            <option value="{{$item->country}}" data-country="{{$item->country_code}}">{{$item->country}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_city">State</label>
                    <div class="col-sm-9">
                        <!--input type="text" placeholder="City" id="ship_city" name="ship_city" class="form-control" required-->
                        <select id="ship_city" name="ship_city" class="form-control city" required>
                            <option value="">Select State</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_zip">Zip</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Zip" id="ship_zip" name="ship_zip" class="form-control"  value="{{$ship->ship_zip}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-3 offset-sm-9">
                        <button type="submit" class="form-control btn btn-success">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        $( document ).ready(function() {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            // console.log(cart);
            if (cart.length){
            // using forEach, calculate the total price of each item within our cart array
                $('#cart_table').append("<tbody>");
                cart.forEach(element => {
                    // if(element.parts == 0) {
                    //     var disc_percent = (element.disc_percent)/100;
                    //     var disc_shade_price = element.shade_price - (element.shade_price * disc_percent);
                        
                    //     var total_shade_price = element.quantity * disc_shade_price;
                    //     var total_cassette_price = element.quantity * (element.cassette_price ? element.cassette_price : 0);
                    //     var total_mount_price = element.quantity * (element.mount_price ? element.mount_price : 0);
                    //     var total_wrap_price = element.quantity * (element.wrap_price ? element.wrap_price : 0);
                    //     var total_brackets_opt_price = element.quantity * (element.brackets_opt_price ? element.brackets_opt_price : 0);
                    //     var total_spring_assist_price = element.quantity * (element.spring_assist_price ? element.spring_assist_price : 0);
                    //     var total_motor_price = element.quantity * (element.motor_price ? element.motor_price : 0);
                    //     var total_channel_price = element.quantity * (element.channel_price ? element.channel_price : 0);
                    //     var total_motor_arr_price = element.quantity * (element.motor_arr_price ? element.motor_arr_price : 0);
                        
                    //     var total_plugin_price = element.quantity * (element.plugin_price ? element.plugin_price : 0);
                    //     var total_solar_price = element.quantity * (element.solar_price ? element.solar_price : 0);
                    //     var total_hub_price = element.quantity * (element.hub_price ? element.hub_price : 0);
                    //     var total_transformer_price = element.quantity * (element.transformer_price ? element.transformer_price : 0);

                    //     var total = (total_shade_price + total_cassette_price + total_mount_price + total_wrap_price + total_brackets_opt_price + total_spring_assist_price + total_motor_price + total_channel_price + total_motor_arr_price + total_plugin_price + total_solar_price + total_hub_price + total_transformer_price);
                    //     element.price = total/element.quantity;
                    //     element.total = total;
                    //     total = total.toFixed(2);
                    // }else {
                    //     var total =  element.quantity * element.price;
                    //     total = total.toFixed(2);
                    // }
                    
                    var new_html = '<tr id="'+element.order_number+'"><td><figure class="itemside align-items-center"><div class="aside"><img src="'+element.main_img+'" class="" width="100px" height="100px"></div><figcaption class="info"><a href="javascript:void(0);" class="text-muted small" data-abc="true">'+element.project_tag+'</a><p class="text-muted small">'+element.order_number+'<br>'+element.dealer_name+'</p></figcaption></figure></td><td><button type="button" id="decqty" data-ord-num='+element.order_number+' class="btn btn-sm btn-danger"><i class="las la-minus"></i></button><span id="qty">'+element.quantity+'</span><button type="button" id="incqty" data-ord-num='+element.order_number+' class="btn btn-sm btn-danger"><i class="las la-plus"></i></button></td><td><div class="price-wrap"> <var class="price">$<span id="tprice">'+element.price+'</span></var></td><td class="text-center d-md-block"><a href="javascript:void(0);" id="delord" data-ord-num='+element.order_number+' class="btn btn-light btn-round" data-abc="true"> Remove</a> </td></tr>';
                    $('#cart_table').append(new_html);
                });
                $('#cart_table').append("</tbody>");
                cal_total();
            }
        });

        $(document).on('click', "#incqty", function(e){
            var ord_num = $(this).data('ord-num');
            let new_qty;
            let price;
            let updcart = JSON.parse(localStorage.getItem("cart")) || [];
            if(parseInt($(this).siblings('span#qty').text()) < 10) {
                new_qty = parseInt($(this).siblings('span#qty').text()) + 1;
                $(this).siblings('span#qty').text(new_qty);
            
                updcart.forEach(element => {
                    if(element.order_number == ord_num) {
                        new_qty = $(this).siblings('span#qty').text();
                        if(element.parts == 0) {
                            var disc_percent = (element.disc_percent)/100;
                            var disc_shade_price = element.shade_price - (element.shade_price * disc_percent);
                            
                            var total_shade_price = new_qty * disc_shade_price;
                            var total_cassette_price = new_qty * (element.cassette_price ? element.cassette_price : 0);
                            var total_mount_price = new_qty * (element.mount_price ? element.mount_price : 0);
                            var total_wrap_price = new_qty * (element.wrap_price ? element.wrap_price : 0);
                            var total_brackets_opt_price = new_qty * (element.brackets_opt_price ? element.brackets_opt_price : 0);
                            var total_spring_assist_price = new_qty * (element.spring_assist_price ? element.spring_assist_price : 0);
                            var total_motor_price = new_qty * (element.motor_price ? element.motor_price : 0);
                            var total_channel_price = new_qty * (element.channel_price ? element.channel_price : 0);
                            var total_motor_arr_price = new_qty * (element.motor_arr_price ? element.motor_arr_price : 0);
                            
                            var total_plugin_price = new_qty * (element.plugin_price ? element.plugin_price : 0);
                            var total_solar_price = new_qty * (element.solar_price ? element.solar_price : 0);
                            var total_hub_price = new_qty * (element.hub_price ? element.hub_price : 0);
                            var total_transformer_price = new_qty * (element.transformer_price ? element.transformer_price : 0);

                            var total = (total_shade_price + total_cassette_price + total_mount_price + total_wrap_price + total_brackets_opt_price + total_spring_assist_price + total_motor_price + total_channel_price + total_motor_arr_price + total_plugin_price + total_solar_price + total_hub_price + total_transformer_price);

                            element.price = (total/new_qty).toFixed(2);
                            total = total.toFixed(2);
                            element.total = total;
                        }else {
                            var total = new_qty * element.price;
                            total = total.toFixed(2);
                            element.total = total;
                        }
                        // $(this).closest('td').siblings().find('span#tprice').text(total);
                        
                    }
                });
                var idx = updcart.findIndex(x => x.order_number === ord_num);
                updcart[idx]['quantity'] = new_qty;
                // updcart[idx]['price'] = total;
                localStorage.setItem("cart", JSON.stringify(updcart));
                cal_total();
            }
        });

        $(document).on('click', "#decqty", function(e){
            var ord_num = $(this).data('ord-num');
            let new_qty;
            let updcart = JSON.parse(localStorage.getItem("cart")) || [];
            if(parseInt($(this).siblings('span#qty').text()) > 1) {
                    new_qty = parseInt($(this).siblings('span#qty').text()) - 1;
                    // console.log(new_qty);
                    $(this).siblings('span#qty').text(new_qty);
                
                updcart.forEach(element => {
                    if(element.order_number == ord_num) {
                        var new_qty = $(this).siblings('span#qty').text();
                        if(element.parts == 0) {
                            var disc_percent = (element.disc_percent)/100;
                            var disc_shade_price = element.shade_price - (element.shade_price * disc_percent);
                            
                            var total_shade_price = new_qty * disc_shade_price;
                            var total_cassette_price = new_qty * (element.cassette_price ? element.cassette_price : 0);
                            var total_mount_price = new_qty * (element.mount_price ? element.mount_price : 0);
                            var total_wrap_price = new_qty * (element.wrap_price ? element.wrap_price : 0);
                            var total_brackets_opt_price = new_qty * (element.brackets_opt_price ? element.brackets_opt_price : 0);
                            var total_spring_assist_price = new_qty * (element.spring_assist_price ? element.spring_assist_price : 0);
                            var total_motor_price = new_qty * (element.motor_price ? element.motor_price : 0);
                            var total_channel_price = new_qty * (element.channel_price ? element.channel_price : 0);
                            var total_motor_arr_price = new_qty * (element.motor_arr_price ? element.motor_arr_price : 0);
                            
                            var total_plugin_price = new_qty * (element.plugin_price ? element.plugin_price : 0);
                            var total_solar_price = new_qty * (element.solar_price ? element.solar_price : 0);
                            var total_hub_price = new_qty * (element.hub_price ? element.hub_price : 0);
                            var total_transformer_price = new_qty * (element.transformer_price ? element.transformer_price : 0);

                            var total = (total_shade_price + total_cassette_price + total_mount_price + total_wrap_price + total_brackets_opt_price + total_spring_assist_price + total_motor_price + total_channel_price + total_motor_arr_price + total_plugin_price + total_solar_price + total_hub_price + total_transformer_price);
                            
                            element.price = (total/new_qty).toFixed(2);
                            total = total.toFixed(2);
                            element.total = total;
                        }else {
                            var total = new_qty * element.price;
                            total = total.toFixed(2);
                            element.total = total;
                        }
                        // $(this).closest('td').siblings().find('span#tprice').text(total);
                    }
                });
                var idx = updcart.findIndex(x => x.order_number === ord_num);
                updcart[idx]['quantity'] = new_qty;
                localStorage.setItem("cart", JSON.stringify(updcart));
                if (new_qty >= 1) cal_total();
            }
        });

        $(document).on('click', "#delord", function(e){
            var ord_num = $(this).data('ord-num');
            let updcart = JSON.parse(localStorage.getItem("cart")) || [];
            var filtered = updcart.filter(function(value, index, arr){ 
                return value.order_number != ord_num;
            });
            $('#'+ord_num).remove();
            localStorage.setItem("cart", JSON.stringify(filtered));
            cal_total();
        });

        function cal_total() {
            let total_cart = JSON.parse(localStorage.getItem("cart")) || [];
            let grand = 0;
            let cpn = 0;

            total_cart.forEach(element => {
                if(element.parts == 0) {
                    var disc_percent = (element.disc_percent)/100;
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

                    var total = (total_shade_price + total_cassette_price + total_mount_price + total_wrap_price + total_brackets_opt_price + total_spring_assist_price + total_motor_price + total_channel_price + total_motor_arr_price + total_plugin_price + total_solar_price + total_hub_price + total_transformer_price);
                    
                    grand = grand + total;
                }else {
                    var total = element.quantity * element.price;
                    grand = grand + total;
                }
            });
            // console.log();
            grand = grand - coupon_amount;
            grand = grand.toFixed(2);
            $('#grandtotal').text(grand);
        }

        $('.country').change(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = (this.id);
            var country = $('option:selected',this).attr('data-country');
            jQuery.ajax({
                url: "{{ route('seller.states') }}",
                type: 'POST',
                data: {'country': country },
                success: function(result){
                    if(id == 'ship_country') {
                        $('#ship_city').find('option').not(':first').remove();
                        $('#ship_city').append(result);
                    }else {
                        $('#bill_city').find('option').not(':first').remove();
                        $('#bill_city').append(result);
                    }
                    // $('.city').find('option').not(':first').remove();
                    // $('.city').append(result);
                    
                }
            });
        });

        // function addqty(ordnum) {
            
        // }

        // $(document).on("change", ".check-all", function() {
        //     if(this.checked) {
        //         // Iterate each checkbox
        //         $('.check-one:checkbox').each(function() {
        //             this.checked = true;                        
        //         });
        //     } else {
        //         $('.check-one:checkbox').each(function() {
        //             this.checked = false;                       
        //         });
        //     }
        // });
        
        // function sort_customers(el){
        //     $('#sort_customers').submit();
        // }
        // function confirm_ban(url)
        // {
        //     $('#confirm-ban').modal('show', {backdrop: 'static'});
        //     document.getElementById('confirmation').setAttribute('href' , url);
        // }

        // function confirm_unban(url)
        // {
        //     $('#confirm-unban').modal('show', {backdrop: 'static'});
        //     document.getElementById('confirmationunban').setAttribute('href' , url);
        // }
        
        // function bulk_delete() {
        //     var data = new FormData($('#sort_customers')[0]);
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: "{{route('bulk-customer-delete')}}",
        //         type: 'POST',
        //         data: data,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function (response) {
        //             if(response == 1) {
        //                 location.reload();
        //             }
        //         }
        //     });
        // }

        $('#shipaddress').on('submit', function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            let products = [];
            let i = 0;
            cart.forEach(element => {
                products[i] = {
                    "cart_id": element.cart_id,
                    "prod_id": element.prod_id,
                    "prod_name": element.prod_name, 
                    "dealer_name": element.dealer_name,
                    "order_number": element.order_number,
                    "due_date": element.due_date,
                    
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
                    "brackets_opt": element.brackets_opt,
                    "brackets_opt_price": element.brackets_opt_price,
                    "spring_assist_price": element.spring_assist_price,

                    "cust_side_mark": element.cust_side_mark,
                    "project_tag": element.project_tag,
                    
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
                    "total": element.total,
                }
                i++;
            });
            let ship_name = $('#ship_name').val();
            let ship_email = $('#ship_email').val();
            let ship_addr = $('#ship_addr').val();
            let ship_addr2 = $('#ship_addr2').val() ? $('#ship_addr2').val():'';
            let ship_country = $('#ship_country').val();
            let ship_city = $('#ship_city').val();
            let ship_zip = $('#ship_zip').val();

            let ship_data = {
                'ship_name': ship_name, 
                'ship_email': ship_email, 
                'ship_addr': ship_addr, 
                'ship_addr2': ship_addr2, 
                'ship_country': ship_country, 
                'ship_city': ship_city, 
                'ship_zip': ship_zip
            };

            let ord_grandtotal = $('#grandtotal').text();

            jQuery.ajax({
                url: "{{ route('cart.seller.store') }}",
                type: 'POST',
                data: { 'products': products, 'ship': ship_data, 'ord_grandtotal': ord_grandtotal, 'coupon_val': coupon_amount },
                success: function(result){
                    if(result == 'success'){
                        localStorage.clear();
                        alert('Cart successfully stored.');
                        window.location.href = "{{route('seller.products')}}";
                        // location.reload();
                    }else {
                        alert('Please try again.');
                    }
                }
            });
        });
        
        var coupon_chk = 0;
        var coupon_amount = 0;

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
                        if(result['msg'] == 'found') {
                            var deduction = 0;
                            if(result['discount_type'] == 0) {
                                deduction = result['discount'];
                                // console.log(deduction);
                                if(coupon_chk == 0) {
                                    $('#coupon_discount').val(deduction);
                                    $('#show_discount').text('$ '+deduction);
                                    coupon_chk = 1;
                                    coupon_amount = deduction;
                                    cal_total();
                                }
                            }else {
                                if(coupon_chk == 0) {
                                    var grand_ttl = $('#grandtotal').text();
                                    deduction = result['discount'];
                                    var coupon_discount = grand_ttl - (grand_ttl * (deduction/100));
                                    $('#coupon_discount').val(coupon_discount);
                                    $('#show_discount').text('$ '+coupon_discount);
                                    coupon_chk = 1;
                                    coupon_amount = coupon_discount;
                                    cal_total();
                                }
                            }
                        }else if (result['used'] != ''){
                            alert(result['used']);
                        }
                    }
                });
            });
        });
    </script>
@endsection
