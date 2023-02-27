<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delivery Note</title>
    <meta http-equiv="Content-Type" content="text/html;" />
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

        #bar_code {}

        .row .col-xs-2 {
            padding-right: 0 !important;
            padding-left: 0 !important;
            line-height: 2.3 !important;
        }

        .row .col-xs-4 {
            padding-left: 0 !important;
            padding-right: 0 !important;
            line-height: 2.3 !important;
        }

        h6 {
            padding: 0;
            margin: 0;
            font-size: 8px !important;
            font-weight: bold;
        }

        .headings {
            background: black;
            color: white;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }

        @media print {
            .btn {
                visibility: hidden;
            }
        }
    </style>
</head>

<body>


    <div style="display: flex; justify-content: center; margin-top: 5rem" id="outer_wrapper">
        <div style="width: 800px">

            <div class="row" style="">
                <div class="col-xs-2 headings" style="width:15%;">ORDER#</div>
                <div class="col-xs-2 headings" style="width:17%;">TAG</div>
                <div class="col-xs-2 headings" style="width:9%;">DUE</div>
                <div class="col-xs-2 headings" style="width:6%;">WIDTH</div>
                <div class="col-xs-2 headings" style="width:6%;">HEIGHT</div>
                <div class="col-xs-2 headings" style="width:6%;">QUANTITY</div>
            </div>
            <div class="row">
                <div class="col-xs-2" style="width:15%;">{{ $order->order_number }}</div>
                <div class="col-xs-2" style="width:17%;">{{ $order->project_tag }}</div>
                <div class="col-xs-2" style="width:9%;">{{ $order->due_date }}</div>
                <div class="col-xs-2" style="width:6%;">{{ $order->width }} / {{ $order->width_decimal }}</div>
                <div class="col-xs-2" style="width:6%;">{{ $order->length }} / {{ $order->length_decimal }}</div>
                <div class="col-xs-2" style="width:6%;">{{ $order->quantity }}</div>
            </div>
            <div class="row">
                <div class="col-xs-4" style="font-weight:bold;font-size:9px;width:20%;">{{ $seller->name }}<br> {{ date('Y-m-d h:i:s') }}</div>
                <div class="col-xs-4" id="bar_code"></div>
            </div>
            <div class="row" style="">
                <div class="col-xs-2 headings" style="width:5%;">Mount</div>
                <div class="col-xs-2 headings" style="width:9%;">Manual/Motor</div>
                <div class="col-xs-2 headings" style="width:8%;">Channel</div>
                <div class="col-xs-4 headings" style="width:19%;">Fabric</div>
                <div class="col-xs-2 headings" style="width:8%;">Config</div>
                <div class="col-xs-2 headings" style="width:10%;">Area(Room)</div>
            </div>
            <div class="row" style="">
                <div class="col-xs-2" style="width:5%;">{{ $order->mount_type }}</div>
                <div class="col-xs-2" style="width:9%;">{{ $order->control_type }}</div>
                <div class="col-xs-2" style="width:8%;">{{ $order->remote_ctrl_channel }}</div>
                <div class="col-xs-4" style="width:19%;">{{ $order->fabric }}</div>
                @if ($order->motor_pos != null)
                    <div class="col-xs-2" style="width:8%;">{{ $order->motor_pos }}</div>
                @elseif($order->cord_ctrl != null)
                    <div class="col-xs-2" style="width:8%;">{{ $order->cord_ctrl }}</div>
                @elseif($order->chain_ctrl != null)
                    <div class="col-xs-2" style="width:8%;">{{ $order->chain_ctrl }}</div>
                @else
                @endif
                <div class="col-xs-2" style="width:10%;padding-left:0;">{{ $order->room_type }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 text-right" style="margin-top:15px;">
            <a class="btn btn-success" href="#" onclick="window.print()" target="_blank"><i class="fa fa-print"></i> PRINT LABEL</a>
        </div>
    </div>

    <script src="{{ static_asset('assets/js/jquery-barcode.min.js') }}"></script>
    <script>
        $("#bar_code").barcode(
            "1234567890128", // Value barcode (dependent on the type of barcode)
            "ean13", // type (string)
            {
                "barWidth": 2,
                "barHeight": 20
            }
        );
    </script>
</body>

</html>
