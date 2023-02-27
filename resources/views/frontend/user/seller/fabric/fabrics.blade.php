@extends('frontend.layouts.user_panel')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <style>
        .seller_fab_ul li:has(a:hover) {
            z-index: 1;
        }

        .fab-img:hover {
            transform-origin: center;
            scale: 1.5;
        }
    </style>
@endsection


@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">All Fabric</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <form class="" id="sort_customers" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="h6 mb-0">Fabric Gallery</h5>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-0">
                    </div>
                </div>
                <div class="col-md-6">
                    <form class="" action="" method="GET">
                        <div class="input-group input-group-sm">
                            <select name="searchcat" id="searchcat" class="form-control mr-2" style="height:42px;">
                                <option value="">Select Shade</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($searchcat && $searchcat == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <select name="searchsubcat" id="searchsubcat" @if ($searchsubcat) data-selected="{{ $searchsubcat }}" @endif class="form-control mr-2" style="height:42px;">
                                <option value="">Subcategory</option>
                            </select>
                            <input type="hidden" name="search_hidden" id="search_hidden" value="" />
                            <input type="submit" class="form-control btn btn-danger" value="Search" style="height:42px;" />
                    </form>
                </div>
            </div>
    </div>

    <div class="card-body">
        <table class="mb-0 table" id="my-datatable">
            <thead>
                <tr>
                    <th style="width: 14%">Fabric ID</th>
                    <th style="width: 14%">Name</th>
                    <th style="width: 14%">Code</th>
                    <th style="width: 14%">Image</th>
                    <th style="width: 14%">Created</th>
                    <th style="width: 14%">Category</th>
                    <th>Min-Max Width</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fabrics as $item)
                    <tr>
                        <td style="vertical-align:middle;">{{ $item->id }}</td>
                        <td style="vertical-align:middle;">{{ $item->name }}</td>
                        <td style="vertical-align:middle;">{{ $item->fab_code }}</td>
                        <td style="vertical-align:middle;">
                            <img src="{{ static_asset('fabric/images') . '/' . $item->url }}" class="fab-img" width="100px" height="100px" />
                        </td>
                        <td style="vertical-align:middle;">{{ $item->created_at }}</td>
                        <td style="vertical-align:middle;">
                            {{ optional($item->sub_category)->name }}
                        </td>
                        <td style="vertical-align:middle;">
                            {{ $item->min_width ? $item->min_width : 'N/A' }}-{{ $item->max_width ? $item->max_width : 'N/A' }} in
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
        $('#searchcat').change(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var parent_cat = $('option:selected', this).val();
            jQuery.ajax({
                url: "{{ route('shade.subcat') }}",
                type: 'POST',
                data: {
                    'parent_cat': parent_cat
                },
                success: function(result) {
                    $('#searchsubcat').find('option').not(':first').remove();
                    $('#searchsubcat').append(result);
                    if ($('#searchsubcat').data("selected")) {
                        let d = $('#searchsubcat').data("selected");
                        $('#searchsubcat').find(`option[value='${d}']`).prop("selected", true);
                    }
                }
            });
        });

        $(document).ready(function() {

            let table = new DataTable('#my-datatable', {
                columnDefs: [{
                    orderable: false,
                    targets: [-4]
                }],
                order: [
                    [0, 'desc']
                ],
            });

            if ($('#searchcat').val()) {
                $('#searchcat').change();
            }
        })
    </script>
@endsection
