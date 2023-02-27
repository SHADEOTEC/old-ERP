@extends('frontend.layouts.user_panel')
@section('panel_content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Order Details</h5>
</div>

<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">Order Number: {{$order->order_number}}</h5>
        </div>

        <div class="card-body">
            <div class="form-group row">
                <h5>Product Information</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Product ID</th>
                        <th>Tags</th>
                        <th>Discount%</th>
                    </thead>
                    <tbody>
                        <td>{{$order->product_id}}</td>
                        <td>{{$order->tags}}</td>
                        <td>{{$order->admin_discount}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <h5>Measurements</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Width</th>
                        <th>Width Decimal</th>
                        <th>Length</th>
                        <th>Length Decimal</th>
                    </thead>
                    <tbody>
                        <td>{{$order->width ?? 'N/A'}}</td>
                        <td>{{$order->width_decimal ?? 'N/A'}}</td>
                        <td>{{$order->length}}</td>
                        <td>{{$order->length_decimal}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <h5>Shade</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Shade Price</th>
                        <th>Shade Fabric</th>
                    </thead>
                    <tbody>
                        <td>$ {{$order->shade_amount}}</td>
                        <td>{{$order->fabric}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <h5>Control Type - Motor</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Motor Name</th>
                        <th>Motor Price</th>
                        <th>Motor with Width Price</th>
                    </thead>
                    <tbody>
                        <td>{{$order->motor_name}}</td>
                        <td>$ {{$order->motor_price ?? 'N/A'}}</td>
                        <td>{{$order->motor_array ?? 'N/A'}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <h5>Control Type - Manual</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Chain Color</th>
                        <th>Chain Control Side</th>
                        <th>Cord Color</th>
                        <th>Cord Control Side</th>
                    </thead>
                    <tbody>
                        <td>{{$order->chain_color ?? 'Not Included'}}</td>
                        <td>{{$order->chain_ctrl ?? 'Not Included'}}</td>
                        <td>{{$order->cord_color ?? 'Not Included'}}</td>
                        <td>{{$order->cord_ctrl ?? 'Not Included'}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <h5>Control Type - Manual</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Chain Color</th>
                        <th>Chain Control Side</th>
                        <th>Cord Color</th>
                        <th>Cord Control Side</th>
                    </thead>
                    <tbody>
                        <td>{{$order->chain_color ?? 'Not Included'}}</td>
                        <td>{{$order->chain_ctrl ?? 'Not Included'}}</td>
                        <td>{{$order->cord_color ?? 'Not Included'}}</td>
                        <td>{{$order->cord_ctrl ?? 'Not Included'}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <h5>Fabric Wrapped</h5>
                <table class="table table-stripped text-left">
                    <thead>
                        <th>Wrapped Price</th>
                        
                    </thead>
                    <tbody>
                        <td>{{$order->wrap_price ?? 'Not Included'}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <h5>Mount</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Mount Type</th>
                        <th>Mount Price</th>
                    </thead>
                    <tbody>
                        <td>{{$order->mount_type}}</td>
                        <td>{{$order->mount_price}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <h5>Cassette</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Cassette Type</th>
                        <th>Cassette Price</th>
                        <th>Cassette Color</th>
                    </thead>
                    <tbody>
                        <td>{{$order->cassette_type}}</td>
                        <td>{{$order->cassette_price}}</td>
                        <td>{{$order->cassette_color}}</td>
                    </tbody>
                </table>
            </div>
            
            <div class="form-group row">
                <h5>Bracket</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Brackets</th>
                        <th>Bracket Option</th>
                        <th>Bracket Option Price</th>
                    </thead>
                    <tbody>
                        <td>{{$order->brackets}}</td>
                        <td>{{$order->bracket_option_name ?? 'N/A'}}</td>
                        <td>{{$order->bracket_option ?? 'N/A'}}</td>
                    </tbody>
                </table>
            </div>
            
            <div class="form-group row">
                <h5>Room And Window</h5>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Room</th>
                        <th>Window</th>
                    </thead>
                    <tbody>
                        <td>{{$order->room_type}}</td>
                        <td>{{$order->window_desc ?? 'N/A'}}</td>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="">{{translate('Spring Assist')}}</label>
                <div class="col-sm-9">
                    <p>{{$order->spring_assist ?? 'N/A'}}</p>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="">{{translate('Stack')}}</label>
                <div class="col-sm-9">
                    <p>{{$order->stack ?? 'N/A'}}</p>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="">{{translate('Special Instructions')}}</label>
                <div class="col-sm-9">
                    <p>{{$order->sp_instructions}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="">{{translate('Coupon Discount')}}</label>
                <div class="col-sm-9">
                    <p>{{$order->coupon_discount}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="">{{translate('Total Price')}}</label>
                <div class="col-sm-9">
                    <p>$ {{$order->total_price}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="">{{translate('Shipping ID')}}</label>
                <div class="col-sm-9">
                    <p>{{$order->shipping_id}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="">{{translate('Status')}}</label>
                <div class="col-sm-9">
                    <p>{{$order->status}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="">{{translate('Due Date')}}</label>
                <div class="col-sm-9">
                    <p>{{$order->due_date}}</p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$('.country').click(function(e){
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
                $('#ship_city').find('option').remove();
                $('#ship_city').append(result);
            }else {
                $('#bill_city').find('option').remove();
                $('#bill_city').append(result);
            }
            // $('.city').find('option').not(':first').remove();
            // $('.city').append(result);
            
        }
    });
});
</script>
@endsection