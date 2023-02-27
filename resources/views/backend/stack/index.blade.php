@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Stacks</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('stack.add') }}" class="btn btn-circle btn-info">
                <span>Add New Stack</span>
            </a>
        </div>
    </div>
</div>


<div class="card">
    <form class="" id="sort_customers" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-0 h6">Stacks</h5>
            </div>
            
            <!-- <div class="dropdown mb-2 mb-md-0">
                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                    {{translate('Bulk Action')}}
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" onclick="bulk_delete()">{{translate('Delete selection')}}</a>
                </div>
            </div> -->
            
            <div class="col-md-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Name & Enter') }}">
                </div>
            </div>
        </div>
    
        <div class="card-body">
            <table class="table aiz-table mb-0 text-center" style="">
                <thead>
                    <tr>
                        <th>Stack ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Image</th>
                        <th>Created</th>
                        <th>State</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stacks as $item)
                        <tr>
                            <td style="vertical-align:middle;">{{$item->id}}</td>
                            <td style="vertical-align:middle;">{{$item->name}}</td>
                            <td style="vertical-align:middle;">{{$item->position}}</td>
                            <td style="vertical-align:middle;">
                                <img src="{{asset('public/stack/images').'/'.$item->image}}"  width="100px" height="100px" class=""/>
                            </td>
                            <td style="vertical-align:middle;">{{$item->created_at}}</td>
                            <td style="vertical-align:middle;">
                                @if($item->state == 'Active')
                                    <a href="{{route('stack.visibility', [$item->id, 'Inactive'])}}" class=" btn-sm btn-primary">Active</a>
                                @else
                                    <a href="{{route('stack.visibility', [$item->id, 'Active'])}}" class=" btn-sm btn-danger">Inactive</a>
                                @endif
                            </td>
                            <td style="vertical-align:middle;">
                                @if($item->archived == 0)
                                <a href="{{route('stack.destroy', $item->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm "  title="Delete" onclick='return confirm("Are you sure you want to delete this item?")'><i class="las la-trash"></i>
                                </a>
                                @else
                                <a href="{{route('stack.recover', $item->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm "  title="Recover"><i class="las la-recycle"></i>
                                </a>
                                @endif
                                <a href="{{route('stack.edit', $item->id)}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Edit"><i class="las la-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
               {{ $stacks->appends(request()->input())->links() }}
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
