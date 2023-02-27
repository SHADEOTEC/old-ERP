@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Add New Fabric</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('fabric.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Fabric Name" id="name" name="name" class="form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="fab_code">Code</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Fabric Code" id="fab_code" name="fab_code" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="searchcat">Category</label>
                    <div class="col-sm-9">
                        <select name="searchcat" id="searchcat" class="form-control mr-2" style="" required>
                        <option value="">Select Shade</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="searchsubcat">Subcategory</label>
                    <div class="col-sm-9">
                        <select name="searchsubcat" id="searchsubcat" class="form-control mr-2" style="height:42px;" required>
                        <option value="" >Select Subcategory</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Image</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="fabric_image" name="fabric_image" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="form-group form-check ">
                            <input type="checkbox" class="form-check-input" value="Yes" id="show_in_gallery" name="show_in_gallery">
                            <label class="form-check-label pt-1" for="show_in_gallery" style="font-size:0.75rem;">Show in Gallery</label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        
        $('#searchcat').change(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var parent_cat = $('option:selected',this).val();
            jQuery.ajax({
                url: "{{ route('shade.subcat') }}",
                type: 'POST',
                data: {'parent_cat': parent_cat },
                success: function(result){
                        $('#searchsubcat').find('option').remove();
                        $('#searchsubcat').append(result);
                }
            });
        });
    </script>
@endsection