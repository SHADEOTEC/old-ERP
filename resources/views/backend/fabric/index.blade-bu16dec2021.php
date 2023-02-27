@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
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
    <form class="" id="sort_customers" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-0 h6">Fabric</h5>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Name & Enter') }}">
                </div>
            </div>

            <div class="col-md-3">
                <select name="searchcat" id="searchcat" class="form-control mr-2" style="height:42px;">
                    <option value="">Select Shade</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="searchsubcat" id="searchsubcat" class="form-control mr-2" style="height:42px;" disabled>
                    <option>Subcategory</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="submit" class="form-control btn btn-danger" value="Search" style="height:42px;"/>
            </div>
        </div>
    
        <div class="card-body">
            <table class="table aiz-table mb-0 text-center" style="">
                <thead>
                    <tr>
                        <th>Fabric ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Created</th>
                        <th>Show in Gallery</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fabrics as $item)
                        <tr>
                            <td style="vertical-align:middle;">{{$item->id}}</td>
                            <td style="vertical-align:middle;">{{$item->name}}</td>
                            <td style="vertical-align:middle;">
                                <img src="{{static_asset('fabric/images').'/'.$item->url}}"  width="100px" height="100px" class="img-fluid"/>
                            </td>
                            <td style="vertical-align:middle;">{{$item->created_at}}</td>
                            <td style="vertical-align:middle;">
                                @if($item->show_in_gallery == 'Yes')
                                    <a href="{{route('fabric.visibility', [$item->id, 'No'])}}" class=" btn-sm btn-primary">Visible</a>
                                @else
                                    <a href="{{route('fabric.visibility', [$item->id, 'Yes'])}}" class=" btn-sm btn-danger">Hidden</a>
                                @endif
                                <!--    {{$item->show_in_gallery}}-->
                            </td>
                            <td style="vertical-align:middle;">
                                @if($item->archived == 0)
                                <a href="{{route('fabric.destroy', $item->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm "  title="Delete" onclick='return confirm("Are you sure you want to delete this item?")'><i class="las la-trash"></i>
                                </a>
                                @else
                                <a href="{{route('fabric.recover', $item->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm "  title="Recover"><i class="las la-recycle"></i>
                                </a>
                                @endif
                                <a href="{{route('fabric.edit', $item->id)}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Edit"><i class="las la-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
               {{ $fabrics->appends(request()->input())->links() }}
            </div>
        </div>
    </form>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
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
                    $('#searchsubcat').prop("disabled", false);
                    $('#searchsubcat').find('option').not(':first').remove();
                    $('#searchsubcat').append(result);
                }
            });
        });
        
        // $(document).on("change", ".check-all", function() {
        //     if(this.checked) {
        //         // Iterate each checkbox
        //         $('.check-one:checkbox').each(function() {
        //             this.checked = true;                        
        //         });
        //     } else {
        //         $('.check-one:checkbox').each(function() {
        //             this.checked = false;                       
        //         });
        //     }
          
        // });
        
        // function sort_customers(el){
        //     $('#sort_customers').submit();
        // }
        // function confirm_ban(url)
        // {
        //     $('#confirm-ban').modal('show', {backdrop: 'static'});
        //     document.getElementById('confirmation').setAttribute('href' , url);
        // }

        // function confirm_unban(url)
        // {
        //     $('#confirm-unban').modal('show', {backdrop: 'static'});
        //     document.getElementById('confirmationunban').setAttribute('href' , url);
        // }
        
        // function bulk_delete() {
        //     var data = new FormData($('#sort_customers')[0]);
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: "{{route('bulk-customer-delete')}}",
        //         type: 'POST',
        //         data: data,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function (response) {
        //             if(response == 1) {
        //                 location.reload();
        //             }
        //         }
        //     });
        // }
    </script>
@endsection
