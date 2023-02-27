<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quote Invoice</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <meta charset="UTF-8">
	<style>
        body{margin:0;}
        b,strong{font-weight:700;}
        img{border:0;}
        table{border-collapse:collapse;border-spacing:0;}
        td,th{padding:0;}
        @media print{
        *{text-shadow:none!important;color:#000!important;background:transparent!important;box-shadow:none!important;}
        thead{display:table-header-group;}
        tr,img{page-break-inside:avoid;}
        img{max-width:100%!important;}
        .table td,.table th{background-color:#fff!important;}
        .table{border-collapse:collapse!important;}
        }
        *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
        :before,:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
        body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.428571429;color:#333;background-color:#fff;}
        img{vertical-align:middle;}
        h4{font-family:inherit;font-weight:500;line-height:1.1;color:inherit;}
        h4{margin-top:10px;margin-bottom:10px;}
        h4{font-size:18px;}
        .text-center{text-align:center;}
        ul{margin-top:0;margin-bottom:10px;}
        .list-unstyled{padding-left:0;list-style:none;}
        .container{margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px;width: 700px}
        .row{height:auto;overflow:hidden;}
        .col-4{width: 234px;float:left;margin-right:20px;}
        .mr-0{margin-right:0;}
        table{max-width:100%;background-color:transparent;}
        th{text-align:left;}
        .table{width:100%;margin-bottom:20px;}
        .table>thead>tr>th,.table>tbody>tr>td{padding:8px;line-height:1.428571429;vertical-align:top;border-top:1px solid #ddd;}
        .table>thead>tr>th{vertical-align:bottom;border-bottom:2px solid #ddd;}
        .table>thead:first-child>tr:first-child>th{border-top:0;}
        .table-condensed>thead>tr>th,.table-condensed>tbody>tr>td{padding:5px;}
        .panel{margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05);}
        .panel-body{padding:15px;}
        .panel-default{border-color:#ddd;}
        body{margin:0;}
        b,strong{font-weight:700;}
        img{border:0;}
        table{border-collapse:collapse;border-spacing:0;}
        td,th{padding:2px;vertical-align:top!important;border:1px solid #EEEEEE;}
        *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
        :before,:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
        body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.428571429;color:#333;background-color:#fff;}
        img{vertical-align:middle;max-width:100%;max-height:100%;}
        h4{font-family:inherit;font-weight:500;line-height:1.1;color:inherit;}
        h4{margin-top:10px;margin-bottom:10px;}
        h4{font-size:18px;}
        .text-center{text-align:center;}
        ul{margin-top:0;margin-bottom:10px;}
        .list-unstyled{padding-left:0;list-style:none;}
        .container{margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px; width: 700px}
        table{max-width:100%;background-color:transparent;}
        th{text-align:left;}
        .table{width:100%;margin-bottom:20px;}
        .table>thead>tr>th,.table>tbody>tr>td{padding:8px;line-height:1.428571429;vertical-align:top;border-top:1px solid #ddd;}
        .table>thead>tr>th{vertical-align:bottom;border-bottom:2px solid #ddd;}
        .table>thead:first-child>tr:first-child>th{border-top:0;}
        .table-condensed>thead>tr>th,.table-condensed>tbody>tr>td{padding:5px;}
        .panel{margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05);}
        .panel-body{padding:15px;}
        .panel-default{border-color:#ddd;}
        body{margin-top:20px;background:#eee;font-family:Arial, Helvetica, sans-serif;color:#000000;font-size:12px;}
        .panel{position:relative;background:transparent;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}
        .panel-default{border:0;}
        .panel-body{background-color:#fff;padding:15px;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;}
        td,th{font-size:11px;word-break:break-word;word-wrap:break-word;}
        .pdf-attachment{max-width:600px;width:100%;}
        .product-details ul{list-style-position:outside;padding:0 0 0 15px;margin:0;}
        .list-unstyled{list-style:none;}
        .logo-image{width:150px;height:auto;}
        .table-container{margin-top:20px;}
        .table-container tr{border-top:1px solid #EEEEEE;}
        .text-right{text-align:right;}
        .float-left {
            float: left;
        }
        .w-50{
            width: 150px;
        }
	</style>
</head>
<body>
	
<div class="container bootstrap snippets bootdey pdf-attachment">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-4">
					<h4>Quote Invoice</h4>
					<ul class="list-unstyled" style="font-weight:400;">
						<li><strong>Address:</strong> 3333 Earhart Dr, Unit 240, <br /> Carrollton, TX, 75006, USA </li>
						<li><strong>Tel:</strong> 469-499-3322</li>
						<li><strong>Fax:</strong> 469-499-3323</li>
						<li><strong>Email:</strong> info@shadeotech.com</li>
						<li><strong>Web:</strong> www.shadeotech.com</li>
					</ul>
				</div>

				<div class="col-4 text-center">
					<img src="{{ $data['logo'] }}" width="150" height="126" class="logo-image" />
				</div>

				<div class="col-4 mr-0 text-right float-right">
					<ul class="list-unstyled" style="font-weight:400;">
						<li><strong>Name:</strong> {{$data["name"]}}</li>
						<li><strong>Email:</strong> {{$data["email"]}}</li>
						<li><strong>Project Tag:</strong> {{ $data["tag"] }}</li>
						<li><strong>Date:</strong> {{ $data["date"] }}</li>
					</ul>
				</div>
			</div>
            
			<div class="table-container">
				<table class="table table-condensed nomargin">
					<thead>
						<tr>
                            <th>SL</th>
							<th>Name</th>
							<th>QTY</th>
							<th class="text-right">Unit Suggested Price</th>
							<th class="text-right">Suggested Price</th>
							<th class="text-right">Unit Price ($)</th>
							<th class="text-right">Total Price ($)</th>
						</tr>
					</thead>
					<tbody>
                        @php
                            $quantity_total = 0;
                            $suggested_total = 0;
                        @endphp
						@foreach($data["cart"] as $item)
                        @php
                            $quantity_total += $item["quantity"];  
                            if(!isset($item["suggested_price"]) || !$item["suggested_price"]) {
                                $item["suggested_price"] = (float) $item["total"];
                            } else {
                                $item["suggested_price"] = (float) $item["suggested_price"];
                            }
                            $item["quantity"] = (int) $item["quantity"];
                            $suggested_total += round($item["suggested_price"], 2);
                        @endphp
						<tr>
                            <td>{{ $loop->iteration }}</td>
							<td class="product-details">
                                <b>{{$item["prod_name"]}}</b>
								<div class="row">
									<div class="float-left w-50">
										<ul>
                                            @if(isset($item["width"]) && $item["width"] != null)<li style="padding-left:10px;">Width: {{$item["width"] }}, {{isset($item["wid_decimal"]) ? $item["wid_decimal"] : "" }}</li>@endif
                                            @if(isset($item["length"]) && $item["length"] != null)<li style="padding-left:10px;">Length: {{$item["length"] }}, {{isset($item["len_decimal"]) ? $item["len_decimal"] : "" }}</li>@endif
                                            @if(isset($item["control_type"]) && $item["control_type"] != null)<li style="padding-left:10px;">Control Type:{{$item["control_type"] }}</li>@endif
                                            @if(isset($item["motor_name"]) && $item["motor_name"] != "")<li style="padding-left:10px;">Motor Name: {{$item["motor_name"] }}</li>@endif
                                            @if(isset($item["motor_pos"]) && $item["motor_pos"] != "" && trim($item["motor_pos"]) != "Select your Motor Pos")<li style="padding-left:10px;">Position: {{$item["motor_pos"] }}</li>@endif
                                            @if(isset($item["channel_name"]) && $item["channel_name"] != "")<li style="padding-left:10px;">Remote: {{$item["channel_name"] }}</li>@endif
                                            @if(isset($item["chain_cord"]) && $item["chain_cord"] != "")<li style="padding-left:10px;">Manual: {{$item["chain_cord"] }}</li>@endif
                                            @if(isset($item["chain_color"]) && $item["chain_color"] != "")<li style="padding-left:10px;">Chain Color: {{$item["chain_color"] }}</li>@endif
                                            @if(isset($item["chain_ctrl"]) && $item["chain_ctrl"] != "")<li style="padding-left:10px;">Control Position: {{$item["chain_ctrl"] }}</li>@endif
                                            @if(isset($item["cord_ctrl"]) && $item["cord_ctrl"] != "")<li style="padding-left:10px;">Cord Position: {{$item["cord_ctrl"] }}</li>@endif
                                            @if(isset($item["cord_color"]) && $item["cord_color"] != "")<li style="padding-left:10px;">Cord Color: {{$item["cord_color"] }}</li>@endif
                                            @if(isset($item["fabric"]) && $item["fabric"] != "")<li style="padding-left:10px;">Fabric: {{$item["fabric"] }}</li>@endif
                                            @if(isset($item["mount_type"]) && $item["mount_type"] != "")<li style="padding-left:10px;">Mount Type: {{$item["mount_type"] }}</li>@endif
                                        </ul>
									</div> 
									<div class="float-left w-50">
										<ul>
                                            @if(isset($item["cassette_type"]) && $item["cassette_type"] != null)<li style="padding-left:10px;">Cassette: {{$item["cassette_type"]}}</li>@endif
                                            @if(isset($item["cassette_color"]) && $item["cassette_color"] != null)<li style="padding-left:10px;">Cassette Color: {{$item["cassette_color"]}}</li>@endif
                                            @if(isset($item["brackets"]) && $item["brackets"] != null)<li style="padding-left:10px;">Brackets: {{$item["brackets"]}}</li>@endif
                                            @if(isset($item["brackets_opt"]) && $item["brackets_opt"] != null)<li style="padding-left:10px;">Bracket Option: {{$item["brackets_opt"]}}</li>@endif
                                            @if(isset($item["hub_price"]) && $item["hub_price"] > 0)<li style="padding-left:10px;">Shadoe Smart Hub</li>@endif
                                            @if(isset($item["solar_price"]) && $item["solar_price"] > 0)<li style="padding-left:10px;">Solar Panel</li>@endif
                                            @if(isset($item["plugin_price"]) && $item["plugin_price"] > 0)<li style="padding-left:10px;">Plug in Charger</li>@endif
                                            @if(isset($item["room_type"]) && $item["room_type"] != null)<li style="padding-left:10px;">Room Type: {{$item["room_type"]}}</li>@endif
                                            @if(isset($item["window_desc"]) && $item["window_desc"] != "")<li style="padding-left:10px;">Window: {{$item["window_desc"]}}</li>@endif
                                            @if(isset($item["spring_assist_price"]) && $item["spring_assist_price"] > 0)<li style="padding-left:10px;">Spring Assist</li>@endif
                                            @if(isset($item["sp_instructions"]) && $item["sp_instructions"] != "")<li style="padding-left:10px;">Instructions: {{$item["sp_instructions"]}}</li>@endif
                                        </ul>
									</div>
								</div>
							</td>
							<td><div>{{$item["quantity"]}}</div></td>
                            <td class="text-right"> {{round($item["suggested_price"] / $item["quantity"], 2)}} </td>
                            <td class="text-right"> {{round($item["suggested_price"], 2)}} </td>
							<td class="text-right"><div>{{$item["price"]}}</div></td>
							<td class="text-right"><div>{{$item["total"]}}</div></td>
						</tr>
						@endforeach
						<tr>
                            <td></td>
                            <td></td>
                            <td> {{ $quantity_total }} </td>
                            <td></td>
                            <td class="text-right">S.Grand: {{ $suggested_total }} </td>
                            <td></td>
                            <td class="text-right"><strong>Grand: {{$data["grandTotal"]}}</strong></td>
                        </tr>
                        <tr style="border-color:transparent !important; border-top-color: white !important; border-bottom-color: white !important; outline-color: white;">
                            <td colspan="7" style="text-align: right;border-color:transparent !important; border-top-color: white !important; border-bottom-color: white !important; padding-top: 30px; padding-bottom: 10px;outline-color: white;">
                                <span><b>Customer Signature:</b>________________________________</span>
                            </td>
                        </tr>
                        <tr style="border-color:transparent !important; border-top-color: white !important; border-bottom-color: white !important; outline-color: white;">
                            <td colspan="7" style="text-align: right;border-color:transparent !important; border-top-color: white !important; border-bottom-color: white !important; padding-top: 20px; padding-bottom: 10px;outline-color: white;">
                                <span><b>Seller Signature:</b>________________________________</span>
                            </td>
                        </tr>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>
</body>
</html>
