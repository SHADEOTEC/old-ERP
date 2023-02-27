@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">Production</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('coupon.add') }}" class="btn btn-circle btn-info">
                <span>Order Production</span>
            </a>
        </div>
    </div>
</div>


<div class="card">
    <form class="" id="sort_customers" action="" method="GET">
        <div class="card-header row gutters-5">
            <!-- <div class="col">
                <h5 class="mb-0 h6">Coupons</h5>
            </div> -->
            
            <!-- <div class="dropdown mb-2 mb-md-0">
                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                    {{translate('Bulk Action')}}
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" onclick="bulk_delete()">{{translate('Delete selection')}}</a>
                </div>
            </div> -->
            
            <!-- <div class="col-md-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Name & Enter') }}">
                </div>
            </div> -->
        </div>
    
        <div class="card-body">
            <table class="table aiz-table mb-0 text-center" style="">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Width</th>
                        <th>Length</th>
                        <th>Formula</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td style="vertical-align:middle;">{{$order->order_number}}</td>
                        <td style="vertical-align:middle;width:20%;">
                            <input type="text" id="width" class="form-control text-center measures" value="{{$order->width + $order->width_decimal}}">
                        </td>
                        <td style="vertical-align:middle;width:20%;">
                            <input type="text" id="length" class="form-control text-center measures" value="{{$order->length + $order->length_decimal}}">
                        </td>
                        <td>
                            <select class="form-control" name="formula" id="formula" required>
                                <option value="">Select Formula</option>
                                @foreach($vendor as $item)
                                <option value="{{$item->id}}" >{{$item->vendor}}-{{$item->formula}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-from-label">Shade</label>
                    <input class="form-control" type="text" id="shade" name="shade"/>
                </div>
                <div class="col-6">
                    <label class="col-from-label">Fascia</label>
                    <input  class="form-control" type="text" id="fascia" name="fascia"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-from-label">Tube</label>
                    <input  class="form-control" type="text" id="tube" name="tube"/>
                </div>
                <div class="col-6">
                    <label class="col-from-label">Bottom Rail</label>
                    <input class="form-control"  type="text" id="bot_rail" name="bot_rail"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-from-label">Bottom Tube</label>
                    <input class="form-control"  type="text" id="bot_tube" name="bot_tube"/>
                </div>
                <div class="col-6">
                    <label class="col-from-label">Fabric Width</label>
                    <input class="form-control"  type="text" id="fab_width" name="fab_width"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-from-label">Fabric Height</label>
                    <input class="form-control"  type="text" id="fab_height" name="fab_height"/>
                </div>
            </div>
            <div class="aiz-pagination">
               
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
        
        $(document).on('change', '#formula', function (e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var vendor_id = $('#formula option:selected').val() ? $('#formula option:selected').val():0;
            var width = $('#width').val() ? $('#width').val():0;
            var length = $('#length').val() ? $('#length').val():0;
            $.ajax({
                url:"{{route('production.apply_formula')}}",
                type: "post",
                data: {vendor_id: vendor_id, width: width, length: length},
                success:function(result){
                    $('#shade').val(result.shades);
                    $('#fascia').val(result.fascia);
                    $('#tube').val(result.tube);
                    $('#bot_rail').val(result.bottom_rail);
                    $('#bot_tube').val(result.bottom_tube);
                    $('#fab_width').val(result.fabric_width);
                    $('#fab_height').val(result.fabric_height);
                },
                error:function(){
                }
            });
        });

        $(document).on('keydown', ".measures", function(e) {
            $("#formula option").prop("selected", false);
        });

    </script>
@endsection






