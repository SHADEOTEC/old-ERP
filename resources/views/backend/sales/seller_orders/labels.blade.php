<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delivery Note</title>
    <meta http-equiv="Content-Type" content="text/html;" />
    <meta charset="UTF-8">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato', sans-serif;
            --print-font: 22px;
        }

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

        .headings {
            background: black;
            color: white;
        }

        .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
    </style>
</head>

<body>


    <div style="display: flex; justify-content: center; margin-top: 5rem">
        <div style="width: 1050px; height: 325px;" id="outer_wrapper">

            <div style="width: 1050px;height: 325px;">

                <div class="row" style="font-size: var(--print-font);">
                    <div class="col-xs-2 headings" style="width:24.24%;padding-left:5px !important;">ORDER#</div>
                    <div class="col-xs-2 headings" style="width:27.27%;">TAG</div>
                    <div class="col-xs-2 headings" style="width:15.15%;">DUE</div>
                    <div class="col-xs-2 headings" style="width:10.60%;">WIDTH</div>
                    <div class="col-xs-2 headings" style="width:10.60%;">HEIGHT</div>
                    <div class="col-xs-2 headings" style="width:12.12%;padding-right:5px !important;">QUANTITY</div>
                </div>
                <div class="row" style="font-size: var(--print-font); padding-inline:5px !important;">
                    <div class="col-xs-2" style="width:24.24%;">{{ $order->order_number }}</div>
                    <div class="col-xs-2" style="width:27.27%;">{!! str_replace(' ', '&nbsp;', $order->project_tag) !!}</div>
                    <div class="col-xs-2" style="width:15.15%;">{{ trim($order->due_date) }}</div>
                    <div class="col-xs-2" style="width:10.60%;">{{ trim($order->width) }}&nbsp;{{ trim(float2rat((float) $order->width_decimal)) }}</div>
                    <div class="col-xs-2" style="width:10.60%;">{{ trim($order->length) }}&nbsp;{{ trim(float2rat((float) $order->length_decimal)) }}</div>
                    <div class="col-xs-2" style="width:12.12%;">{{ $order->quantity }}</div>
                </div>
                <div class="row" style="height: 122px;padding-inline:5px !important;">
                    <div class="col-xs-4" style="font-weight:900;font-size: 24px;width:30%;overflow: hidden;white-space: nowrap;"> {!! str_replace(' ', '&nbsp;', $seller->name) !!}<br> {!! str_replace(' ', '&nbsp;', date('Y-m-d h:i:s')) !!}</div>
                    <div class="col-xs-4" style="width:70%;display: flex;justify-content: center;margin-top: 10px;">
                        <div id="bar_code"></div>
                    </div>
                </div>
                <div class="row" style="font-size: var(--print-font);">
                    <div class="col-xs-2 headings" style="width:9.09%;padding-left:5px !important;">Mount</div>
                    <div class="col-xs-2 headings" style="width:19.69%;">Control&nbsp;&nbsp;Type</div>
                    <div class="col-xs-2 headings" style="width:12.12%;">Channel</div>
                    <div class="col-xs-4 headings" style="width:25.75%;">Fabric</div>
                    <div class="col-xs-2 headings" style="width:13.63%;">Config</div>
                    <div class="col-xs-2 headings" style="width:19.69%;padding-right:5px !important;">Area&nbsp;&nbsp;(Room)</div>
                </div>
                <div class="row" style="font-size: var(--print-font);padding-inline:5px !important;">
                    <div class="col-xs-2" style="width:9.09%;">{{ $order->mount_type }}</div>
                    <div class="col-xs-2" style="width:19.69%; text-transform: capitalize">{{ $order->control_type }}</div>
                    <div class="col-xs-2" style="width:12.12%;">{{ $order->remote_ctrl_channel }}</div>
                    <div class="col-xs-4" style="width:25.75%;">{{ $order->fabric }}</div>
                    @if (strtolower($order->control_type) == 'motor')
                        <div class="col-xs-2" style="width:13.63%;overflow: hidden;white-space: nowrap;">{!! str_replace(' ', '&nbsp;', $order->motor_pos) !!}</div>
                    @elseif(strtolower($order->control_type) == 'manual' && $order->cord_ctrl && strlen($order->cord_ctrl) > 0)
                        <div class="col-xs-2" style="width:13.63%;overflow: hidden;white-space: nowrap;">{!! str_replace(' ', '&nbsp;', $order->cord_ctrl) !!}</div>
                    @elseif(strtolower($order->control_type) == 'manual' && $order->chain_ctrl && strlen($order->chain_ctrl) > 0)
                        <div class="col-xs-2" style="width:13.63%;overflow: hidden;white-space: nowrap;">{!! str_replace(' ', '&nbsp;', $order->chain_ctrl) !!}</div>
                    @endif
                    <div class="col-xs-2" style="width:19.69%;padding-left:0;">{!! str_replace(' ', '&nbsp;', $order->room_type) !!}</div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 text-right" style="margin-top:15px;">
            <button class="btn btn-success" href="#" onclick="printLabel()"><i class="fa fa-print"></i> PRINT LABEL</button>
        </div>
    </div>

    <script src="{{ static_asset('assets/js/jquery-barcode.min.js') }}"></script>
    <script>
        $("#bar_code").barcode(
            "{{ $bar_code_number }}", // Value barcode (dependent on the type of barcode)
            "ean13", // type (string)
            {
                "barWidth": 6,
                "barHeight": 60,
                fontSize: 23,
            }
        );

        function printLabel() {
            var element = document.getElementById('outer_wrapper');
            var opt = {
                margin: 1,
                filename: 'myfile.pdf',
                image: {
                    type: 'png',
                    quality: 1
                },
                html2canvas: {
                    scale: 2.5
                },
                jsPDF: {
                    unit: 'px',
                    format: [1050, 330],
                    orientation: 'l',
                    putOnlyUsedFonts: true
                }
            };
            html2pdf(element, opt);
        }
    </script>
</body>

</html>
