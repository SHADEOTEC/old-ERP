@extends('backend.layouts.app')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    @php
        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
    @endphp

    <div class="card">
        <form class="" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col text-md-left text-center">
                    <h5 class="mb-md-0 h6">Orders</h5>
                </div>
                <div class="col-lg-2">
                </div>
                <div class="col-lg-2">
                    <div class="form-group mb-0">
                        <select class="form-control form-control-sm aiz-selectpicker mb-md-0 mb-2" id="seller_id" name="seller_id">
                            <option value="">{{ translate('All Dealers') }}</option>
                            @foreach ($sellers as $item)
                                <option value="{{ $item->id }}" @if ($seller_id == $item->id) selected @endif>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
                    </div>
                </div>
            </div>
        </form>


        <!-- Xzt Order Display for Admin-->
        <div class="card-body">
            <table class="m-0 mb-0 table p-0" id="main-order-table" style="font-size:12px; width:100%;">
                <thead>
                    <tr>
                        <th style="vertical-align:middle;">Order#</th>
                        <th style="vertical-align:middle;">Status</th>
                        <th style="vertical-align:middle;">Dealer</th>
                        <th>Tag</th>
                        <th style="vertical-align:middle;">Grand Total</th>
                        <th style="vertical-align:middle;">Date</th>
                        <th style="vertical-align:middle;">Options</th>
                        <th style="vertical-align:middle;">Delivery Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($main_order as $item)
                        <tr>
                            <td style="vertical-align:middle;">
                                <a href="#" class="" title="" data-toggle="modal" data-target="#edit-model-order-{{ $item->id }}">{{ $item->order_no }}</a>
                            </td>
                            <td style="vertical-align:middle;">{{ $item->status }}</td>
                            <td style="vertical-align:middle;">{{ $item->user->name }}</td>
                            <td style="vertical-align:middle;">{{ $item->xztcarts[0]['project_tag'] }}</td>
                            <td style="vertical-align:middle;">$ {{ number_format($item->grand_total, 2, '.', '') }}</td>
                            <td style="vertical-align:middle;">{{ $item->created_at }}</td>
                            <td style="vertical-align:middle;">
                                <a href="{{ route('seller_orders.get_lineitems', $item->id) }}" class="" title="">Order Items</a>
                                |
                                <a href="{{ route('production.items', $item->id) }}" class="" title="">Production</a>
                                |
                                <a href="{{ route('production.view', $item->id) }}" class="" title="" target="_blank">View</a>
                                |
                                <a href="{{ route('orders.labels.all', $item->id) }}" target="_blank">Labels</a>
                            </td>
                            <td>
                                @if ($item->status != 'Pending')
                                    <a href="{{ route('seller_orders.main_ord_delivery_note', $item->id) }}" class="" title="">View Note</a>
                                @endif
                            </td>
                        </tr>

                        <div class="modal fade" id="edit-model-order-{{ $item->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="card">
                                        <div class="card-header row gutters-5">
                                            <div class="col text-md-left text-center">
                                                <h5 class="mb-md-0 h6">Order Status</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('seller_orders.status_upd') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <h6>Order Number</h6>
                                                    <p>{{ $item->order_no }}</p>
                                                </div>

                                                <div class="form-group">
                                                    <h6>Total Price</h6>
                                                    <p>$ {{ $item->grand_total }}</p>
                                                </div>

                                                <div class="form-group">
                                                    <h6>Update Status</h6>
                                                    <select class="form-control" id="status" name="status">
                                                        @foreach($order_status as $status)
                                                        <option value="{{ $status->name }}" @if ($item->status == $status->name) selected @endif>{{ $status->name }}</option>
                                                        @endforeach
                                                        {{-- <option @if ($item->status === 'Lead') selected @endif value="Lead">Lead</option>
                                                        <option @if ($item->status === 'Pending') selected @endif value="Pending">Pending</option>
                                                        <option @if ($item->status === 'Processing') selected @endif value="Processing">Processing</option>
                                                        <option @if ($item->status === 'Ready') selected @endif value="Ready">Ready for Pickup</option>
                                                        <option @if ($item->status === 'Paid') selected @endif value="Paid">Paid</option>
                                                        <option @if ($item->status === 'Installed') selected @endif value="Installed">Installed</option>
                                                        <option @if ($item->status === 'waiting') selected @endif value="waiting">Waiting for the Payment</option> --}}
                                                    </select>
                                                </div>

                                                <input type="hidden" class="form-control" id="order_number" name="order_number" value="{{ $item->order_no }}">

                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        function sort_orders(el) {
            $('#sort_orders').submit();
        }

        $(document).ready(function() {
            let table = new DataTable('#main-order-table', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1, -2]
                }],
                order: [
                    [0, 'desc']
                ],
            });
        })
    </script>
@endsection
