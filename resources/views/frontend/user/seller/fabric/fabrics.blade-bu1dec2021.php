@extends('frontend.layouts.user_panel')

@section('panel_content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Fabric</h1>
        </div>
        <!-- <div class="col-md-6 text-md-right">
            <a href="{{ route('fabric.add') }}" class="btn btn-circle btn-info">
                <span>Add New Fabric</span>
            </a>
        </div> -->
    </div>
</div>

<div class="card">
    <form class="" id="sort_customers" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-0 h6">Fabric Gallery</h5>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Name & Enter') }}">
                </div>
            </div>
            <div class="col-md-4">
                <form class="" action="" method="GET" >
                    <div class="input-group input-group-sm">
                        <!--input type="text" class="form-control" id="searchcat" name="searchcat" @isset($searchcat) value="{{ $searchcat }}" @endisset placeholder="{{ translate('Search product category') }}"-->
                        <select name="searchcat" id="searchcat" class="form-control" style="height:42px;">
                            <option value="">Select Shade</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="search_hidden" id="search_hidden" value="" />
                        <input type="submit" class="form-control btn btn-danger" value="Search" style="height:42px;"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <ul class="seller_fab_ul">
                @foreach($fabrics as $item)
                <!-- <div class="col col-md-3 col-lg-3 mb-3">
                    <div class="thumbnail_fabric_seller">
                        <img src="{{asset('fabric/images').'/'.$item->url}}" class="img-fluid "/>
                        <p class="text-center pt-2">{{$item->name}}</p>
                    </div>
                </div> -->
                    <li>
                        <p class="text-center" style="width:150px">{{$item->name}}</p>
                        <a href="javascript:void(0)" class="text-center"><img src="{{static_asset('fabric/images').'/'.$item->url}}" class="img-fluid "/></a>
                        <hr>
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="aiz-pagination mt-2">
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
        
        $(document).on("change", ".check-all", function() {
            if(this.checked) {
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
        
        function sort_customers(el){
            $('#sort_customers').submit();
        }
        function confirm_ban(url)
        {
            $('#confirm-ban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmation').setAttribute('href' , url);
        }

        function confirm_unban(url)
        {
            $('#confirm-unban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmationunban').setAttribute('href' , url);
        }
        
        function bulk_delete() {
            var data = new FormData($('#sort_customers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('bulk-customer-delete')}}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
