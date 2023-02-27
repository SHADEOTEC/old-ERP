@extends('backend.layouts.app')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">All Wraps</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('wrapped.add') }}" class="btn btn-circle btn-info">
                    <span>Add New Wrap</span>
                </a>
            </div>
        </div>
    </div>


    <div class="card">
        <form class="" id="sort_customers" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="h6 mb-0">Wraps</h5>
                </div>

            </div>

            <div class="card-body">
                <table class="mb-0 table" id="my-wrap-table">
                    <thead>
                        <tr>
                            <th>Wrapped ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Min. Width</th>
                            <th>Max. Width</th>
                            <th>Price</th>
                            <th>Created</th>
                            <th>State</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wraps as $item)
                            <tr>
                                <td style="vertical-align:middle;">{{ $item->id }}</td>
                                <td style="vertical-align:middle;">{{ $item->wrap_code }}</td>
                                <td style="vertical-align:middle;">{{ $item->name }}</td>
                                <td style="vertical-align:middle;">{{ $item->min_wid }}</td>
                                <td style="vertical-align:middle;">{{ $item->max_wid }}</td>
                                <td style="vertical-align:middle;">$ {{ $item->price }}</td>
                                <td style="vertical-align:middle;">{{ $item->created_at }}</td>
                                <td style="vertical-align:middle;">
                                    @if ($item->state == 'Active')
                                        <a href="{{ route('wrapped.visibility', [$item->id, 'Inactive']) }}" class="btn-sm btn-primary">Active</a>
                                    @else
                                        <a href="{{ route('wrapped.visibility', [$item->id, 'Active']) }}" class="btn-sm btn-danger">Inactive</a>
                                    @endif
                                </td>
                                <td style="vertical-align:middle; min-width: 100px;">
                                    @if ($item->archived == 0)
                                        <a href="{{ route('wrapped.destroy', $item->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Delete" onclick='return confirm("Are you sure you want to delete this item?")'><i
                                               class="las la-trash"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('wrapped.recover', $item->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Recover"><i class="las la-recycle"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('wrapped.edit', $item->id) }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Edit"><i class="las la-edit"></i>
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
            let table = new DataTable('#my-wrap-table', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1]
                }],
            });
        });
    </script>
@endsection
