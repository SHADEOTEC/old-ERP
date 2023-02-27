@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Add New Status')}}</h5>
</div>

<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Status Information')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{url('admin/store')}}" method="POST">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Status')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Order Status')}}" id="name" name="name" class="form-control" required>
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
{{-- <script>
$('.country').change(function(e){
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var id = (this.id);
    var country = $('option:selected',this).attr('data-country');
    jQuery.ajax({
        url: "{{ route('seller.states') }}",
        type: 'POST',
        data: {'country': country },
        success: function(result){
            if(id == 'ship_country') {
                $('#ship_city').find('option').not(':first').remove();
                $('#ship_city').append(result);
            }else {
                $('#bill_city').find('option').not(':first').remove();
                $('#bill_city').append(result);
            }
            // $('.city').find('option').not(':first').remove();
            // $('.city').append(result);
            
        }
    });
});

$('#same_address').click(function() {
    $(".addr_to_bill").toggleClass("d-none");
});

$('#password, #password_confirmation').on('keyup', function () {
    if ($('#password').val() == "" && $('#password_confirmation').val() == "") {
        $('.message').html('').css('color', 'green');
    } else {
        if ($('#password').val() == $('#password_confirmation').val()) {
            $('.message').html('Matching').css('color', 'green');
        } else {
            $('.message').html('Not Matching').css('color', 'red');
        }
    }
});

$("form").submit(function(e){
    if ($('#password').val() == "" && $('#password_confirmation').val() == "") {
        e.preventDefault();
        return false;
    } else {
        if ($('#password').val() == $('#password_confirmation').val()) {
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    }
});

</script> --}}
@endsection