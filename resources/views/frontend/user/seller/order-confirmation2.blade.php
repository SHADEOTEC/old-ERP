<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmation</title>
    <meta http-equiv="Content-Type" content="text/html;" />
    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
        }

        b,
        strong {
            font-weight: 700;
        }

        img {
            border: 0;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        td,
        th {
            padding: 0;
        }

        @media print {
            * {
                text-shadow: none !important;
                color: #000 !important;
                background: transparent !important;
                box-shadow: none !important;
            }

            thead {
                display: table-header-group;
            }

            tr,
            img {
                page-break-inside: avoid;
            }

            img {
                max-width: 100% !important;
            }

            .table td,
            .table th {
                background-color: #fff !important;
            }

            .table {
                border-collapse: collapse !important;
            }
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        :before,
        :after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.428571429;
            color: #333;
            background-color: #fff;
        }

        img {
            vertical-align: middle;
        }

        h4 {
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
            color: inherit;
        }

        h4 {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        h4 {
            font-size: 18px;
        }

        .text-center {
            text-align: center;
        }

        ul {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none;
        }

        .container {
            margin-right: auto;
            margin-left: auto;
            padding-left: 15px;
            padding-right: 15px;
            width: 700px
        }

        .row {
            height: auto;
            overflow: hidden;
        }

        .col-4 {
            width: 234px;
            float: left;
            margin-right: 20px;
        }

        .mr-0 {
            margin-right: 0;
        }

        table {
            max-width: 100%;
            background-color: transparent;
        }

        th {
            text-align: left;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
        }

        .table>thead>tr>th,
        .table>tbody>tr>td {
            padding: 8px;
            line-height: 1.428571429;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }

        .table>thead:first-child>tr:first-child>th {
            border-top: 0;
        }

        .table-condensed>thead>tr>th,
        .table-condensed>tbody>tr>td {
            padding: 5px;
        }

        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .panel-body {
            padding: 15px;
        }

        .panel-default {
            border-color: #ddd;
        }

        body {
            margin: 0;
        }

        b,
        strong {
            font-weight: 700;
        }

        img {
            border: 0;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        td,
        th {
            padding: 2px;
            vertical-align: top !important;
            border: 1px solid #EEEEEE;
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        :before,
        :after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.428571429;
            color: #333;
            background-color: #fff;
        }

        img {
            vertical-align: middle;
            max-width: 100%;
            max-height: 100%;
        }

        h4 {
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
            color: inherit;
        }

        h4 {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        h4 {
            font-size: 18px;
        }

        .text-center {
            text-align: center;
        }

        ul {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none;
        }

        .container {
            margin-right: auto;
            margin-left: auto;
            padding-left: 15px;
            padding-right: 15px;
            width: 700px
        }

        table {
            max-width: 100%;
            background-color: transparent;
        }

        th {
            text-align: left;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
        }

        .table>thead>tr>th,
        .table>tbody>tr>td {
            padding: 8px;
            line-height: 1.428571429;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }

        .table>thead:first-child>tr:first-child>th {
            border-top: 0;
        }

        .table-condensed>thead>tr>th,
        .table-condensed>tbody>tr>td {
            padding: 5px;
        }

        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .panel-body {
            padding: 15px;
        }

        .panel-default {
            border-color: #ddd;
        }

        body {
            margin-top: 20px;
            background: #eee;
            font-family: Arial, Helvetica, sans-serif;
            color: #000000;
            font-size: 12px;
        }

        .panel {
            position: relative;
            background: transparent;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }

        .panel-default {
            border: 0;
        }

        .panel-body {
            background-color: #fff;
            padding: 15px;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        td,
        th {
            font-size: 11px;
            word-break: break-word;
            word-wrap: break-word;
        }

        .pdf-attachment {
            max-width: 600px;
            width: 100%;
        }

        .product-details ul {
            list-style-position: outside;
            padding: 0 0 0 15px;
            margin: 0;
        }

        .list-unstyled {
            list-style: none;
        }

        .logo-image {
            width: 150px;
            height: auto;
        }

        .table-container {
            margin-top: 20px;
        }

        .table-container tr {
            border-top: 1px solid #EEEEEE;
        }

        .text-right {
            text-align: right;
        }

        .float-left {
            float: left;
        }

        .w-50 {
            width: 150px;
        }

        .form-address-1 {
            width: 100%;
        }

    </style>
</head>

@php
    $logo = get_setting('invoice_logo');
    if ($logo != null) {
        $logo = uploaded_asset($logo);
        $width = 'auto';
        $height = '125px';
    } else {
        $logo = static_asset('assets/img/logo-big.png');
        $width = '200px';
        $height = '125px';
    }
@endphp

<body>

    <div class="container bootstrap snippets bootdey pdf-attachment">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-4">
                        <h4>ORDER CONFIRMATION</h4>
                        <ul class="list-unstyled" style="font-weight:400;">
                            <li><strong>Address:</strong> 3333 Earhart Dr, Unit 240, <br /> Carrollton, TX, 75006, USA
                            </li>
                            <li><strong>Tel:</strong> 469-499-3322</li>
                            <li><strong>Fax:</strong> 469-499-3323</li>
                            <li><strong>Email:</strong> info@shadeotech.com</li>
                            <li><strong>Web:</strong> www.shadeotech.com</li>
                        </ul>
                    </div>

                    <div class="col-4 text-center">
                        <img src="{{ $logo }}" width="{{ $width }}" height="{{ $height }}"
                            alt="Window Fashions" />
                    </div>

                    <div class="col-4 mr-0 text-left float-left text-justify">
                        <ul class="list-unstyled" style="font-weight:400;">
                            <li>
                                <h4><strong>Order#: {{ $order->order_no }}</strong></h4>
                            </li>
                            <li><strong>Invoice#: INV-{{ $order->order_no }}</strong></li>
                            <li><strong>Name:</strong> {{ $ship->name }}</li>
                            <li><strong>Location:</strong> {{ $ship->country }}/{{ $ship->city }}</li>
                            <li><strong>Address:</strong> {{ $ship->address }} {{ $ship->address2 }}</li>
                            <li><strong>Zip:</strong> {{ $ship->zip }}</li>
                            <li><strong>Email:</strong> {{ $ship->email }}</li>
                            <li><strong>Project Tag:</strong>
                                {{ isset($cart_items[0]) ? $cart_items[0]->project_tag : '' }}</li>
                            <li><strong>Date:</strong> {{ isset($cart_items[0]) ? $cart_items[0]->date : '' }}</li>
                            <li><strong>Due Date:</strong>
                                {{ isset($cart_items[0]) ? $cart_items[0]->due_date : '' }}</li>
                        </ul>
                    </div>
                </div>

                <div class="table-container">
                    <table class="table table-condensed nomargin" aria-describedby="Order items list table">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Name</th>
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
                            @foreach ($cart_items as $item)
                                @php
                                    $quantity_total += $item['quantity'];
                                    $suggested_total += round($item['suggested_price'], 2);
                                @endphp
                                <tr>
                                    <td class="product-details">
                                        <b>{{ $item->product->name }}</b>
                                        <div>
                                            <table style="border-color: white;" aria-describedby="Product info">
                                                <tr style="border-color: white;">
                                                    <td style="border-color: white;">
                                                        <div class="float-left w-50" style="display: inline-block">
                                                            <ul>
                                                                @if ($item->width != null)
                                                                    <li style="padding-left:10px;">Width:
                                                                        {{ $item->width }},
                                                                        {{ $item->width_decimal }}</li>
                                                                @endif
                                                                @if ($item->length != null)
                                                                    <li style="padding-left:10px;">Length:
                                                                        {{ $item->length }},
                                                                        {{ $item->length_decimal }}</li>
                                                                @endif
                                                                @if ($item->control_type != null)
                                                                    <li style="padding-left:10px;">Control
                                                                        Type:{{ $item->control_type }}</li>
                                                                @endif
                                                                @if ($item->motor_type != null)
                                                                    <li style="padding-left:10px;">Motor Type:
                                                                        {{ $item->motor_type }}</li>
                                                                @endif
                                                                @if ($item->motor_name != null)
                                                                    <li style="padding-left:10px;">Motor Name:
                                                                        {{ $item->motor_name }}</li>
                                                                @endif
                                                                @if ($item->motor_pos != null)
                                                                    <li style="padding-left:10px;">Position:
                                                                        {{ $item->motor_pos }}</li>
                                                                @endif
                                                                @if ($item->remote_ctrl_channel != null)
                                                                    <li style="padding-left:10px;">Remote:
                                                                        {{ $item->remote_ctrl_channel }}, QTY 1</li>
                                                                @endif
                                                                @if ($item->motor_array != null)
                                                                    <li style="padding-left:10px;">Motor
                                                                        Array{{ $item->motor_array }}</li>
                                                                @endif
                                                                @if ($item->chain_cord != null)
                                                                    <li style="padding-left:10px;">Manual:
                                                                        {{ $item->chain_cord }}</li>
                                                                @endif
                                                                @if ($item->chain_color != null)
                                                                    <li style="padding-left:10px;">Chain Color:
                                                                        {{ $item->chain_color }}</li>
                                                                @endif
                                                                @if ($item->chain_ctrl != null)
                                                                    <li style="padding-left:10px;">Control Position:
                                                                        {{ $item->chain_ctrl }}</li>
                                                                @endif
                                                                @if ($item->cord_ctrl != null)
                                                                    <li style="padding-left:10px;">Cord Position:
                                                                        {{ $item->cord_ctrl }}</li>
                                                                @endif
                                                                @if ($item->cord_color != null)
                                                                    <li style="padding-left:10px;">Cord Color:
                                                                        {{ $item->cord_color }}</li>
                                                                @endif
                                                                @if ($item->fabric != null)
                                                                    <li style="padding-left:10px;">Fabric:
                                                                        {{ $item->fabric }}</li>
                                                                @endif
                                                                @if ($item->mount_type != null)
                                                                    <li style="padding-left:10px;">Mount Type:
                                                                        {{ $item->mount_type }}</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td style="border-color: white;">
                                                        <div class="float-left w-50" style="display: inline-block">
                                                            <ul>
                                                                @if ($item->cassette_type != null)
                                                                    <li style="padding-left:10px;">Cassette:
                                                                        {{ $item->cassette_type }}</li>
                                                                @endif
                                                                @if ($item->cassette_color != null)
                                                                    <li style="padding-left:10px;">Cassette Color:
                                                                        {{ $item->cassette_color }}</li>
                                                                @endif
                                                                @if ($item->bottom_rail != null)
                                                                    <li style="padding-left:10px;">Bottom Rail:
                                                                        {{ $item->bottom_rail }}</li>
                                                                @endif
                                                                @if ($item->bottom_rail_color != null)
                                                                    <li style="padding-left:10px;">Bottom Rail Color:
                                                                        {{ $item->bottom_rail_color }}</li>
                                                                @endif
                                                                @if ($item->brackets != null)
                                                                    <li style="padding-left:10px;">Brackets:
                                                                        {{ $item->brackets }}</li>
                                                                @endif
                                                                @if ($item->bracket_option_name != null)
                                                                    <li style="padding-left:10px;">Bracket Option:
                                                                        {{ $item->bracket_option_name }}</li>
                                                                @endif
                                                                @if ($item->shadoesmart_hub != null)
                                                                    <li style="padding-left:10px;">Shadoe Smart Hub: QTY
                                                                        1</li>
                                                                @endif
                                                                @if ($item->solar_panel != null)
                                                                    <li style="padding-left:10px;">Solar Panel: QTY 1
                                                                    </li>
                                                                @endif
                                                                @if ($item->plug_in_charger != null)
                                                                    <li style="padding-left:10px;">Plug in Charger: QTY
                                                                        1</li>
                                                                @endif
                                                                @if ($item->room_type != null)
                                                                    <li style="padding-left:10px;">Room Type:
                                                                        {{ $item->room_type }}</li>
                                                                @endif
                                                                @if ($item->window_desc != null)
                                                                    <li style="padding-left:10px;">Window:
                                                                        {{ $item->window_desc }}</li>
                                                                @endif
                                                                @if ($item->spring_assist != null)
                                                                    <li style="padding-left:10px;">Spring Assist: Yes
                                                                    </li>
                                                                @endif
                                                                @if ($item->sp_instructions != null)
                                                                    <li style="padding-left:10px;">Instructions:
                                                                        {{ $item->sp_instructions }}</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td>
                                        <div>{{ $item->quantity }}</div>
                                    </td>
                                    <td class="text-left"> {{ round($item['suggested_price'] / $item['quantity'], 2) }}
                                        <br>
                                        @if ($item->shade_price != null)
                                            Shade: {{ $item->shade_price }}
                                        @endif
                                        <br>
                                        @if ($item->cassette_price != null)
                                            Cassette: {{ $item->cassette_price }}
                                        @endif
                                        <br>
                                        @if ($item->bottom_rail_price != null)
                                            Bottom: {{ $item->bottom_rail_price }}
                                        @endif
                                        <br>
                                        @if ($item->brackets_opt_price != null)
                                            Brackets: {{ $item->brackets_opt_price }}
                                        @endif
                                        <br>
                                        @if ($item->spring_assist_price != null)
                                            Spring: {{ $item->spring_assist_price }}
                                        @endif
                                        <br>
                                        @if ($item->motor_price != null && $item->control_type == 'motor')
                                            Motor: {{ $item->motor_price }}
                                        @endif
                                        <br>
                                        @if ($item->channel_price != null)
                                            Channel: {{ $item->channel_price }}
                                        @endif
                                        <br>
                                        @if ($item->plugin_price != null)
                                            Plugin: {{ $item->plugin_price }}
                                        @endif
                                        <br>
                                        @if ($item->solar_price != null)
                                            Solar: {{ $item->solar_price }}
                                        @endif
                                        <br>
                                        @if ($item->hub_price != null)
                                            Hub: {{ $item->hub_price }}
                                            </li>
                                        @endif <br>
                                        @if ($item->hub_price != null)
                                            Transformer: {{ $item->transformer_price }}
                                        @endif
                                    </td>
                                    <td class="text-right"> {{ round($item['suggested_price'], 2) }} </td>
                                    <td class="text-right">
                                        <div>{{ $item->unit_price }}</div>
                                    </td>
                                    <td class="text-right">
                                        <div>{{ $item->total_price }}</div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td> {{ $quantity_total }} </td>
                                <td></td>
                                <td class="text-right">S.Grand: {{ $suggested_total }} </td>
                                <td></td>
                                <td class="text-right">Grand: {{ $order->grand_total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="wrapper">
                    <div class="input-data">
                        <label>Customer Signature:</label>
                        <hr>
                    </div>
                    <div class="input-data">
                        <label>Authorised Signature:</label>
                        <hr>
                    </div>
                </div>

                {{-- <table>
                    <tr>
                        <td>
                            <span style="float:left">
                                <label for="customer_signature">Customer Signature:</label>
                                <hr style="width: 100px;margin-left: 20px;"></span>
                                <span style="float:right">
                                <label for=" authorised_signature">Authorised Signature:</label>
                                <hr style="width: 100px;margin-left: 20px;"></span>
                        </td>
                    </tr>
                </table> --}}

            </div>
        </div>
    </div>
</body>

</html>
