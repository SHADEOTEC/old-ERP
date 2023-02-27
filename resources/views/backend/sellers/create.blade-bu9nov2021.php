@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Add New Dealer')}}</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Dealer Information')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('sellers.store') }}" method="POST">
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
                    <label class="col-sm-3 col-from-label" for="password">{{translate('Password')}}</label>
                    <div class="col-sm-9">
                        <input type="password" placeholder="{{translate('Password')}}" id="password" name="password" class="form-control" required>
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
                    <label class="col-sm-3 col-from-label" for="website">Tac ID</label>
                    <div class="form-check d-inline mr-2">
                        <input class="form-check-input" type="radio" name="tac_id" id="rad1" value="nontax">
                        <label class="form-check-label" for="rad1">
                        Exempted
                        </label>
                    </div>
                    <div class="form-check d-inline mr-2">
                        <input class="form-check-input" type="radio" name="tac_id" id="rad2" value="taxable">
                        <label class="form-check-label" for="rad2">
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
                    <label class="col-sm-3 col-from-label" for="ship_email">Email</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Email" id="ship_email" name="ship_email" class="form-control" required>
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
                            <option value="{{$item->country_code}}">{{$item->country}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_city">City</label>
                    <div class="col-sm-9">
                        <!--input type="text" placeholder="City" id="ship_city" name="ship_city" class="form-control" required-->
                        <select id="ship_city" name="ship_city" class="form-control city" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="ship_zip">Zip</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Zip" id="ship_zip" name="ship_zip" class="form-control" required>
                    </div>
                </div>

                <h6 class="pt-3">Billing Address</h6>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Full Name" id="bill_name" name="bill_name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bill_email">Email</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Email" id="bill_email" name="bill_email" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bill_addr">Billing Address</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Billing Address" id="bill_addr" name="bill_addr" class="form-control" required>
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
                        <!--input type="text" placeholder="Country" id="bill_country" name="bill_country" class="form-control" required-->
                        <select id="bill_country" name="bill_country" class="form-control country" required>
                            <option value="">Select Country</option>
                            @foreach($destinations as $item)
                            <option value="{{$item->country_code}}">{{$item->country}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bill_city">City</label>
                    <div class="col-sm-9">
                        <!--input type="text" placeholder="City" id="bill_city" name="bill_city" class="form-control" required-->
                        <select id="bill_city" name="bill_city" class="form-control city" required>
                            <option value="">Select City</option>
                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="bill_zip">Zip</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Zip" id="bill_zip" name="bill_zip" class="form-control" required>
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
    var country = $('option:selected',this).val();
    jQuery.ajax({
        url: "{{ route('seller.states') }}",
        type: 'POST',
        data: {'country': country },
        success: function(result){
            $('.city').find('option').not(':first').remove();
            $('.city').append(result);
            
        }
    });
});
</script>
@endsection