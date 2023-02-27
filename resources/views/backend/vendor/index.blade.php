@extends('backend.layouts.app')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">All Vendors</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('vend_formula.add') }}" class="btn btn-circle btn-info">
                    <span>Add New Vendor</span>
                </a>
            </div>
        </div>
    </div>


    <div class="card">
        <form class="" id="sort_customers" action="" method="GET">
            <div class="card-body">
                <table class="table text-center" style="" id="my-datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vendor</th>
                            <th>Formula</th>
                            <th>Shades</th>
                            <th>Fascia</th>
                            <th>Tube</th>
                            <th>Bottom Rail</th>
                            <th>Bottom Tube</th>
                            <th>Fabric Width</th>
                            <th>Fabric Height</th>
                            <th>State</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $item)
                            <tr>
                                <td style="vertical-align:middle;">{{ $item->id }}</td>
                                <td style="vertical-align:middle;">{{ $item->vendor }}</td>
                                <td style="vertical-align:middle;">{{ $item->formula }}</td>
                                <td style="vertical-align:middle;">{{ $item->shades }}</td>
                                <td style="vertical-align:middle;">{{ $item->fascia }}</td>
                                <td style="vertical-align:middle;">{{ $item->tube }}</td>
                                <td style="vertical-align:middle;">{{ $item->bottom_rail }}</td>
                                <td style="vertical-align:middle;">{{ $item->bottom_tube }}</td>
                                <td style="vertical-align:middle;">{{ $item->fabric_width }}</td>
                                <td style="vertical-align:middle;">{{ $item->fabric_height }}</td>
                                <td style="vertical-align:middle;">
                                    @if ($item->state == 1)
                                        <a href="{{ route('vend_formula.visibility', [$item->id, 0]) }}" class="btn-sm btn-primary">Active</a>
                                    @else
                                        <a href="{{ route('vend_formula.visibility', [$item->id, 1]) }}" class="btn-sm btn-danger">Inactive</a>
                                    @endif
                                </td>
                                <td style="vertical-align:middle;">
                                    @if ($item->archived == 0)
                                        <a href="{{ route('vend_formula.destroy', $item->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Delete" onclick='return confirm("Are you sure you want to delete this item?")'><i
                                               class="las la-trash"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('vend_formula.recover', $item->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Recover"><i class="las la-recycle"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('vend_formula.edit', $item->id) }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Edit"><i class="las la-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
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
                    [10, 'asc']
                ],
            });
        });

        function sort_customers(el) {
            $('#sort_customers').submit();
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
            var data = new FormData($('#sort_customers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-customer-delete') }}",
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
