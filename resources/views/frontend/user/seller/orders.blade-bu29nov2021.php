@extends('frontend.layouts.user_panel')
@section('panel_content')
<div class="card">
<form id="sort_orders" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('Orders') }}</h5>
            </div>
            <!--div class="col-md-3 ml-auto">
                <select class="form-control aiz-selectpicker" data-placeholder="{{ translate('Filter by Payment Status')}}" name="payment_status" onchange="sort_orders()">
                    <option value="">{{ translate('Filter by Payment Status')}}</option>
                    <option value="paid" @isset($payment_status) @if($payment_status == 'paid') selected @endif @endisset>{{ translate('Paid')}}</option>
                    <option value="unpaid" @isset($payment_status) @if($payment_status == 'unpaid') selected @endif @endisset>{{ translate('Un-Paid')}}</option>
                </select>
            </div>
            <div class="col-md-3 ml-auto">
                <select class="form-control aiz-selectpicker" data-placeholder="{{ translate('Filter by Payment Status')}}" name="delivery_status" onchange="sort_orders()">
                    <option value="">{{ translate('Filter by Deliver Status')}}</option>
                    <option value="pending" @isset($delivery_status) @if($delivery_status == 'pending') selected @endif @endisset>{{ translate('Pending')}}</option>
                    <option value="confirmed" @isset($delivery_status) @if($delivery_status == 'confirmed') selected @endif @endisset>{{ translate('Confirmed')}}</option>
                    <option value="on_delivery" @isset($delivery_status) @if($delivery_status == 'on_delivery') selected @endif @endisset>{{ translate('On delivery')}}</option>
                    <option value="delivered" @isset($delivery_status) @if($delivery_status == 'delivered') selected @endif @endisset>{{ translate('Delivered')}}</option>
                </select>
            </div-->
            <div class="col-md-6">
                <div class="input-group mb-0">
                    <div class="input-group-append">    
                        <button class="btn btn-danger" type="button"><a href="{{route('orders.index')}}" class="text-white">Clear</a></button>
                    </div>
                    <input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type shade & press enter">
                </div>
            </div>
        </div>
    </form>
    <form id="sort_orders_date" action="" method="GET">
        <div class="card-header row gutters-5">
            <!-- <div class="col-md-6 d-inline">
                <div class="from-group mb-0 d-inline">
                    <input type="text" class="form-control d-inline" id="searchdate" name="searchdate" @isset($sort_searchdate) value="{{ $sort_searchdate }}" @endisset placeholder="Type date [yyyy-mm-dd] & press enter">
                    <input type="submit" class="btn btn-primary d-inline" value="Enter" />
                </div>
            </div> -->
            <div class="input-group mb-0 col-6 ml-auto">
                
                <input type="date" class="form-control" id="searchdate" name="searchdate" @isset($sort_searchdate) value="{{ $sort_searchdate }}" @endisset>
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Enter</button>
                </div>
            </div>
        </div>
    </form>
    @if (count($orders) > 0)
    <div class="card-body p-3">
        <table class="table aiz-table mb-0 w-100 p-0 m-0" style="font-size:12px; width:100%;">
            <thead>
                <tr class="text-center">
                    <th style="vertical-align:middle;">Order Number</th>
                    <th style="vertical-align:middle;">Product ID</th>
                    <th data-breakpoints="lg" style="vertical-align:middle;">Dealer Name</th>
                    <th data-breakpoints="lg" style="vertical-align:middle;">Tags</th>
                    <th style="vertical-align:middle;">Quantity</th>
                    <th style="vertical-align:middle;">Product Name</th>
                    <th data-breakpoints="lg" style="vertical-align:middle;">WidthxLength</th>
                    <th style="vertical-align:middle;">Total Price</th>
                    <th style="vertical-align:middle;">Status</th>
                    <th style="vertical-align:middle;">Due Date</th>
                    <th style="vertical-align:middle;">Details</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                <tr class="text-center">
                    <td style="width:18%;vertical-align:middle;">{{$item->order_number}}</td>
                    <td style="vertical-align:middle;">{{$item->product_id}}</td>
                    <td style="vertical-align:middle;">{{$item->dealer_name}}</td>
                    <td style="vertical-align:middle;">{{$item->project_tag}}</td>
                    <td style="vertical-align:middle;">{{$item->quantity}}</td>
                    <td style="vertical-align:middle;">{{$item->name}}</td>
                    <td style="vertical-align:middle;">{{$item->width}}x{{$item->length}}</td>
                    <td style="width:9%;vertical-align:middle;">$ {{$item->total_price}}</td>
                    <td style="vertical-align:middle;">{{$item->status}}</td>
                    <td style="vertical-align:middle;">{{$item->due_date}}</td>
                    <td style="vertical-align:middle;">
                        <a href="{{route('orders.details', ['id'=>$item->id])}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="View"><i class="las la-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $orders->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
@section('modal')
<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div id="payment_modal_body">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function show_order_details(order_id)
    {
        $('#order-details-modal-body').html(null);
    
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
    
        $.post('{{ route('orders.details') }}', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }
    function sort_orders(el){
        $('#sort_orders').submit();
    }
</script>
@endsection