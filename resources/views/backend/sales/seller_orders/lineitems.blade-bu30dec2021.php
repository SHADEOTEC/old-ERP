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
                    
                </div>
            </div>
            <!-- <div class="col-lg-2">
                <div class="form-group mb-0">
                    <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="seller_id" name="seller_id">
                        
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
            </div> -->
        </div>
    </form>

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
                    <th data-breakpoints="lg" style="vertical-align:middle;text-align:center;">Production</th>
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
                    <td style="vertical-align:middle;">{{$item->product->name}}</td>
                    <!--td style="vertical-align:middle;">{{$item->width}}</td-->
                    <!--td style="vertical-align:middle;">{{$item->length}}</td-->
                    <td style="width:9%;vertical-align:middle;">$ {{number_format($item->total_price, 2, '.', '')}}</td>
                    <td style="vertical-align:middle;">{{$item->status}}</td>
                    <td style="vertical-align:middle;">
                        <a href="{{route('seller_orders.specs', $item->order_number)}}" class="" title="">Details</a>
                    </td>
                    <td style="vertical-align:middle;text-align:center;">
                        @if($item->status == 'Ready')
                        <a href="{{route('seller_orders.delivery_note', $item->id)}}" class="" title="">Delivery Notes</a> | 
                        <a href="{{route('seller_orders.labels', $item->id)}}" class="" title="">Labels</a>
                        @else
                        @endif
                    </td>
                    <td>
                        <a href="{{route('production.index', $item->order_number)}}" class="" title="">Move to order production</a>
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
