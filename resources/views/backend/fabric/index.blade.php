@extends('backend.layouts.app')

@section('mystyles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">All Fabric</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('fabric.add') }}" class="btn btn-circle btn-info">
                    <span>Add New Fabric</span>
                </a>
            </div>
        </div>
    </div>


    <div class="card">

        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="h6 mb-0">Fabric Gallery</h5>
            </div>
            <div class="col-md-3">

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
                        <input type="submit" class="form-control btn btn-danger" value="Filter" style="height:42px;" />
                </form>
            </div>
        </div>


        <div class="card-body">
            <table class="mb-0 table" id="my-datatable">
                <thead>
                    <tr>
                        <th>Fabric ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Max Width</th>
                        <th>Image</th>
                        <th>Created</th>
                        <th>Show in Gallery</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fabrics as $item)
                        <tr>
                            <td style="vertical-align:middle;">{{ $item->id }}</td>
                            <td style="vertical-align:middle;">{{ $item->name }}</td>
                            <td style="vertical-align:middle;">{{ $item->fab_code }}</td>
                            <td style="vertical-align:middle;">{{ $item->max_width ? $item->max_width : "N/A" }}</td>
                            <td style="vertical-align:middle;">
                                <img src="{{ static_asset('fabric/images') . '/' . $item->url }}" width="100px" height="100px" />
                            </td>
                            <td style="vertical-align:middle;">{{ $item->created_at }}</td>
                            <td style="vertical-align:middle;">
                                @if ($item->show_in_gallery == 'Yes')
                                    <a href="{{ route('fabric.visibility', [$item->id, 'No']) }}" class="btn-sm btn-primary">Visible</a>
                                @else
                                    <a href="{{ route('fabric.visibility', [$item->id, 'Yes']) }}" class="btn-sm btn-danger">Hidden</a>
                                @endif
                                <!--    {{ $item->show_in_gallery }}-->
                            </td>
                            <td style="vertical-align:middle;">
                                @if ($item->archived == 0)
                                    <a href="{{ route('fabric.destroy', $item->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Delete" onclick='return confirm("Are you sure you want to delete this item?")'><i
                                           class="las la-trash"></i>
                                    </a>
                                @else
                                    <a href="{{ route('fabric.recover', $item->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Recover"><i class="las la-recycle"></i>
                                    </a>
                                @endif
                                <a href="{{ route('fabric.edit', $item->id) }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Edit"><i class="las la-edit"></i>
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

    <script>
        $(document).ready(function() {
            let table = new DataTable('#my-datatable', {
                columnDefs: [{
                    orderable: false,
                    targets: [-1, -4]
                }],
                order: [
                    [0, 'desc']
                ],
                stateSave: true,
            });

            if ($('#searchcat').val()) {
                $('#searchcat').change();
            }


        })

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
    </script>
@endsection
