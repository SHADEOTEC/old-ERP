@extends('backend.layouts.app')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('All Dealers') }}</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('backend.sellers.create') }}" class="btn btn-circle btn-info">
                    <span>{{ translate('Add New Dealer') }}</span>
                </a>
            </div>
        </div>
    </div>

    @if (Session::has('alert_del'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('alert_del') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <form class="" id="sort_sellers" action="" method="GET">

            <div class="card-body">
                <table class="mb-0 table" id="my-datatable">
                    <thead>
                        <tr>
                            <th data-breakpoints="lg">#</th>
                            <!-- <th>
                            <div class="form-group">
                                <div class="aiz-checkbox-inline">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-all">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </div>
                        </th> -->
                            <th>{{ translate('Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Phone') }}</th>
                            <th data-breakpoints="lg">{{ translate('Email Address') }}</th>
                            <th data-breakpoints="lg">Website</th>
                            <th>State</th>
                            <th>Discount (%)</th>
                            <th width="10%">{{ translate('Options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $item)
                            <tr>
                                <td style="vertical-align:middle;">{{ $loop->iteration }}</td>
                                <td style="vertical-align:middle;">{{ $item->name }}</td>
                                <td style="vertical-align:middle;">{{ $item->phone }}</td>
                                <td style="vertical-align:middle;">{{ $item->email }}</td>
                                <td style="vertical-align:middle;">{{ $item->website }}</td>
                                <td style="vertical-align:middle;">
                                    @if ($item->state == 1)
                                        <a href="{{ route('sellers.visibility', [$item->id, 0]) }}" class="btn-sm btn-primary">Active</a>
                                    @else
                                        <a href="{{ route('sellers.visibility', [$item->id, 1]) }}" class="btn-sm btn-danger">Inactive</a>
                                    @endif
                                </td>
                                <td style="vertical-align:middle;">{{ $item->discountSeller->disc_percent }}</td>
                                <td style="vertical-align:middle;">
                                    <a href="{{ route('backend.sellers.verify', $item->email) }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Verify"><i class="la la-mail-forward"></i>
                                    </a>
                                    <a href="{{ route('backend.sellers.edit', $item->id) }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Edit"><i class="las la-edit"></i>
                                    </a>
                                    <a href="{{ route('sellers.destroy', $item->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Delete" onclick='return confirm("Are you sure you want to delete this user?")'><i
                                           class="las la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            </from>
    </div>
@endsection

@section('modal')
    <!-- Delete Modal -->
    @include('modals.delete_modal')

    <!-- Seller Profile Modal -->
    <div class="modal fade" id="profile_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="profile-modal-content">

            </div>
        </div>
    </div>

    <!-- Seller Payment Modal -->
    <div class="modal fade" id="payment_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="payment-modal-content">

            </div>
        </div>
    </div>

    <!-- Ban Seller Modal -->
    <div class="modal fade" id="confirm-ban">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">{{ translate('Confirmation') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ translate('Do you really want to ban this seller?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ translate('Cancel') }}</button>
                    <a class="btn btn-primary" id="confirmation">{{ translate('Proceed!') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Unban Seller Modal -->
    <div class="modal fade" id="confirm-unban">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">{{ translate('Confirmation') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ translate('Do you really want to ban this seller?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ translate('Cancel') }}</button>
                    <a class="btn btn-primary" id="confirmationunban">{{ translate('Proceed!') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        $(document).ready(function() {
            let table = new DataTable('#my-datatable', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1]
                }],
                order: [
                    [5, 'asc']
                ],
            });
        });

        function show_seller_payment_modal(id) {
            $.post('{{ route('sellers.payment_modal') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function(data) {
                $('#payment_modal #payment-modal-content').html(data);
                $('#payment_modal').modal('show', {
                    backdrop: 'static'
                });
                $('.demo-select2-placeholder').select2();
            });
        }

        function show_seller_profile(id) {
            $.post('{{ route('sellers.profile_modal') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function(data) {
                $('#profile_modal #profile-modal-content').html(data);
                $('#profile_modal').modal('show', {
                    backdrop: 'static'
                });
            });
        }

        function update_approved(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('sellers.approved') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Approved sellers updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function sort_sellers(el) {
            $('#sort_sellers').submit();
        }

        function confirm_ban(url) {
            $('#confirm-ban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmation').setAttribute('href', url);
        }

        function confirm_unban(url) {
            $('#confirm-unban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmationunban').setAttribute('href', url);
        }

        function bulk_delete() {
            var data = new FormData($('#sort_sellers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-seller-delete') }}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
