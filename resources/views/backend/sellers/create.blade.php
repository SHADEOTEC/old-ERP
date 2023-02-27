@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Add New Dealer')}}</h5>
</div>

<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Dealer Information')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{route('backend.sellers.store')}}" method="POST">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Full Name')}}" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="email">{{translate('Email Address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Email Address')}}" id="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="password">Password</label>
                    <div class="col-sm-9">
                        <input type="password" placeholder="{{translate('Password')}}" id="password" name="password" class="form-control mb-2" required>
                        <span class="message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="password_confirmation">{{translate('Password Confirmation')}}</label>
                    <div class="col-sm-9">
                        <input type="password" placeholder="{{translate('Password Confirmation')}}" id="password_confirmation" name="password_confirmation" class="form-control mb-2" required>
                        <span class="message"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="disc_percent">Discount Percentage</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Discount Percentage" id="disc_percent" name="disc_percent" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="company_name">Company Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Company" id="company_name" name="company_name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="phone">Phone</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Phone" id="phone" name="phone" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="website">Website</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Website" id="website" name="website" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="twitter">Twitter</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Twitter" id="twitter" name="twitter" class="form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="facebook">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Facebook" id="facebook" name="facebook" class="form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="website">Tax ID</label>
                    <div class="form-check d-inline mr-2">
                        <input class="form-check-input" type="radio" name="tax_id" id="rad1" value="nontax" >
                        <label class="form-check-label" for="rad1" style="padding-top:3px;">
                        Exempted
                        </label>
                    </div>
                    <div class="form-check d-inline mr-2">
                        <input class="form-check-input" type="radio" name="tax_id" id="rad2" value="taxable" >
                        <label class="form-check-label" for="rad2" style="padding-top:3px;">
                        Add Sales Tax
                        </label>
                    </div>
                </div>

                <h6 class="pt-2">Shipping Address</h6>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Full Name" id="ship_name" name="ship_name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_phone_num">Phone</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Phone" id="ship_phone_num" name="ship_phone_num" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_addr">Shipping Address</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Shipping Address" id="ship_addr" name="ship_addr" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_addr">Shipping Address 2</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Shipping Address Optional" id="ship_addr2" name="ship_addr2" class="form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_country">Country</label>
                    <div class="col-sm-9">
                        <!--input type="text" placeholder="Country" id="ship_country" name="ship_country" class="form-control" required-->
                        <select id="ship_country" name="ship_country" class="form-control country" required>
                            <option value="">Select Country</option>
                            @foreach($destinations as $item)
                            <option value="{{$item->country}}" data-country="{{$item->country_code}}">{{$item->country}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_city">State</label>
                    <div class="col-sm-9">
                        <!--input type="text" placeholder="City" id="ship_city" name="ship_city" class="form-control" required-->
                        <select id="ship_city" name="ship_city" class="form-control city" required>
                            <option value="">Select State</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_zip">Zip</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Zip" id="ship_zip" name="ship_zip" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="form-check" style="padding-left: 32px;">
                        <input class="form-check-input" type="checkbox" value="1" id="same_address" name="same_address">
                        <label class="form-check-label pt-1" for="same_address">
                        Billing address is same as my shipping address.
                        </label>
                    </div>
                </div>

                <div class="addr_to_bill">
                    <h6 class="pt-3 addr_to_bill">Billing Address</h6>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">Full Name</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Full Name" id="bill_name" name="bill_name" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="bill_email">Email</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Email" id="bill_email" name="bill_email" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="bill_addr">Billing Address</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Billing Address" id="bill_addr" name="bill_addr" class="form-control" >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="bill_addr">Billing Address 2</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Billing Address Optional" id="bill_addr2" name="bill_addr2" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="bill_country">Country</label>
                        <div class="col-sm-9">
                            <!--input type="text" placeholder="Country" id="bill_country" name="bill_country" class="form-control" -->
                            <select id="bill_country" name="bill_country" class="form-control country" >
                                <option value="">Select Country</option>
                                @foreach($destinations as $item)
                                <option value="{{$item->country}}" data-country="{{$item->country_code}}">{{$item->country}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="bill_city">State</label>
                        <div class="col-sm-9">
                            <!--input type="text" placeholder="City" id="bill_city" name="bill_city" class="form-control" -->
                            <select id="bill_city" name="bill_city" class="form-control city" >
                                <option value="">Select State</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="bill_zip">Zip</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Zip" id="bill_zip" name="bill_zip" class="form-control" >
                        </div>
                    </div>
                </div>

                <h6 class="pt-3">Bank Information</h6>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bank_name">Bank Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Bank Name" id="bank_name" name="bank_name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bank_acc_name">Account Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Account Name" id="bank_acc_name" name="bank_acc_name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bank_acc_no">Account Number</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Account Number" id="bank_acc_no" name="bank_acc_no" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bank_routing_no">Bank Routing Number</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Bank Routing Number" id="bank_routing_no" name="bank_routing_no" class="form-control" required>
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
<script>
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

</script>
@endsection