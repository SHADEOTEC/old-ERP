@extends('backend.layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp

<div class="card">
    <div class="card-header row gutters-5"> 
        <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6">Order Details</h5>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('seller_orders.status_upd')}}" method="post">
            @csrf
            <div class="form-group">
                <h5>Order Number</h5>
                <p>{{$order->order_number}}</p>
            </div>
            
            <div class="form-group">
                <h5>Dealer Name</h5>
                <p>{{$order->dealer_name}}</p>
            </div>

            <div class="form-group">
                <h5>Total Price</h5>
                <p>{{$order->total_price}}</p>
            </div>

            <div class="form-group">
                <h5>Total Price</h5>
                <p>{{$order->total_price}}</p>
            </div>

            <div class="form-group">
                <h5>Update Status</h5>
                <input type="text" class="form-control" id="status" name="status">
            </div>

            <div class="form-group">
                <h5>Apply Discount%</h5>
                <input type="text" class="form-control" id="dis_percent" name="dis_percent">
            </div>

            <input type="hidden" class="form-control" id="order_number" name="order_number" value="{{$order->order_number}}">

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
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
