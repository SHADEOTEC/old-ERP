<html>

<head>
    <title>Order Details #: {{ $total->order_no }}</title>
    <meta http-equiv="Content-Type" content="text/html;" />
    <meta charset="UTF-8">
    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    {{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <style>
        @media print {
            @page {
                size: landscape
            }
        }

        body {
            margin-top: 20px;
            background: #eee;
        }

        /**    17. Panel
  *************************************************** **/
        /* pannel */
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

        .panel.fullscreen .accordion .panel-body,
        .panel.fullscreen .panel-group .panel-body {
            position: relative !important;
            top: auto !important;
            left: auto !important;
            right: auto !important;
            bottom: auto !important;
        }

        .panel.fullscreen .panel-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }


        .panel>.panel-heading {
            text-transform: uppercase;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .panel>.panel-heading small {
            text-transform: none;
        }

        .panel>.panel-heading strong {
            font-family: Arial, Helvetica, Sans-Serif;
        }

        .panel>.panel-heading .buttons {
            display: inline-block;
            margin-top: -3px;
            margin-right: -8px;
        }

        .panel-default>.panel-heading {
            padding: 15px 15px;
            background: #fff;
        }

        .panel-default>.panel-heading small {
            color: #9E9E9E;
            font-size: 12px;
            font-weight: 400;
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
            background: #fff !important;
            color: #000;
            border-bottom: #eee 1px solid;
        }

        .panel>.panel-heading .btn {
            margin-bottom: 0 !important;
        }

        .panel>.panel-heading .progress {
            background-color: #ddd;
        }

        .panel>.panel-heading .pagination {
            margin: -5px;
        }

        .panel-default {
            border: 0;
        }

        .panel-light {
            border: rgba(0, 0, 0, 0.1) 1px solid;
        }

        .panel-light>.panel-heading {
            padding: 11px 15px;
            background: transaprent;
            border-bottom: rgba(0, 0, 0, 0.1) 1px solid;
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
            display: inline-block;
            margin-top: -8px;
            margin-right: 0;
            height: 30px;
            padding: 0 15px;
        }

        .panel-heading ul.options>li>a {
            color: #999;
        }

        .panel-heading ul.options>li>a:hover {
            color: #333;
        }

        .panel-title a {
            text-decoration: none;
            display: block;
            color: #333;
        }

        .panel-body {
            background-color: #fff;
            padding: 15px;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .panel-body.panel-row {
            padding: 8px;
        }

        .panel-footer {
            font-size: 12px;
            border-top: rgba(0, 0, 0, 0.02) 1px solid;
            background-color: rgba(0255, 255, 255, 1);

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        @media print {
            .btn {
                visibility: hidden;
            }
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

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-4 text-left">
                        <h4><strong>ORDER DETAILS </strong> </h4>
                        <ul class="list-unstyled" style="font-weight:400;">
                            <li><strong>Address:</strong> 3333 Earhart Dr, Unit 240, <br /> Carrollton, TX, 75006, USA </li>
                            <li><strong>Tel:</strong> 469-499-3322</li>
                            <li><strong>Fax:</strong> 469-499-3323</li>
                            <li><strong>Email:</strong> info@shadeotech.com</li>
                            <li><strong>Web:</strong> www.shadeotech.com</li>
                            <li><strong>Date:</strong> {{ isset($order[0]) ? $order[0]->date : '' }} </li>
                        </ul>
                    </div>

                    <div class="col-4 text-center">
                        <img src="{{ $logo }}" width="{{ $width }}" height="{{ $height }}" />
                    </div>

                    <div class="col-4 text-end">
                        <ul class="list-unstyled" style="font-weight:400;">
                            <li>
                                <h4><strong>Order#: {{ $total->order_no }}</strong></h4>
                            </li>
                            <li><strong>Invoice#: INV-{{ $total->order_no }}</strong></li>
                            <li><strong>Name:</strong> {{ $ship_addr->name }}</li>
                            <li><strong>Location:</strong> {{ $ship_addr->country }}/{{ $ship_addr->city }}</li>
                            <li><strong>Address:</strong> {{ $ship_addr->address }} {{ $ship_addr->address2 }}</li>
                            <li><strong>Zip:</strong> {{ $ship_addr->zip }}</li>
                            <li><strong>Project Tag:</strong> {{ isset($order[0]) ? $order[0]->project_tag : '' }}</li>
                            <li><strong>Due Date:</strong> {{ isset($order[0]) ? $order[0]->due_date : '' }}</li>
                        </ul>
                    </div>

                </div>

                @php
                    $totalQuantity = 0;
                @endphp


                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr style="font-size:13px;">
                                <th style="width: 35%;">Name</th>
                                <th>Quantity</th>
                                <th class="text-end">Unit Price ($)</th>
                                <th class="text-end">Suggested Unit Price ($)</th>
                                <th class="text-end">Suggested Price ($)</th>
                                <th class="text-end">Total Price ($)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                @php $totalQuantity += (int)$item->quantity  @endphp
                                <tr style="font-size:13px;">
                                    <td><b>{{ $item->product->name }}</b>
                                        <div class="row">
                                            <div class="col-6">
                                                @if ($item->width != null)
                                                    <li style="padding-left:10px;">Width: {{ $item->width }}, {{ $item->width_decimal }}</li>
                                                @endif
                                                @if ($item->length != null)
                                                    <li style="padding-left:10px;">Length: {{ $item->length }}, {{ $item->length_decimal }}</li>
                                                @endif
                                                @if ($item->control_type != null)
                                                    <li style="padding-left:10px;">Control Type:{{ $item->control_type }}</li>
                                                @endif
                                                @if ($item->motor_type != null)
                                                    <li style="padding-left:10px;">Motor Type: {{ $item->motor_type }}</li>
                                                @endif
                                                @if ($item->motor_name != null)
                                                    <li style="padding-left:10px;">Motor Name: {{ $item->motor_name }}</li>
                                                @endif
                                                @if ($item->motor_pos != null)
                                                    <li style="padding-left:10px;">Position: {{ $item->motor_pos }}</li>
                                                @endif
                                                @if ($item->remote_ctrl_channel != null)
                                                    <li style="padding-left:10px;">Remote: {{ $item->remote_ctrl_channel }}, QTY 1 </li>
                                                @endif
                                                @if ($item->motor_array != null)
                                                    <li style="padding-left:10px;">Motor Array: {{ $item->motor_array }}</li>
                                                @endif
                                                @if ($item->chain_cord != null)
                                                    <li style="padding-left:10px;">Manual: {{ $item->chain_cord }}</li>
                                                @endif
                                                @if ($item->chain_color != null)
                                                    <li style="padding-left:10px;">Chain Color: {{ $item->chain_color }}</li>
                                                @endif
                                                @if ($item->chain_ctrl != null)
                                                    <li style="padding-left:10px;">Control Position: {{ $item->chain_ctrl }}</li>
                                                @endif
                                                @if ($item->cord_ctrl != null)
                                                    <li style="padding-left:10px;">Cord Position: {{ $item->cord_ctrl }}</li>
                                                @endif
                                                @if ($item->cord_color != null)
                                                    <li style="padding-left:10px;">Cord Color: {{ $item->cord_color }}</li>
                                                @endif
                                                @if ($item->fabric != null)
                                                    <li style="padding-left:10px;">Fabric: {{ $item->fabric }}</li>
                                                @endif
                                                @if ($item->mount_type != null)
                                                    <li style="padding-left:10px;">Mount Type: {{ $item->mount_type }}</li>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                @if ($item->cassette_type != null)
                                                    <li style="padding-left:10px;">Cassette: {{ $item->cassette_type }}</li>
                                                @endif
                                                @if ($item->cassette_color != null)
                                                    <li style="padding-left:10px;">Cassette Color: {{ $item->cassette_color }}</li>
                                                @endif
                                                @if ($item->bottom_rail != null)
                                                    <li style="padding-left:10px;">Bottom Rail: {{ $item->bottom_rail }}</li>
                                                @endif
                                                @if ($item->bottom_rail_color != null)
                                                    <li style="padding-left:10px;">Bottom Rail Color: {{ $item->bottom_rail_color }}</li>
                                                @endif
                                                @if ($item->brackets != null)
                                                    <li style="padding-left:10px;">Brackets: {{ $item->brackets }}</li>
                                                @endif
                                                @if ($item->bracket_option_name != null)
                                                    <li style="padding-left:10px;">Bracket Option: {{ $item->bracket_option_name }}</li>
                                                @endif
                                                @if ($item->shadoesmart_hub != null)
                                                    <li style="padding-left:10px;">Shadoe Smart Hub: QTY 1</li>
                                                @endif
                                                @if ($item->solar_panel != null)
                                                    <li style="padding-left:10px;">Solar Panel: QTY 1</li>
                                                @endif
                                                @if ($item->plug_in_charger != null)
                                                    <li style="padding-left:10px;">Plug in Charger: QTY 1</li>
                                                @endif
                                                @if ($item->room_type != null)
                                                    <li style="padding-left:10px;">Room Type: {{ $item->room_type }}</li>
                                                @endif
                                                @if ($item->window_desc != null)
                                                    <li style="padding-left:10px;">Window: {{ $item->window_desc }}</li>
                                                @endif
                                                @if ($item->spring_assist != null && $item->spring_assist != '' && $item->spring_assist > 0)
                                                    <li style="padding-left:10px;">Spring Assist: Yes</li>
                                                @endif
                                                @if ($item->sp_instructions != null)
                                                    <li style="padding-left:10px;">Instructions: {{ $item->sp_instructions }}</li>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>{{ $item->quantity }}</div>
                                    </td>
                                    <td class="text-end">
                                        <div>{{ $item->unit_price }}</div>
                                    </td>
                                    <td class="text-end">
                                        <div>{{ $item->suggested_price ? round($item->suggested_price / $item->quantity, 2) : $item->unit_price }}</div>
                                    </td>
                                    <td class="text-end">
                                        <div> <span>
                                                {{ $item->suggested_price ? $item->suggested_price : $item->shade_amount * ($item->admin_discount / 100) * $item->quantity + $item->total_price }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div>{{ $item->total_price }}</div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><strong> {{ $totalQuantity }} </strong></td>
                                <td class="text-end" colspan="4"><strong>Grand: {{ round($total->grand_total, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="panel panel-default text-end">
            <div class="panel-body">
                <a class="btn btn-success" href="#" onclick="window.print()"><i class="fa fa-print"></i> PRINT</a>
            </div>
        </div>
    </div>

</body>

</html>
