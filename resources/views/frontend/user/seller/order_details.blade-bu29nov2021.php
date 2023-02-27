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
                <div style="background:#8B8B8B;color:white;width:100%;vertical-align:bottom;"><h5 class="pl-1 pt-1">Product Information</h5></div>
                <table class="table table-stripped text-center">
                    <thead>
                        <th>Product ID</th>
                        <th>Tags</th>
                        <th>Discount%</th>
                    </thead>
                    <tbody>
                        <td>{{$order->product_id}}</td>
                        <td>{{$order->project_tag}}</td>
                        <td>{{$order->admin_discount}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Measurements</h5></div>
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
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Shade</h5></div>
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
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Control Type - Motor</h5></div>
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
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Control Type - Manual</h5></div>
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
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Control Type - Manual</h5></div>
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
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Fabric Wrapped</h5></div>
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
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Mount</h5></div>
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
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Cassette</h5></div>
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
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Bracket</h5></div>
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
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Room And Window</h5></div>
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
            
            <div class="form-group row">
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Spring Assist</h5></div>
                <table class="table table-stripped text-left">
                    <thead>
                        <th>Spring Assist Price</th>
                    </thead>
                    <tbody>
                        <td>{{$order->spring_assist ?? 'N/A'}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Stack</h5></div>
                <table class="table table-stripped text-left">
                    <thead>
                        <th>Stack Position</th>
                    </thead>
                    <tbody>
                        <td>{{$order->stack ?? 'N/A'}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Special Instructions</h5></div>
                <table class="table table-stripped text-left">
                    <thead>
                        <th>Instructions</th>
                    </thead>
                    <tbody>
                        <td>{{$order->sp_instructions ?? 'N/A'}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Coupon</h5></div>
                <table class="table table-stripped text-left">
                    <thead>
                        <th>Coupon Discount ($)</th>
                    </thead>
                    <tbody>
                        <td>{{$order->coupon_discount ?? 'N/A'}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">Shipping Address</h5></div>
                <table class="table table-stripped text-left">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Address2</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Zip</th>
                    </thead>
                    <tbody>
                        <td>{{$order->xztshippingaddr->name}}</td>
                        <td>{{$order->xztshippingaddr->email}}</td>
                        <td>{{$order->xztshippingaddr->address}}</td>
                        <td>{{$order->xztshippingaddr->address2}}</td>
                        <td>{{$order->xztshippingaddr->country}}</td>
                        <td>{{$order->xztshippingaddr->city}}</td>
                        <td>{{$order->xztshippingaddr->zip}}</td>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <div style="background:#8B8B8B;color:white;width:100%;"><h5 class="pl-1 pt-1">More Information</h5></div>
                <table class="table table-stripped text-left">
                    <thead>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Total ($)</th>
                    </thead>
                    <tbody>
                        <td>{{$order->due_date}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{$order->total_price}}</td>
                    </tbody>
                </table>
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