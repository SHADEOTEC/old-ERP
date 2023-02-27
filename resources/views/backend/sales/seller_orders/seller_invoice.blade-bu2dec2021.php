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
	</style>
</head>
<body>
	
<div class="container bootstrap snippets bootdey">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4 col-sm-4 text-left">
					<h4><strong>DELIVERY NOTE</h4>
					<ul class="list-unstyled" style="font-weight:400;">
						<li><strong>Country:</strong> US, Carrollton TX 25006</li>
						<li><strong>Address:</strong> 3333 Earhart Dr. Unit 240</li>
						<li><strong>Tel:</strong> 469-499-3322</li>
						<li><strong>Fax:</strong> 469-499-3323</li>
						<li><strong>Email:</strong> info@shadeotech.com</li>
						<li><strong>Web:</strong> www.shadeotech.com</li>
					</ul>
				</div>

				<div class="col-md-4 col-sm-4 text-center">
					<img src="{{static_asset('assets/img/logo-big.png')}}" width="200px" height="125px"/>
				</div>

				<div class="col-md-4 col-sm-4 text-right">
					<h4><strong>Order</strong></h4>
					<ul class="list-unstyled" style="font-weight:400;">
						<li><strong>Order Date:</strong> {{$order->date}}</li>
						<li><strong>Order Number:</strong> {{$order->order_number}}</li>
						<li><strong>Order Delivery:</strong> {{$order->due_date}}</li>
					</ul>
				</div>
			</div>
			<div class="row" style="background:#e1d5d547;padding: 16px 0px 8px 0px;">
				<div class="col-md-6 col-sm-6 text-left">
					<ul class="list-unstyled" style="font-weight:400;">
						<li><strong>Ship To:</strong> {{$order->project_tag}}</li>
						<li><strong>Country/City:</strong> {{$ship->ship_country}}/{{$ship->ship_city}}</li>
						<li><strong>Address:</strong> {{$ship->ship_addr}}, {{$ship->ship_addr2}}</li>
						<li><strong>Zip:</strong> {{$ship->ship_zip}}</li>
						<li><strong>Email:</strong> {{$ship->ship_email}}</li>
					</ul>
				</div>

				<div class="col-md-6 col-sm-6 text-right">
					<ul class="list-unstyled" style="font-weight:400;">
						<li><strong>Side Mark:</strong> {{$csm->cs_mark}}</li>
						<li><strong>Tel:</strong> {{$seller->phone}}</li>
						<li><strong>Email:</strong> {{$seller->email}}</li>
						<li><strong>Invoice To:</strong> {{$seller->name}}</li>
					</ul>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-condensed nomargin">
					<thead>
						<tr>
							<th>Name</th>
							<th>Category</th>
							<th>Ordered</th>
							<th>Delivered</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><div><strong>{{($product->name)}}</strong></div></td>
							<td><div><strong>{{($product->category->name)}}</strong></div></td>
							<td>{{$order->quantity}}</td>
							<td>{{$order->quantity}}</td>
						</tr>
						<tr>
							<td colspan="3" class="text-right"><strong>Total:</strong></td>
							<td>{{$order->total_price}}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 text-center">
					<p class="nomargin nopadding" style="font-weight:400;">
						Notice must be given to us of any goods not received within 24 hours taken from the date of dispatch stated on invoice. Any shortage or damage must be notified within 24 hours of receipt of goods. Receiver Confirmed the above items has been delivered complete & in good condition as per the order. Thank you for your business. Should you have any enquiries concerning this delivery note, please contact customer service department.
					</p><br><!-- no P margin for printing - use <br> instead -->
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-default text-right">
		<div class="panel-body">
			<a class="btn btn-success" href="#" onclick="window.print()" target="_blank"><i class="fa fa-print"></i> PRINT INVOICE</a>
		</div>
	</div>
</div>
</body>
</html>
