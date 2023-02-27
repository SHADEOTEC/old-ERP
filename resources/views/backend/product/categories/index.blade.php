@extends('backend.layouts.app')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('All categories') }}</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <span>{{ translate('Add New category') }}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-block d-md-flex">
            <h5 class="h6 mb-0">{{ translate('Categories') }}</h5>
        </div>
        <div class="card-body">
            <table class="mb-0 table" id="my-category-table">
                <thead>
                    <tr>
                        <th data-breakpoints="lg">#</th>
                        <th>{{ translate('Name') }}</th>
                        <th data-breakpoints="lg">{{ translate('Parent Category') }}</th>
                        <th data-breakpoints="lg">{{ translate('Order Level') }}</th>
                        <th data-breakpoints="lg">{{ translate('Level') }}</th>
                        <th data-breakpoints="lg">{{ translate('Banner') }}</th>
                        <th data-breakpoints="lg">{{ translate('Icon') }}</th>
                        <th data-breakpoints="lg">{{ translate('Featured') }}</th>
                        <th data-breakpoints="lg">{{ translate('Commission') }}</th>
                        <th width="10%" class="text-center">{{ translate('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @php
                                    $parent = \App\Category::where('id', $category->parent_id)->first();
                                @endphp
                                @if ($parent != null)
                                    {{ $parent->name }}
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $category->order_level }}</td>
                            <td>{{ $category->level }}</td>
                            <td>
                                @if ($category->banner != null)
                                    <img src="{{ uploaded_asset($category->banner) }}" alt="{{ translate('Banner') }}" class="h-50px">
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if ($category->icon != null)
                                    <span class="avatar avatar-square avatar-xs">
                                        <img src="{{ uploaded_asset($category->icon) }}" alt="{{ translate('icon') }}">
                                    </span>
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" onchange="update_featured(this)" value="{{ $category->id }}" <?php if ($category->featured == 1) {
                                        echo 'checked';
                                    } ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td>{{ $category->commision_rate }} %</td>
                            <td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('categories.edit', ['id' => $category->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}" title="{{ translate('Edit') }}">
                                    <i class="las la-edit"></i>
                                </a>
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('categories.destroy', $category->id) }}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
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
        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('categories.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Featured categories updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        $(document).ready(function() {
            let table = new DataTable('#my-category-table', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1]
                }],
            });
        });
    </script>
@endsection
