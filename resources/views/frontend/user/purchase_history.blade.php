@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Purchase History') }}</h5>
        </div>
        
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Tag/Project Name</th>
                        <th>Quantity</th>
                        <th>Product Name</th>
                        <th>Due Date</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Discount%</th>
                        <th>Final Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pos as $item)
                        <tr style="font-size:10px;" class="text-center">
                            <td style="vertical-align:middle;">{{$item->order_number}}</td>
                            <td style="width:5%;vertical-align:middle;">{{$item->tags}}</td>
                            <td style="width:5%;vertical-align:middle;">{{$item->quantity}}</td>
                            <td style="width:5%;vertical-align:middle;">{{$item->name}}</td>
                            <td style="width:8%;vertical-align:middle;">{{$item->due_date}}</td>
                            <td style="vertical-align:middle;">$ {{$item->total_price + $item->admin_discount}}</td>
                            <td style="width:12%;vertical-align:middle;">@if($item->admin_discount)
                                $ {{$item->admin_discount}}
                                @else
                                0
                                @endif
                            </td>
                            <td style="width:9%;vertical-align:middle;">@if($item->admin_discount_per)
                                {{$item->admin_discount_per}}
                                @else
                                0
                                @endif
                            </td>
                            <td style="vertical-align:middle;">$ {{$item->total_price}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        
        @if (count($orders) > 0)
            <!--<div class="card-body">-->
            <!--    <table class="table aiz-table mb-0">-->
            <!--        <thead>-->
            <!--            <tr>-->
            <!--                <th>{{ translate('Code')}}</th>-->
            <!--                <th data-breakpoints="md">{{ translate('Date')}}</th>-->
            <!--                <th>{{ translate('Amount')}}</th>-->
            <!--                <th data-breakpoints="md">{{ translate('Delivery Status')}}</th>-->
            <!--                <th data-breakpoints="md">{{ translate('Payment Status')}}</th>-->
            <!--                <th class="text-right">{{ translate('Options')}}</th>-->
            <!--            </tr>-->
            <!--        </thead>-->
            <!--        <tbody>-->
            <!--            @foreach ($orders as $key => $order)-->
            <!--                @if (count($order->orderDetails) > 0)-->
            <!--                    <tr>-->
            <!--                        <td>-->
            <!--                            <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>-->
            <!--                        </td>-->
            <!--                        <td>{{ date('d-m-Y', $order->date) }}</td>-->
            <!--                        <td>-->
            <!--                            {{ single_price($order->grand_total) }}-->
            <!--                        </td>-->
            <!--                        <td>-->
            <!--                            {{ translate(ucfirst(str_replace('_', ' ', $order->orderDetails->first()->delivery_status))) }}-->
            <!--                            @if($order->delivery_viewed == 0)-->
            <!--                                <span class="ml-2" style="color:green"><strong>*</strong></span>-->
            <!--                            @endif-->
            <!--                        </td>-->
            <!--                        <td>-->
            <!--                            @if ($order->payment_status == 'paid')-->
            <!--                                <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>-->
            <!--                            @else-->
            <!--                                <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>-->
            <!--                            @endif-->
            <!--                            @if($order->payment_status_viewed == 0)-->
            <!--                                <span class="ml-2" style="color:green"><strong>*</strong></span>-->
            <!--                            @endif-->
            <!--                        </td>-->
            <!--                        <td class="text-right">-->
            <!--                            @if ($order->orderDetails->first()->delivery_status == 'pending' && $order->payment_status == 'unpaid')-->
            <!--                                <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('orders.destroy', $order->id)}}" title="{{ translate('Cancel') }}">-->
            <!--                                   <i class="las la-trash"></i>-->
            <!--                               </a>-->
            <!--                            @endif-->
            <!--                            <a href="javascript:void(0)" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="show_purchase_history_details({{ $order->id }})" title="{{ translate('Order Details') }}">-->
            <!--                                <i class="las la-eye"></i>-->
            <!--                            </a>-->
            <!--                            <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $order->id) }}" title="{{ translate('Download Invoice') }}">-->
            <!--                                <i class="las la-download"></i>-->
            <!--                            </a>-->
            <!--                        </td>-->
            <!--                    </tr>-->
            <!--                @endif-->
            <!--            @endforeach-->
            <!--        </tbody>-->
            <!--    </table>-->
            <!--    <div class="aiz-pagination">-->
            <!--        	{{ $orders->links() }}-->
            <!--  	</div>-->
            <!--</div>-->
        @endif
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')

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
        $('#order_details').on('hidden.bs.modal', function () {
            location.reload();
        })
    </script>

@endsection
