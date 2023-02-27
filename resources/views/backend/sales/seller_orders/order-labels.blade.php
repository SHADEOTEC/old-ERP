<html>

<head>
    <meta name="viewport" content="width=1200, initial-scale=1">
    <title>Delivery Note</title>
    <meta http-equiv="Content-Type" content="text/html;" />
    <meta charset="UTF-8">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

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
            background: white;
        }

        .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
    </style>
</head>

<body style="margin-bottom: 40px">

    <div class="row" style="margin-top: 5rem">
        <div style="gap: 4rem;display:flex; justify-content: center">
            <button class="btn btn-secondary" href="#" onclick="checkLabel()"> CHECK ALL</button>
            <button class="btn btn-success" href="#" onclick="printLabel()"><i class="fa fa-print"></i> PRINT LABEL</button>
            {{-- <div style="display: flex; gap: 20px; align-items: center">
                <p style="margin: 0">Margin</p>
                <input type="range" min="0" max="0.2" step="0.1" value="0" id="margin">
                <span id="margin-val" style="width: 110px;white-space: nowrap;">0 inches</span>
            </div> --}}
        </div>
    </div>

    <div style="display: flex; justify-content: center; margin-top: 5rem">
        <div id="outer_wrapper">
            @foreach ($order_items as $order)
                <div style="display: flex; margin-top: 10px;padding-top:20px">
                    <div style="padding: 10px"><input type="checkbox" data-id="label-{{ $loop->index }}"></div>
                    <div style="outline: 5px solid green; padding: 10px;">
                        <div style="width: 1050px;height: 325px;" id="label-{{ $loop->index }}" class="my-print-page">
                            <div>
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
                                    <div class="col-xs-2" style="width:27.27%;overflow: hidden;white-space: nowrap;">{!! str_replace(' ', '&nbsp;', $order->project_tag) !!}</div>
                                    <div class="col-xs-2" style="width:15.15%;">{{ trim($order->due_date) }}</div>
                                    <div class="col-xs-2" style="width:10.60%;">{{ trim($order->width) }}&nbsp;{{ trim(float2rat((float) $order->width_decimal)) }}</div>
                                    <div class="col-xs-2" style="width:10.60%;">{{ trim($order->length) }}&nbsp;{{ trim(float2rat((float) $order->length_decimal)) }}</div>
                                    <div class="col-xs-2" style="width:12.12%;">{{ $order->quantity }}</div>
                                </div>
                                <div class="row" style="height: 122px;padding-inline:5px !important;">
                                    <div class="col-xs-4" style="font-weight:900;font-size: 24px;width:30%;overflow: hidden;white-space: nowrap;"> {!! str_replace(' ', '&nbsp;', $order->seller->name) !!}<br> {!! str_replace(' ', '&nbsp;', date('Y-m-d')) !!}</div>
                                    <div class="col-xs-4" style="width:70%;display: flex;justify-content: center;margin-top: 10px;">
                                        <div id="bar_code{{ $loop->index }}"></div>
                                    </div>
                                </div>
                                <div class="row" style="font-size: var(--print-font);">
                                    <div class="col-xs-2 headings" style="width:12.09%;padding-left:5px !important;">MOUNT</div>
                                    <div class="col-xs-2 headings" style="width:19.69%;">CONTROL&nbsp;&nbsp;TYPE</div>
                                    <div class="col-xs-2 headings" style="width:12.12%;">CHANNEL</div>
                                    <div class="col-xs-4 headings" style="width:22.75%;">FABRIC</div>
                                    <div class="col-xs-2 headings" style="width:13.63%;">CONFIG</div>
                                    <div class="col-xs-2 headings" style="width:19.69%;padding-right:5px !important;">AREA&nbsp;&nbsp;(ROOM)</div>
                                </div>
                                <div class="row" style="font-size: var(--print-font);padding-inline:5px !important;">
                                    <div class="col-xs-2" style="width:12.09%;overflow: hidden;white-space: nowrap;">{{ $order->mount_type }}</div>
                                    <div class="col-xs-2" style="width:19.69%; text-transform: capitalize;overflow: hidden;white-space: nowrap;">{{ $order->control_type }}</div>
                                    <div class="col-xs-2" style="width:12.12%; overflow: hidden;white-space: nowrap;">{{ $order->remote_ctrl_channel }}</div>
                                    <div class="col-xs-4" style="width:22.75%; overflow: hidden;white-space: nowrap;">{!! str_replace(' ', '&nbsp;', $order->fabric) !!} </div>
                                    @if (strtolower($order->control_type) == 'motor')
                                        <div class="col-xs-2" style="width:13.63%;overflow: hidden;white-space: nowrap;">{!! str_replace(' ', '&nbsp;', $order->motor_pos) !!}</div>
                                    @elseif(strtolower($order->control_type) == 'manual' && $order->cord_ctrl && strlen($order->cord_ctrl) > 0)
                                        <div class="col-xs-2" style="width:13.63%;overflow: hidden;white-space: nowrap;">{!! str_replace(' ', '&nbsp;', $order->cord_ctrl) !!}</div>
                                    @elseif(strtolower($order->control_type) == 'manual' && $order->chain_ctrl && strlen($order->chain_ctrl) > 0)
                                        <div class="col-xs-2" style="width:13.63%;overflow: hidden;white-space: nowrap;">{!! str_replace(' ', '&nbsp;', $order->chain_ctrl) !!}</div>
                                    @endif
                                    <div class="col-xs-2" style="width:19.69%;padding-left:0; overflow: hidden;white-space: nowrap;">{!! str_replace(' ', '&nbsp;', $order->room_type) !!}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6 text-right" style="margin-top:15px;">
            <button class="btn btn-success" href="#" onclick="printLabel()"><i class="fa fa-print"></i> PRINT LABEL</button>
        </div>

    </div>



    <script src="{{ static_asset('assets/js/jquery-barcode.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    @foreach ($order_items as $item)
        <script>
            $("#bar_code{{ $loop->index }}").barcode(
                "{{ $item->bar_code_number }}", // Value barcode (dependent on the type of barcode)
                "ean13", // type (string)
                {
                    "barWidth": 6,
                    "barHeight": 60,
                    fontSize: 23,
                }
            );
        </script>
    @endforeach

    <script>
        var orderItems = @json($order_items);

        var mainWidth = 1050;
        var mainHeight = 330;
        var mainRatio = mainWidth / mainHeight;

        function printLabel() {
            var checkedBoxes = document.querySelectorAll("input[type='checkbox']:checked");
            if (checkedBoxes.length == 0) {
                checkedBoxes = document.querySelectorAll("input[type='checkbox']");
            }

            var element = document.createElement("div");
            element.style.width = `${mainWidth}px`;

            checkedBoxes.forEach(c => {
                let ele = document.getElementById(c.dataset.id);
                if (ele) {
                    element.appendChild(ele.cloneNode(true));
                }
            });

            var opt = {
                margin: [0, 0],
                filename: 'label.pdf',
                image: {
                    type: 'png',
                    quality: 1
                },
                html2canvas: {
                    scale: 2,
                    x: 0,
                    y: 0,
                    scrollX: 0,
                    scrollY: 0,
                    windowWidth: mainWidth
                },
                jsPDF: {
                    unit: 'px',
                    format: [mainWidth, mainHeight],
                    orientation: 'l',
                    putOnlyUsedFonts: true,
                    pagesplit: true
                },
                pagebreak: {
                    after: ".my-print-page"
                }
            };
            html2pdf(element, opt);
        }

        function itemChange(select) {
            let index = select.value;
            let item = orderItems[index];
            console.log(item);
        }

        function checkLabel() {
            var checkedBoxes = document.querySelectorAll("input[type='checkbox']:checked");
            var allCheckedBoxes = document.querySelectorAll("input[type='checkbox']");

            if (checkedBoxes.length === allCheckedBoxes.length) {
                allCheckedBoxes.forEach(chk => {
                    chk.checked = false;
                });
            } else {
                allCheckedBoxes.forEach(chk => {
                    chk.checked = true;
                });
            }

        }
        if (document.getElementById("margin")) {
            document.getElementById("margin").addEventListener("input", e => {
                let val = parseFloat(e.target.value);
                document.getElementById("margin-val").textContent = val + " inches";

                let newWidth = (3.5 - val) * 300;
                let newHeight = newWidth / mainRatio;
                mainWidth = Math.ceil(newWidth);
                mainHeight = Math.ceil(newHeight);

                let scaleValue = newWidth / 1050;

                let allPages = document.querySelectorAll(".my-print-page");
                allPages.forEach(p => {
                    p.style.scale = scaleValue;
                    p.style.transform = `translateX(0px)`;
                    p.style.transformOrigin = "top left";
                    p.parentElement.style.height = `${Math.floor(newHeight)}px`;
                    p.parentElement.style.overflow = `hidden`;
                })

            });
        }
    </script>
</body>

</html>
