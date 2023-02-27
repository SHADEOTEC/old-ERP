@extends('frontend.layouts.user_panel')
@section('panel_content')
<div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Support Ticket') }}</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mx-auto mb-3" >
        <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition" data-toggle="modal" data-target="#ticket_modal">
            <span class="size-70px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
            <i class="las la-plus la-3x text-white"></i>
            </span>
            <div class="fs-20 text-primary">{{ translate('Create a Ticket') }}</div>
        </div>
    </div>
    <div class="col-md-4 mx-auto mb-3" >
        <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition" data-toggle="modal" data-target="#service_req_modal">
            <span class="size-70px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
            <i class="las la-plus la-3x text-white"></i>
            </span>
            <div class="fs-20 text-primary">{{ translate('Service Date & Address') }}</div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{ translate('Tickets')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">{{ translate('Ticket ID') }}</th>
                    <th data-breakpoints="lg">{{ translate('Sending Date') }}</th>
                    <th data-breakpoints="lg">Service Date & Time</th>
                    <th>{{ translate('Subject')}}</th>
                    <th data-breakpoints="xl">Service Description</th>
                    <th data-breakpoints="xl">Service Address</th>
                    <th>{{ translate('Status')}}</th>
                    <th data-breakpoints="lg">{{ translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $key => $ticket)
                <tr>
                    <td>#{{ $ticket->code }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>{{ $ticket->service_date }} {{$ticket->service_time}}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->service_desc }}</td>
                    <td>{{ $ticket->service_addr }}</td>
                    <td>
                        @if (($ticket->tic_status == 'pending') && ($ticket->viewed == 0))
                        <span class="badge badge-inline badge-danger">{{ translate('Pending')}}</span>
                        @elseif (($ticket->viewed == 1) && ($ticket->tic_status == 'pending'))
                        <span class="badge badge-inline badge-success">{{ translate('Viewed')}}</span>
                        @elseif ($ticket->tic_status == 'open')
                        <span class="badge badge-inline badge-secondary">{{ translate('Open')}}</span>
                        @elseif ($ticket->tic_status == 'viewed')
                        <span class="badge badge-inline badge-success">{{ translate('Viewed')}}</span>
                        @else
                        <span class="badge badge-inline badge-success">{{ translate('Solved')}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('support_ticket.show', encrypt($ticket->id))}}" class="btn btn-styled btn-link py-1 px-0 icon-anim text-underline--none">
                        {{ translate('View Details')}}
                        <i class="la la-angle-right text-sm"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $tickets->links() }}
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{ translate('Create a Ticket')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <label>{{ translate('Subject')}}</label>
                        </div>
                        <div class="col-md-10">
                            <select name="subject" id="subject" class="form-control mb-3" required>
                                <option value="Request Installation" selected>Others</option>
                                <option value="Request Installation">Request Installation</option>
                                <option value="Request Service">Request Service</option>
                                <option value="Request Battery Replacement">Request Battery Replacement</option>
                                <option value="Component Defective">Component Defective</option>
                                <option value="Extrusions Defective">Extrusions Defective</option>
                                <option value="Fabric Defective">Fabric Defective</option>
                                <option value="Mislabeled">Mislabeled</option>
                                <option value="Motors Defective">Motors Defective</option>
                                <option value="Ordered Wrong Item">Ordered Wrong Item</option>
                                <option value="Price Adjustment">Price Adjustment</option>
                                <option value="Received Wrong Color">Received Wrong Color</option>
                                <option value="Received Wrong Item">Received Wrong Item</option>
                                <option value="Transportation Damage">Transportation Damage</option>
                                <option value="Wrong Cost">Wrong Cost</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Order Numbers</label>
                        </div>
                        <div class="col-md-10">
                            <select name="order_number" id="order_number" class="form-control mb-3">
                                <option value="">Select Order Number</option>
                                @foreach($orders as $item)
                                <option value="{{$item->order_number}}">{{$item->order_number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>{{ translate('Provide a detailed description')}}</label>
                        </div>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control mb-3" rows="3" name="details" placeholder="{{ translate('Type your reply')}}" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Photo') }}</label>
                        <div class="col-md-10">
                            <!-- <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="attachments" class="selected-files">
                            </div> -->
                            <!-- <div class="file-preview box sm">
                            </div> -->
                            <input type="file" class="form-control" id="photo_defective" name="photo_defective">
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('cancel')}}</button>
                        <button type="submit" class="btn btn-primary">{{ translate('Send Ticket')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="service_req_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">Request for Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form class="" action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <label>Ticket ID</label>
                        </div>
                        <div class="col-md-10">
                            <select name="ticket_number" id="ticket_number" class="form-control mb-3" required>
                                <option value="">Select Ticket ID</option>
                                @foreach($tickets as $item)
                                <option value="{{$item->code}}">{{$item->code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Order Number</label>
                        </div>
                        <div class="col-md-10">
                            <select name="o_number" id="o_number" class="form-control mb-3">
                                <option value="">Select Order Number</option>
                                @foreach($tickets as $item)
                                <option value="{{$item->order_number}}">{{$item->order_number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Description</label>
                        </div>
                        <div class="col-md-10">
                            <textarea class="form-control mb-3" id="service_desc" name="service_desc" placeholder="Service Description" required></textarea>
                        </div>
                    </div>
		            <div class="row">
                        <div class="col-md-2">
                            <label>Address</label>
                        </div>
                        <div class="col-md-10">
                            <textarea class="form-control mb-3" id="service_addr" name="service_addr" placeholder="Service Address" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Date of Service</label>
                        </div>
                        <div class="col-md-10">
                            <input type="date" class="form-control mb-3" id="d_o_s" name="d_o_s" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Time of Service</label>
                        </div>
                        <div class="col-md-10">
                            <input type="time" class="form-control mb-3" id="t_o_s" name="t_o_s" required/>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('cancel')}}</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    <input type="hidden" id="service_req" name="service_req" value="service" class="form-control mb-3" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection