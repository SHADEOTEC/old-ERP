@extends('backend.layouts.app')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">All Parts</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('parts.admin.create') }}" class="btn btn-circle btn-info">
                    <span>Add New Part</span>
                </a>
            </div>
        </div>
    </div>


    <div class="card">
        <form class="" id="sort_customers" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="h6 mb-0">Parts</h5>
                </div>
            </div>

            <div class="card-body">
                <table class="mb-0 table text-center" style="" id="my-part-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>State</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parts as $item)
                            <tr>
                                <td style="vertical-align:middle;">{{ $item->id }}</td>
                                <td style="vertical-align:middle;">{{ $item->part_code }}</td>
                                <td style="vertical-align:middle;">{{ $item->name }}</td>
                                <td style="vertical-align:middle;">$ {{ $item->unit_price }}</td>
                                <td style="vertical-align:middle;">
                                    <img src="{{ asset('public/parts/images') . '/' . $item->thumbnail_img }}" width="100px" height="100px" class="" />
                                </td>
                                <td style="vertical-align:middle;">{{ $item->created_at }}</td>
                                <td style="vertical-align:middle;">
                                    @if ($item->state == 'Active')
                                        <a href="{{ route('parts.admin.visibility', [$item->id, 'Inactive']) }}" class="btn-sm btn-primary">Active</a>
                                    @else
                                        <a href="{{ route('parts.admin.visibility', [$item->id, 'Active']) }}" class="btn-sm btn-danger">Inactive</a>
                                    @endif
                                </td>
                                <td style="vertical-align:middle;">
                                    @if ($item->archived == 0)
                                        <a href="{{ route('parts.admin.destroy', $item->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Delete" onclick='return confirm("Are you sure you want to delete this item?")'><i
                                               class="las la-trash"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('parts.admin.recover', $item->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Recover"><i class="las la-recycle"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('parts.admin.edit', $item->id) }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Edit"><i class="las la-edit"></i>
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

    <script>
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

        $(document).ready(function() {
            let table = new DataTable('#my-part-table', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1, -4]
                }],
            });
        });
    </script>
@endsection
