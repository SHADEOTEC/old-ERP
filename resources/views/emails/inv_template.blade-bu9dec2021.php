<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shadeotech--Order</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
	<script src="{{ static_asset('assets/js/jquery-3.6.0.min.js') }}"></script>
	<script src="{{ static_asset('assets/js/bootstrap.bundle.min.js') }}"></script>
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

        .ord_det_ul {
            font-size: 12px;
            line-height: 1.5;
            letter-spacing: 1.5px;
        }
	</style>
</head>
<body>
	
<div class="container bootstrap snippets bootdey">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6 col-sm-6 text-left">
					<h4><strong>Address</h4>
					<ul class="list-unstyled" style="font-weight:400;">
						<li><strong>Name:</strong> {{ $ship['name'] ?? '' }}</li>
						<li><strong>Email:</strong> {{ $ship['email'] ?? '' }}</li>
						<li><strong>Address1:</strong> {{ $ship['address'] ?? '' }}</li>
						<li><strong>Address2:</strong> {{ $ship['address2'] ?? 'N/A' }}</li>
						<li><strong>Country:</strong> {{ $ship['country'] ?? '' }}</li>
						<li><strong>City:</strong> {{ $ship['city'] ?? '' }}</li>
						<li><strong>Zip:</strong> {{ $ship['zip'] ?? '' }}</li>
					</ul>
				</div>

				<div class="col-md-6 col-sm-6 text-right">
					<img src="{{static_asset('assets/img/logo-big.png')}}" width="200px" height="125px"/>
				</div>
			</div>
			<div class="row" style="background:#e1d5d547;padding: 16px 0px 8px 0px;">
				<div class="col-md-12 col-sm-12">
                    <h3>Order</h3>
                    <table>
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Coupon</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>$ {{$order->coupon_discount ?? '0'}}</td>
                            <td>$ {{$order->grand_total}}</td>
                        </tr>
                        </tbody>
                    </table>
				</div>
			</div>
			<div class="row" style="background:#e1d5d547;padding: 16px 0px 8px 0px;">
				<div class="col-md-12 col-sm-12">
                    <h3>Order Items</h3>
                    <table>
                        <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Due Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cart_items as $item)
                        <tr>
                            <td>{{$item->order_number}}</td>
                            <td>{{$item->product_id}}</td>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->unit_price}}</td>
                            <td>{{$item->total_price}}</td>
                            <td>{{$item->due_date}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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
