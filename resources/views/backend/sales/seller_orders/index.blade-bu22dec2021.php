@extends('backend.layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp

<div class="card">
    <form class="" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('Dealer Orders') }}</h5>
            </div>
            <div class="col-lg-2">
                <div class="form-group mb-0">
                    <!--input type="text" class="aiz-date-range form-control" value="{{ $date }}" name="date" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off"-->
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group mb-0">
                    <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="seller_id" name="seller_id">
                        <option value="">{{ translate('All Dealers') }}</option>
                        @foreach ($sellers as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Order# & hit Enter') }}">
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
                </div>
            </div>
        </div>
    </form>

    <!--div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th width="20%">{{translate('Order Code')}}</th>
                    <th data-breakpoints="lg">{{translate('Num. of Products')}}</th>
                    <th data-breakpoints="lg">{{translate('Customer')}}</th>
                    <th>{{translate('Dealer')}}</th>
                    <th data-breakpoints="lg">{{translate('Amount')}}</th>
                    <th data-breakpoints="lg">{{translate('Delivery Status')}}</th>
                    <th data-breakpoints="lg">{{translate('Payment Method')}}</th>
                    <th data-breakpoints="lg">{{translate('Payment Status')}}</th>
                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                        <th>{{translate('Refund')}}</th>
                    @endif
                    <th class="text-right" width="15%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order_id)
                    @php
                        $order = \App\Order::find($order_id->id);
                    @endphp
                    @if($order != null)
                        <tr>
                            <td>
                                {{ ($key+1) + ($orders->currentPage() - 1)*$orders->perPage() }}
                            </td>
                            <td>
                                {{ $order->code }}@if($order->viewed == 0) <span class="badge badge-inline badge-info">{{translate('New')}}</span>@endif
                            </td>
                            <td>
                                {{-- count($order->orderDetails->where('seller_id', '!=', $admin_user_id)) --}}
                            </td>
                            <td>
                                @if ($order->user != null)
                                    {{ $order->user->name }}
                                @else
                                    Guest ({{ $order->guest_id }})
                                @endif
                            </td>
                            <td>
                                @if($order->seller)
                                    {{ $order->seller->name }}
                                @endif
                            </td>
                            <td>
                                {{ single_price($order->grand_total) }}
                            </td>
                            <td>
                                @php
                                    $status = $order->delivery_status;
                                @endphp
                                {{ translate(ucfirst(str_replace('_', ' ', $status))) }}
                            </td>
                            <td>
                                {{ translate(ucfirst(str_replace('_', ' ', $order->payment_type))) }}
                            </td>
                            <td>
                                @if ($order->payment_status == 'paid')
                                  <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                                @else
                                  <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
                                @endif
                            </td>
                            @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                <td>
                                    @if (count($order->refund_requests) > 0)
                                        {{ count($order->refund_requests) }} {{ translate('Refund') }}
                                    @else
                                        {{ translate('No Refund') }}
                                    @endif
                                </td>
                            @endif

                            <td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="" title="{{ translate('View') }}">
                                    <i class="las la-eye"></i>
                                </a>
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $order->id) }}" title="{{ translate('Download Invoice') }}">
                                    <i class="las la-download"></i>
                                </a>
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('orders.destroy', $order->id)}}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $orders->appends(request()->input())->links() }}
        </div>
    </div-->

    <!-- Xzt Order Display for Admin-->
    <div class="card-body">
        <table class="table aiz-table mb-0 w-100 p-0 m-0" style="font-size:12px; width:100%;">
            <thead>
                <tr>
                    <th style="vertical-align:middle;">Order Number</th>
                    <th style="vertical-align:middle;">Date</th>
                    <!--th style="vertical-align:middle;">Product ID</th-->
                    <th data-breakpoints="lg" style="vertical-align:middle;">Dealer Name</th>
                    <!--th style="vertical-align:middle;">Tags</th-->
                    <th style="vertical-align:middle;">Quantity</th>
                    <th style="vertical-align:middle;">Product Name</th>
                    <!--th style="vertical-align:middle;">Width</th-->
                    <!--th style="vertical-align:middle;">Length</th-->
                    <th style="vertical-align:middle;">Total Price</th>
                    <th style="vertical-align:middle;">Status</th>
                    <th style="vertical-align:middle;">Details</th>
                    <th style="vertical-align:middle;text-align:center;">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                <tr>
                    <td style="width:16%;vertical-align:middle;">
                        <a href="{{ route('seller_orders.ord_details', [ 'id'=> $item->order_number ]) }}">{{$item->order_number}}</a>
                    </td>
                    <!--td style="vertical-align:middle;">{{$item->product_id}}</td-->
                    <td style="vertical-align:middle;">{{$item->date}}</td>
                    <td style="vertical-align:middle;">{{$item->dealer_name}}</td>
                    <td style="vertical-align:middle;">{{$item->quantity}}</td>
                    <td style="vertical-align:middle;">{{$item->name}}</td>
                    <!--td style="vertical-align:middle;">{{$item->width}}</td-->
                    <!--td style="vertical-align:middle;">{{$item->length}}</td-->
                    <td style="width:9%;vertical-align:middle;">{{$item->total_price}}</td>
                    <td style="vertical-align:middle;">{{$item->status}}</td>
                    <td style="vertical-align:middle;">
                        <a href="{{route('seller_orders.specs', $item->id)}}" class="" title="">Details</a>
                    </td>
                    <td style="vertical-align:middle;text-align:center;">
                        @if($item->status == 'Ready')
                        <a href="{{route('seller_orders.delivery_note', $item->id)}}" class="" title="">Delivery Notes</a> | 
                        <a href="{{route('seller_orders.labels', $item->id)}}" class="" title="">Labels</a>
                        @else
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $orders->appends(request()->input())->links() }}
        </div>
    </div>

</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script>
@endsection
