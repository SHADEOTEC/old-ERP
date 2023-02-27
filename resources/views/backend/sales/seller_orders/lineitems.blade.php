@extends('backend.layouts.app')

@section('content')
    @php
        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
    @endphp

    <div class="card">
        <form class="" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col text-md-left text-center">
                    <h5 class="mb-md-0 h6">{{ translate('Dealer Orders') }}</h5>
                </div>
                <div class="col-lg-2">
                    <div class="form-group mb-0">

                    </div>
                </div>
                <!-- <div class="col-lg-2">
                            <div class="form-group mb-0">
                                <select class="form-control form-control-sm aiz-selectpicker mb-md-0 mb-2" id="seller_id" name="seller_id">
                                    
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
            <table class="aiz-table w-100 m-0 mb-0 table p-0" style="font-size:12px; width:100%;">
                <thead>
                    <tr>
                        <th style="vertical-align:middle;">Item#</th>
                        <th style="vertical-align:middle;">Date</th>
                        <!--th style="vertical-align:middle;">Product ID</th-->
                        <th data-breakpoints="lg" style="vertical-align:middle;">Dealer Name</th>
                        <!--th style="vertical-align:middle;">Tags</th-->
                        <th style="vertical-align:middle;">Quantity</th>
                        <th style="vertical-align:middle;">Product Name</th>
                        <!--th style="vertical-align:middle;">Width</th-->
                        <!--th style="vertical-align:middle;">Length</th-->
                        <th style="vertical-align:middle;">Total Price</th>
                        <th style="vertical-align:middle;">Details</th>
                        <th style="vertical-align:middle;text-align:center;">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr class="table-row-each-order-item">
                            <td style="width:16%;vertical-align:middle;">{{ $item->order_number }}</td>
                            <!--td style="vertical-align:middle;">{{ $item->product_id }}</td-->
                            <td style="vertical-align:middle;">{{ $item->date }}</td>
                            <td style="vertical-align:middle;">{{ $item->dealer_name }}</td>
                            <td style="vertical-align:middle;">{{ $item->quantity }}</td>
                            <td style="vertical-align:middle;">{{ $item->product->name }}</td>
                            <!--td style="vertical-align:middle;">{{ $item->width }}</td-->
                            <!--td style="vertical-align:middle;">{{ $item->length }}</td-->
                            <td style="width:9%;vertical-align:middle;">$ {{ number_format($item->total_price, 2, '.', '') }}</td>
                            <td style="vertical-align:middle;">
                                <a href="{{ route('seller_orders.specs', $item->order_number) }}" class="" title="">Details</a>
                            </td>
                            <td style="vertical-align:middle;text-align:center;white-space: nowrap;">
                                @if ($item->status != 'Pending')
                                    <a href="{{ route('seller_orders.delivery_note', $item->id) }}" class="" title="" target="_blank" >Delivery Notes</a> |
                                    <a href="{{ route('seller_orders.labels', $item->id) }}" class="" title="" target="_blank" >Labels</a>
                                @else
                                    <a href=" {{ route('seller_orders.orders.edit', ['id' => $item->id]) }} " class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="las la-edit"></i> </a>
                                    <a href="#" onclick="deleteItem('{{ $item->id }}')" data-id="{{ $item->id }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="las la-trash"></i> </a>
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
        function sort_orders(el) {
            $('#sort_orders').submit();
        }

        function deleteItem(id) {
            let totalItemsCount = $(".table-row-each-order-item").length;
            if (totalItemsCount <= 1) {
                if (confirm("You have only one item in order. This will delete your whole order. Do you want to delete this order?")) {
                    window.location.href = `/orders/delete/${id}`;
                }
            } else {
                if (confirm("Do you want to delete item from order")) {
                    window.location.href = `/orders/delete/${id}`;
                }
            }
        }
    </script>
@endsection
