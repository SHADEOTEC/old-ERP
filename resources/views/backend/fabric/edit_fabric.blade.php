@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <h5 class="h6 mb-0">Edit Fabric</h5>
    </div>

    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('fabric.update', $fabric->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="previousUrl" value="{{ $previousUrl }}">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">Name</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Fabric Name" id="name" name="name" class="form-control" value="{{ $fabric->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="fab_code">Code</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Fabric Code" id="fab_code" name="fab_code" class="form-control" value="{{ $fabric->fab_code }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="fab_specs">Specification</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Fabric Specifiaction" id="fab_specs" name="fab_specs" class="form-control" value="{{ $fabric->fab_specs }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="searchcat">Category</label>
                        <div class="col-sm-9">
                            <select name="searchcat" id="searchcat" class="form-control mr-2" style="" required>
                                <option value="">Select Shade</option>
                                @foreach ($categories as $category)
                                    @if ($category->id == $fabric->shade_cat)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="searchsubcat">Subcategory</label>
                        <div class="col-sm-9">
                            <select name="searchsubcat" id="searchsubcat" class="form-control mr-2" style="height:42px;" required>
                                @foreach ($subcategories as $subcategory)
                                    @if ($subcategory->id == $fabric->shade_subcat)
                                        <option value="{{ $subcategory->id }}" selected>{{ $subcategory->name }}</option>
                                    @else
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="fabric_image" name="fabric_image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 d-flex flex-column">
                            <label for="min-width">Minimum Width</label>
                            <input type="number" class="form-control" min="0" value="{{ $fabric->min_width }}" name="min_width" id="min-width" onkeypress="return event.key != '-';">
                        </div>
                        <div class="col-md-6 d-flex flex-column">
                            <label for="max-width">Maximum Width</label>
                            <input type="number" class="form-control" min="0" value="{{ $fabric->max_width }}" name="max_width" id="max-width" onkeypress="return event.key != '-';">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" value="Yes" id="show_in_gallery" name="show_in_gallery" @if ($fabric->show_in_gallery == 'Yes') checked @endif>
                                <label class="form-check-label pt-1" for="show_in_gallery" style="font-size:0.75rem;">Show in Gallery</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
                    $('#searchsubcat').find('option').remove();
                    $('#searchsubcat').append(result);
                }
            });
        });
    </script>
@endsection
