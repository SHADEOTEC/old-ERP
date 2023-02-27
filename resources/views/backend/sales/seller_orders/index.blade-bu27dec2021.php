@extends('backend.layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp

<div class="card">
    <form class="" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">Orders</h5>
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
                @foreach ($main_order as $key => $order_id)
                    @php
                        $order = \App\Order::find($order_id->id);
                    @endphp
                    @if($order != null)
                        <tr>
                            <td>
                                {{ ($key+1) + ($main_order->currentPage() - 1)*$main_order->perPage() }}
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
            {{ $main_order->appends(request()->input())->links() }}
        </div>
    </div-->

    <!-- Xzt Order Display for Admin-->
    <div class="card-body">
        <table class="table aiz-table mb-0 w-100 p-0 m-0" style="font-size:12px; width:100%;">
            <thead>
                <tr>
                    <th style="vertical-align:middle;">Order#</th>
                    <th style="vertical-align:middle;">Dealer</th>
                    <th style="vertical-align:middle;">Grand Total</th>
                    <th style="vertical-align:middle;">Date</th>
                    <th style="vertical-align:middle;">Options</th>
                    <th style="vertical-align:middle;">Delivery Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($main_order as $item)
                <tr>
                    <td style="width:16%;vertical-align:middle;">{{$item->order_no}}</td>
                    <td style="width:16%;vertical-align:middle;">{{$item->user->name}}</td>
                    <td style="vertical-align:middle;">$ {{number_format($item->grand_total, 2, '.', '')}}</td>
                    <td style="vertical-align:middle;">{{$item->created_at}}</td>
                    <td style="vertical-align:middle;">
                        <a href="{{route('seller_orders.get_lineitems', $item->id)}}" class="" title="">Order Items</a>
                    </td>
                    <td>
                        <a href="{{route('seller_orders.main_ord_delivery_note', $item->id)}}" class="" title="">Order Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $main_order->appends(request()->input())->links() }}
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
