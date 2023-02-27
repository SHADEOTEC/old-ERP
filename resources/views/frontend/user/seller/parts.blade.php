@extends('frontend.layouts.user_panel')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Parts') }}</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header row gutters-5 align-right">
            <div class="col-md-4 input-group input-group-sm">
                <h5 class="mb-md-0 h6 pr-5">{{ translate('All Parts') }}</h5>
            </div>

        </div>
        <div class="card-body">
            <table class="mb-0 table" id="my-part-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="30%">{{ translate('Name') }}</th>
                        <th>{{ translate('Price') }}</th>
                        <th class="text-right">{{ translate('Buy Now') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($parts as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td> {{ $item->unit_price }} </td>
                            <td class="text-right">
                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{ route('parts.details', ['id' => $item->id]) }}" title="Buy">
                                    <i class="las la-cart-arrow-down"></i>
                                </a>
                            </td>
                        </tr>
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
        $(document).ready(function() {
            let table = new DataTable('#my-part-table', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1]
                }],
            });
        })

        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.seller.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Featured products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Published products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        $('#searchcat').on('change', function() {
            $('#search_hidden').val($('#searchcat option:selected').val());
        });
    </script>
@endsection
