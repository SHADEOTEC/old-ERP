@extends('backend.layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp

<div class="card">
    <div class="card-header row gutters-5"> 
        <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6">Order Status</h5>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('seller_orders.status_upd')}}" method="post">
            @csrf
            <div class="form-group">
                <h6>Order Number</h6>
                <p>{{$order->order_no}}</p>
            </div>
            
            <div class="form-group">
                <h6>Total Price</h6>
                <p>$ {{$order->grand_total}}</p>
            </div>

            <div class="form-group">
                <h6>Update Status</h6>
                <select class="form-control" id="status" name="status">
                    <option value="Pending">Pending</option>
                    <option value="Ready">Ready</option>
                    <option value="Processing">Processing</option>
                </select>
            </div>

            <!--div class="form-group">
                <h6>Due Date</h6>
                <input type="text" class="form-control" id="due_date" name="due_date" placeholder="yyyy-mm-dd">
            </div>

            <div class="form-group">
                <h6>Apply Discount%</h6>
                <input type="text" class="form-control" id="dis_percent" name="dis_percent">
            </div-->

            <input type="hidden" class="form-control" id="order_number" name="order_number" value="{{$order->order_no}}">

            <button type="submit" class="btn btn-primary">Update</button>

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
