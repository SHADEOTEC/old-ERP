<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delivery Note</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!--style>
		
		body{margin-top:20px;
		background:#eee;
		}
		/**    17. Panel
		*************************************************** **/
		/* pannel */
		.panel {
			position:relative;

			background:transparent;

			-webkit-border-radius: 0;
			-moz-border-radius: 0;
			border-radius: 0;

			-webkit-box-shadow: none;
			-moz-box-shadow: none;
			box-shadow: none;
		}
		.panel.fullscreen .accordion .panel-body,
		.panel.fullscreen .panel-group .panel-body {
			position:relative !important;
			top:auto !important;
			left:auto !important;
			right:auto !important;
			bottom:auto !important;
		}
			
		.panel.fullscreen .panel-footer {
			position:absolute;
			bottom:0;
			left:0;
			right:0;
		}


		.panel>.panel-heading {
			text-transform: uppercase;

			-webkit-border-radius: 0;
			-moz-border-radius: 0;
					border-radius: 0;
		}
		.panel>.panel-heading small {
			text-transform:none;
		}
		.panel>.panel-heading strong {
			font-family:Arial,Helvetica,Sans-Serif;
		}
		.panel>.panel-heading .buttons {
			display:inline-block;
			margin-top:-3px;
			margin-right:-8px;
		}
		.panel-default>.panel-heading {
			padding: 15px 15px;
			background:#fff;
		}
		.panel-default>.panel-heading small {
			color:#9E9E9E;
			font-size:12px;
			font-weight:400;
		}
		.panel-clean {
			border: 1px solid #ddd;
			border-bottom: 3px solid #ddd;

			-webkit-border-radius: 0;
			-moz-border-radius: 0;
					border-radius: 0;
		}
		.panel-clean>.panel-heading {
			padding: 11px 15px;
			background:#fff !important;
			color:#000;	
			border-bottom: #eee 1px solid;
		}
		.panel>.panel-heading .btn {
			margin-bottom: 0 !important;
		}

		.panel>.panel-heading .progress {
			background-color:#ddd;
		}

		.panel>.panel-heading .pagination {
			margin:-5px;
		}

		.panel-default {
			border:0;
		}

		.panel-light {
			border:rgba(0,0,0,0.1) 1px solid;
		}
		.panel-light>.panel-heading {
			padding: 11px 15px;
			background:transaprent;
			border-bottom:rgba(0,0,0,0.1) 1px solid;
		}

		.panel-heading a.opt>.fa {
			display: inline-block;
			font-size: 12px;
			font-style: normal;
			font-weight: normal;
			margin-right: 2px;
			padding: 5px;
			position: relative;
			text-align: right;
			top: -1px;
		}

		.panel-heading>label>.form-control {
			display:inline-block;
			margin-top:-8px;
			margin-right:0;
			height:30px;
			padding:0 15px;
		}
		.panel-heading ul.options>li>a {
			color:#999;
		}
		.panel-heading ul.options>li>a:hover {
			color:#333;
		}
		.panel-title a {
			text-decoration:none;
			display:block;
			color:#333;
		}

		.panel-body {
			background-color:#fff;
			padding: 15px;

			-webkit-border-radius: 0;
			-moz-border-radius: 0;
					border-radius: 0;
		}
		.panel-body.panel-row {
			padding:8px;
		}

		.panel-footer {
			font-size:12px;
			border-top:rgba(0,0,0,0.02) 1px solid;
			background-color:rgba(0255,255,255,1);

			-webkit-border-radius: 0;
			-moz-border-radius: 0;
					border-radius: 0;
		}
	</style-->
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
			<div class="col-xs-2">WIDTH</div>
			<div class="col-xs-2">HEIGHT</div>
			<div class="col-xs-2">QUANTITY</div>
			<div class="col-xs-2">FABRIC</div>
		</div>
		<div class="row">
			<div class="col-xs-2">{{$order->order_number}}</div>
			<div class="col-xs-2">{{$order->project_tag}}</div>
			<div class="col-xs-2">{{$order->width}} / {{$order->width_decimal}}</div>
			<div class="col-xs-2">{{$order->length}} / {{$order->length_decimal}}</div>
			<div class="col-xs-2">{{$order->quantity}}</div>
			<div class="col-xs-2">{{$order->fabric}}</div>	
		</div>
		<div class="row">
			<div class="col-xs-2">{{$seller->name}}</div>
			<div class="col-xs-2"></div>
			<div class="col-xs-2" id="bar_code"></div>
			<div class="col-xs-2"></div>
			<div class="col-xs-2">{{$order->room_type}}</div>
			
		</div>
		<div class="row" style="background:black;color:white;">
			<div class="col-xs-2">Mount</div>
			<div class="col-xs-2">{{$order->mount_type}}</div>
			<div class="col-xs-2">Manual/Motor</div>
			<div class="col-xs-2">{{$order->control_type}}</div>
			<div class="col-xs-2">Channel</div>
			<div class="col-xs-2">{{$order->remote_ctrl_channel}}</div>
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
