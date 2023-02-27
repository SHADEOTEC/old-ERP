@extends('frontend.layouts.user_panel')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('panel_content')
    <div class="card mr-3">
        <div class="card-header row gutters-5">
            <div class="col text-md-left text-center">
                <h5 class="mb-md-0 h6">Order Items</h5>
            </div>
        </div>
        @if (count($orders) > 0)
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table" style="font-size:12px;" id="my-items-table">
                        <thead>
                            <tr class="text-center">
                                <th style="vertical-align:middle;">Order Number</th>
                                <th style="vertical-align:middle;">Product ID</th>
                                <th data-breakpoints="lg" style="vertical-align:middle;">Tags</th>
                                <th style="vertical-align:middle;">Quantity</th>
                                <th style="vertical-align:middle;">Product Name</th>
                                <th data-breakpoints="lg" style="vertical-align:middle;">WidthxLength</th>
                                <th style="vertical-align:middle;">Total Price</th>
                                <th style="vertical-align:middle;">Status</th>
                                <th style="vertical-align:middle;">Date</th>
                                <th style="vertical-align:middle;">Due Date</th>
                                <th style="vertical-align:middle;">Details</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                @php
                                    $ord_date = date_create($item->date);
                                @endphp
                                <tr class="text-center">
                                    <td style="width:18%;vertical-align:middle;">{{ $item->order_number }}</td>
                                    <td style="vertical-align:middle;">{{ $item->product_id }}</td>
                                    <td style="vertical-align:middle;">{{ $item->project_tag }}</td>
                                    <td style="vertical-align:middle;">{{ $item->quantity }}</td>
                                    <td style="vertical-align:middle;">{{ $item->name }}</td>
                                    <td style="vertical-align:middle;">{{ $item->width }}x{{ $item->length }}</td>
                                    <td style="width:9%;vertical-align:middle;">$ {{ $item->total_price }}</td>
                                    <td style="vertical-align:middle;">{{ $mainOrder->status }}</td>
                                    <td style="vertical-align:middle;">{{ date_format($ord_date, 'Y-m-d') }}</td>
                                    <td style="vertical-align:middle;">{{ $item->due_date }}</td>
                                    <td style="vertical-align:middle; min-width: 140px; text-align: start">
                                        <a href="{{ route('orders.details', ['id' => $item->id]) }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="View"><i class="las la-eye"></i></a>

                                        @if ($mainOrder->status === 'Pending')
                                            <a href=" {{ route('orders.edit', ['id' => $item->id]) }} " class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="las la-edit"></i> </a>
                                            <a href="#" onclick="deleteItem('{{ $item->id }}')" data-id="{{ $item->id }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="las la-trash"></i> </a>
                                        @else
                                            <span role="button" href="#" class="btn btn-soft-secondary btn-icon btn-circle btn-sm" title="Please contact admin for any changes in order"> <i class="las la-edit"></i> </span>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
        function show_order_details(order_id) {
            $('#order-details-modal-body').html(null);

            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('orders.details') }}', {
                _token: AIZ.data.csrf,
                order_id: order_id
            }, function(data) {
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }

        function sort_orders(el) {
            $('#sort_orders').submit();
        }

        function deleteItem(id) {
            let totalOrderItemCount = parseInt(`{{ sizeof($orders) }}`);
            if (totalOrderItemCount <= 1) {
                if (confirm("Only one item present inside order. This action will delete whole order. Do you want to continue?")) {
                    window.location.href = `/orders/delete/${id}`;
                }

            } else {
                if (confirm("Do you want to delete item from order")) {
                    window.location.href = `/orders/delete/${id}`;
                }
            }
        }

        $(document).ready(function() {
            let table = new DataTable('#my-items-table', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1]
                }],
            });
        });
    </script>
@endsection
