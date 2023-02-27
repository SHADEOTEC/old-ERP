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
<form class="" action="{{route('cart.seller.index')}}" method="" enctype="multipart/form-data" id="choice_form" >
<!--form class="" action="{{route('cart.seller.index')}}" method="" enctype="multipart/form-data" id="choice_form" onsubmit="return confirm('Do you want to submit this order? No change or cancellation accepted after placing the order.');"-->
    <div class="row gutters-5">
        <div class="col-lg-8">
            <input name="_method" type="hidden" value="POST">
            <input type="hidden" name="id" id="id" value="{{ $part->id }}">
            @csrf
            <input type="hidden" name="added_by" value="seller">
            <!-- Product Info Card -->
            <div class="card pt-4">
                <!--div class="d-flex justify-content-center align-items-start"-->
                <div class="d-flex align-items-start pl-3">
                    <div>
                        <img src="{{ static_asset('parts/images/').'/'.$part->thumbnail_img }}" id="main_img" width="235px" height="200px" class=""/>
                    </div>
                    <div class="pr-2 pl-2 pb-2 pt-0">
                        <p class="font-weight-bold" name="product_name" id="product_name">{{$part->name}}</p>
                        <p class="font-weight-bold">Description</p>
                        <p class="font-weight-lighter" id="shade_desc">{{strip_tags($part->description)}}</p>
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
                            <label for="">Tag/Project Name</label>
                            <input type="text" class="form-control" name="project_tag" id="project_tag" placeholder="" required>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6 pt-2">
                            <label for="">Invoice Number</label>
                            <input type="text" class="form-control" name="order_number" id="order_number"  placeholder="" required value="{{Auth::id().'-'.time().'-'.$part->id}}" readonly>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6 pt-2">
                            <label for="">Due Date</label>
                            <input class="form-control" type="date" name="duedate" min="{{date('Y-m-d')}}" id="duedate" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="add_to_cart">
                <!-- Specification -->
                <div class="card">
                    <div class="card-header p-2" id="room" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button">
                            TECHNICAL DETAILS
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="room" data-parent="#add_to_cart">
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <p>{{$part->specification}}</p>
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
                                <div class="col-12 col-md-12 col-lg-12 pt-2">
                                    <label for="">Price ($)</label>
                                    <input type="text" class="form-control" id="price" name="price" readonly value="{{number_format($part->unit_price, 2, '.', '')}}">
                                </div>
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
            <h5 style="background-color:#FFF;" class="p-3 mb-4 display_price_box text-center">Price Details</h5>
            <!-- Display Quantity -->
            <div class="card display_price_box pt-2">
                <div class="row p-3">
                    <div class="col-md-6">
                        <p class="font-weight-bold">Quantity</p>
                    </div>
                    <div class="col-md-6">
                        <p class="font-weight-bold">Total Price</p>
                    </div>
                </div>
                <div class="row pl-3 mb-1">
                    <div class="col-md-6">
                        <p id="txt_qty" class="font-weight-bold"></p>
                    </div>
                    <div class="col-md-6">
                        <span>$ </span><p id="txt_price" class="font-weight-bold d-inline">0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mar-all text-right">
                <button type="submit" name="button" id="button" value="publish" class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
        <!--div class="col-12">
            <div class="mar-all text-right">
                <button type="button" name="button" id="pdf" value="pdf" class="btn btn-primary" onclick="printJS('choice_form', 'html')">Export to PDF</button>
            </div>
        </div-->
    </div>
</form>
@endsection
@section('script')
<script src="{{url('assets/js/jquery-ui.js')}}"></script>
<script src="{{url('assets/js/print.min.js')}}"></script>

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
    
        var str = @php echo $part->attributes @endphp;
    
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

    $(function() {
        // $( "#duedate" ).datepicker();
        // $( "#duedate" ).datepicker("setDate", "+3");
        // $( "#duedate" ).datepicker({ minDate: +3});
    });

    $('#quantity').on('change', function() {
        $('#txt_qty').text($('#quantity option:selected').val());
        var total = parseFloat($('#quantity option:selected').val()) * parseFloat($('#price').val());
        $('#txt_price').text(total);

    });

    var key = 0, product = {};
   
    function add_to_cart() {
        if(localStorage.getItem('key') != null) {
            // key = parseInt(localStorage.getItem('key')) + parseInt(1);
            key = parseInt(localStorage.getItem('key'));
        }else {
            localStorage.setItem('key', 0);
        }
        var dealer_name = $('#dealer_name').val() ? $('#dealer_name').val():'';
        var cust_side_mark = $('#cust_side_mark').val() ? $('#cust_side_mark').val():'';
        var project_tag = $('#project_tag').val() ? $('#project_tag').val():'';
        var order_number = $('#order_number').val() ? $('#order_number').val():'';
        var due_date = $('#duedate').val() ? $('#duedate').val():'';

        var quantity = $('#quantity').val() ? $('#quantity').val():'';
        
        //Product Info
        var prod_id = $('#id').val() ? $('#id').val():'';
        var img_url = $('#main_img').prop('src') ? $('#main_img').prop('src'):'';
        var prod_name = $('#product_name').text() ? $('#product_name').text():'';
        
        //Price
        var price = $('#price').val() ? $('#price').val():'';
        var total = $('#txt_price').text() ? $('#txt_price').text():'';
        
        var product = {
            "cart_id": key,
            "dealer_name": dealer_name,
            "cust_side_mark": cust_side_mark,
            "project_tag": project_tag,
            "order_number": order_number,
            "quantity": quantity,
            "prod_id": prod_id,
            "main_img": img_url,
            "prod_name": prod_name, 
            "price": price,
            "total": total,
            "due_date": due_date,
            "parts": 1, 
        }
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart.push(product);
        localStorage.setItem("cart", JSON.stringify(cart));
        // localStorage.setItem("product_" + key, JSON.stringify(product));
        localStorage.setItem('key', parseInt(key) + parseInt(1));
    
    }

    $('#button').click(function () {
        $('#collapseTwo').removeClass('collapse');
    });

    $('form').bind('submit', function (e) {
        if (confirm("Do you want to submit this order? No change or cancellation accepted after placing the order.")) {
            add_to_cart();
            return true;
        } else {
            return false;
        }
    });


</script>
@endsection