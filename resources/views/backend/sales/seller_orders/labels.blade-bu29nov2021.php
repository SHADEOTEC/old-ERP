<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delivery Note</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	
	<style>
		#outer_wrapper {
			/* margin-top: 25px; */
			/* border: 1px solid black; */
			font-size: 7px !important;
			padding: 5px;
			margin-left: 5px;
		}
		#bar_code {

		}
		.row .col-xs-2 {
			padding-right: 0 !important;
		}
		h6 {
			padding: 0;
			margin:0;
			font-size: 8px !important;
			font-weight: bold;
		}
		@media print { body { -webkit-print-color-adjust: exact; } }
		@media print {
			.btn {
				visibility: hidden;
			}
		}
	</style>
</head>
<body>
	

<div class="row" id="outer_wrapper">
	<div class="col-xs-6">
		<h6>Shadeotech</h6>
		<div class="row" style="background:black;color:white;">
			<div class="col-xs-2">ORDER#</div>
			<div class="col-xs-2">TAG</div>
			<div class="col-xs-2">DUE</div>
			<div class="col-xs-2">WIDTH</div>
			<div class="col-xs-2">HEIGHT</div>
			<div class="col-xs-2">QUANTITY</div>
		</div>
		<div class="row">
			<div class="col-xs-2">{{$order->order_number}}</div>
			<div class="col-xs-2">{{$order->project_tag}}</div>
			<div class="col-xs-2">{{$order->due_date}}</div>
			<div class="col-xs-2">{{$order->width}} / {{$order->width_decimal}}</div>
			<div class="col-xs-2">{{$order->length}} / {{$order->length_decimal}}</div>
			<div class="col-xs-2">{{$order->quantity}}</div>
		</div>
		<div class="row">
			<div class="col-xs-4" style="font-weight:bold;font-size:9px;">{{$seller->name}}<br> {{date('Y-m-d h:i:s')}}</div>
			<div class="col-xs-4" id="bar_code"></div>
			<div class="col-xs-2">Area(Room):<br> {{$order->room_type}}</div>
			
		</div>
		<div class="row" style="background:black;color:white;">
			<div class="col-xs-2">Mount</div>
			<div class="col-xs-2">Manual/Motor</div>
			<div class="col-xs-2">Channel</div>
			<div class="col-xs-4">Fabric</div>
			<div class="col-xs-2">Config</div>
		</div>
		<div class="row" style="">
			<div class="col-xs-2">{{$order->mount_type}}</div>
			<div class="col-xs-2">{{$order->control_type}}</div>
			<div class="col-xs-2">{{$order->remote_ctrl_channel}}</div>
			<div class="col-xs-4">{{$order->fabric}}</div>	
			@if($order->motor_pos != null)
			<div class="col-xs-2">{{$order->motor_pos}}</div>
			@elseif($order->cord_ctrl != null)
			<div class="col-xs-2">{{$order->cord_ctrl}}</div>
			@elseif($order->chain_ctrl != null)
			<div class="col-xs-2">{{$order->chain_ctrl}}</div>
			@else
			@endif	
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-right" style="margin-top:15px;">
		<a class="btn btn-success" href="#" onclick="window.print()" target="_blank"><i class="fa fa-print"></i> PRINT LABEL</a>
	</div>
</div>

<script src="{{static_asset('assets/js/jquery-barcode.min.js')}}"></script>
<script>
	$("#bar_code").barcode(
		"1234567890128",// Value barcode (dependent on the type of barcode)
		"ean13", // type (string)
		{"barWidth": 2, "barHeight": 20}
	);
	
</script>
</body>
</html>
