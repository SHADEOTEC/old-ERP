@extends('backend.layouts.app')

@section('mystyles')
    <style>
        @media print {
            .aiz-sidebar-wrap {
                display: none !important;
            }

            .aiz-content-wrapper {
                padding: 0 !important;
            }

            .aiz-topbar {
                display: none !important;
            }

            .aiz-titlebar {
                display: none !important;
            }

            .no-print {
                display: none !important;
            }

        }
    </style>
@endsection

@section('content')
    <div class="aiz-titlebar mt-2 mb-3 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">Production</h1>
            </div>
            <div class="col-md-6 text-md-right">

            </div>
        </div>
    </div>


    <div class="card">
        <form class="" id="sort_customers" action="" method="GET">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 d-flex flex-column">
                        <li style="list-style: none;"><strong>Invoice#:</strong> INV-{{ $mainOrder->order_no }}</li>
                        <li style="list-style: none;"><strong>Name:</strong> {{ $ship_addr->name }}</li>
                        <li style="list-style: none;"><strong>Location:</strong> {{ $ship_addr->country }}/{{ $ship_addr->city }}</li>
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-end">
                        <li style="list-style: none;"><strong>Address:</strong> {{ $ship_addr->address }} {{ $ship_addr->address2 }}</li>
                        <li style="list-style: none;"><strong>Zip:</strong> {{ $ship_addr->zip }}</li>
                        <li style="list-style: none;"><strong>Email:</strong> {{ $ship_addr->email }}</li>
                    </div>
                </div>


                <table class="mb-0 table text-center" style="">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Width</th>
                            <th>Length</th>
                            <th>Shade</th>
                            <th>Fascia</th>
                            <th>Tube</th>
                            <th>Bottom Rail</th>
                            <th>Bottom Tube</th>
                            <th>Fabric Width</th>
                            <th>Blind Width</th>
                            <th>Fabric Height</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $item)
                            <tr>
                                <td colspan="10">
                                    <div class="row">

                                        <li style="list-style: none; text-align: start;" class="col-md-6">Name: {{ $item->product->name }} </li>
                                        @if ($item->width != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Width: {{ $item->width }}, {{ float2rat($item->width_decimal) }}</li>
                                        @endif
                                        @if ($item->length != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Length: {{ $item->length }}, {{ float2rat($item->length_decimal) }}</li>
                                        @endif
                                        @if ($item->control_type != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Control Type:{{ $item->control_type }}</li>
                                        @endif
                                        @if ($item->motor_type != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Motor Type: {{ $item->motor_type }}</li>
                                        @endif
                                        @if ($item->motor_name != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Motor Name: {{ $item->motor_name }}</li>
                                        @endif
                                        @if ($item->motor_pos != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Position: {{ $item->motor_pos }}</li>
                                        @endif
                                        @if ($item->remote_ctrl_channel != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Remote: {{ $item->remote_ctrl_channel }}</li>
                                        @endif
                                        @if ($item->motor_array != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Motor Array{{ $item->motor_array }}</li>
                                        @endif
                                        @if ($item->chain_cord != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Manual: {{ $item->chain_cord }}</li>
                                        @endif
                                        @if ($item->chain_color != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Chain Color: {{ $item->chain_color }}</li>
                                        @endif
                                        @if ($item->chain_ctrl != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Control Position: {{ $item->chain_ctrl }}</li>
                                        @endif
                                        @if ($item->cord_ctrl != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Cord Position: {{ $item->cord_ctrl }}</li>
                                        @endif
                                        @if ($item->cord_color != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Cord Color: {{ $item->cord_color }}</li>
                                        @endif
                                        @if ($item->fabric != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Fabric: {{ $item->fabric }}</li>
                                        @endif
                                        @if ($item->mount_type != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Mount Type: {{ $item->mount_type }}</li>
                                        @endif

                                        @if ($item->cassette_type != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Cassette: {{ $item->cassette_type }}</li>
                                        @endif
                                        @if ($item->cassette_color != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Cassette Color: {{ $item->cassette_color }}</li>
                                        @endif
                                        @if ($item->brackets != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Brackets: {{ $item->brackets }}</li>
                                        @endif
                                        @if ($item->bracket_option_name != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Bracket Option: {{ $item->bracket_option_name }}</li>
                                        @endif
                                        @if ($item->shadoesmart_hub != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Shadoe Smart Hub</li>
                                        @endif
                                        @if ($item->solar_panel != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Solar Panel</li>
                                        @endif
                                        @if ($item->plug_in_charger != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Plug in Charger</li>
                                        @endif
                                        @if ($item->room_type != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Room Type: {{ $item->room_type }}</li>
                                        @endif
                                        @if ($item->window_desc != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Window: {{ $item->window_desc }}</li>
                                        @endif
                                        @if ($item->spring_assist != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Spring Assist</li>
                                        @endif
                                        @if ($item->sp_instructions != null)
                                            <li style="list-style: none; text-align: start;" class="col-md-3">Instructions: {{ $item->sp_instructions }}</li>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:middle;">{{ $item->order_id }}</td>
                                <td style="vertical-align:middle;">
                                    <input type="text" id="width_{{ $item->id }}" class="form-control measures text-center" value="{{ $item->width + $item->width_decimal }}">
                                </td>
                                <td style="vertical-align:middle;">
                                    <input type="text" id="length_{{ $item->id }}" class="form-control measures text-center" value="{{ $item->length + $item->length_decimal }}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" @if ($item->production) value="{{ $item->production->shades }}" @endif id="shade_{{ $item->id }}" name="shade_{{ $item->id }}" />
                                </td>
                                <td>
                                    <input class="form-control" type="text" @if ($item->production) value="{{ $item->production->fascia }}" @endif id="fascia_{{ $item->id }}" name="fascia_{{ $item->id }}" />
                                </td>
                                <td>
                                    <input class="form-control" type="text" @if ($item->production) value="{{ $item->production->tube }}" @endif id="tube_{{ $item->id }}" name="tube_{{ $item->id }}" />
                                </td>
                                <td>
                                    <input class="form-control" type="text" @if ($item->production) value="{{ $item->production->bottom_rail }}" @endif id="bot_rail_{{ $item->id }}"
                                           name="bot_rail_{{ $item->id }}" />
                                </td>
                                <td>
                                    <input class="form-control" type="text" @if ($item->production) value="{{ $item->production->bottom_tube }}" @endif id="bot_tube_{{ $item->id }}"
                                           name="bot_tube_{{ $item->id }}" />
                                </td>
                                <td>
                                    <input class="form-control" type="text" @if ($item->production) value="{{ $item->production->fabric_width }}" @endif id="fab_width_{{ $item->id }}"
                                           name="fab_width_{{ $item->id }}" />
                                </td>
                                <td>
                                    <input class="form-control" type="text" @if ($item->production) value="{{ $item->production->blind_width }}" @endif id="bli_width_{{ $item->id }}"
                                           name="bli_width_{{ $item->id }}" />
                                </td>
                                <td>
                                    <input class="form-control" type="text" @if ($item->production) value="{{ $item->production->fabric_height }}" @endif id="fab_height_{{ $item->id }}"
                                           name="fab_height_{{ $item->id }}" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <select class="form-control row_formula_select" data-num="{{ $item->id }}" name="formula_{{ $item->id }}" id="formula_{{ $item->id }}" required
                                            onchange="apply_formula('{{ $item->id }}')">
                                        <option value="">Select Formula</option>
                                        @foreach ($vendor as $list)
                                            <option value="{{ $list->id }}" @if ($item->production && $list->id === $item->production->vendor_id) selected @endif>{{ $list->vendor }}-{{ $list->formula }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td colspan="5"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end no-print mt-2">
                    <button type="button" class="btn btn-success mr-4" onclick="print()">Print</button>
                    <button type="button" class="btn btn-primary" onclick="saveFormulas()">Save</button>
                </div>

                <div class="aiz-pagination">

                </div>
            </div>
        </form>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('keydown', ".measures", function(e) {
            $("#formula option").prop("selected", false);
        });

        function apply_formula(num) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var vendor_id = $('#formula_' + num + ' option:selected').val() ? $('#formula_' + num + ' option:selected').val() : 0;
            var width = $('#width_' + num).val() ? $('#width_' + num).val() : 0;
            var length = $('#length_' + num).val() ? $('#length_' + num).val() : 0;
            $.ajax({
                url: "{{ route('production.apply_formula') }}",
                type: "post",
                data: {
                    vendor_id: vendor_id,
                    width: width,
                    length: length
                },
                success: function(result) {
                    $('#shade_' + num).val(result.shades);
                    $('#fascia_' + num).val(result.fascia);
                    $('#tube_' + num).val(result.tube);
                    $('#bot_rail_' + num).val(result.bottom_rail);
                    $('#bot_tube_' + num).val(result.bottom_tube);
                    $('#fab_width_' + num).val(result.fabric_width);
                    $('#fab_height_' + num).val(result.fabric_height);
                    $('#bli_width_' + num).val(result.blind_width);
                },
                error: function() {}
            });
        }

        function save_all_product() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var ord_id = "{{ $order_id }}";
            const data = [];
            for (let i = 0; i < $(".row_formula_select").length; i++) {
                const num = $($(".row_formula_select")[i]).data("num");
                let order_item_id = num;
                let vendor_id = $('#formula_' + num + ' option:selected').val() ? $('#formula_' + num + ' option:selected').val() : 0;
                let width = $('#width_' + num).val() ? $('#width_' + num).val() : 0;
                let length = $('#length_' + num).val() ? $('#length_' + num).val() : 0;
                let shade = $('#shade_' + num).val() ? $('#shade_' + num).val() : 0;
                let fascia = $('#fascia_' + num).val() ? $('#fascia_' + num).val() : 0;
                let tube = $('#tube_' + num).val() ? $('#tube_' + num).val() : 0;
                let bot_rail = $('#bot_rail_' + num).val() ? $('#bot_rail_' + num).val() : 0;
                let bot_tube = $('#bot_tube_' + num).val() ? $('#bot_tube_' + num).val() : 0;
                let fab_width = $('#fab_width_' + num).val() ? $('#fab_width_' + num).val() : 0;
                let fab_height = $('#fab_height_' + num).val() ? $('#fab_height_' + num).val() : 0;

                data.push({
                    order_id: ord_id,
                    order_item_id: order_item_id,
                    vendor_id: vendor_id,
                    width: width,
                    length: length,
                    shades: shade,
                    fascia: fascia,
                    tube: tube,
                    bot_rail: bot_rail,
                    bot_tube: bot_tube,
                    fab_width: fab_width,
                    fab_height: fab_height
                });

            }

            $.ajax({
                url: "{{ route('production.save_production') }}",
                type: "post",
                data: {
                    production: data
                },
                success: function(result) {
                    console.log(result);
                    if (result === "success") {
                        alert("Production data saved successfully");
                        window.location.href = `{{ route('seller_orders.index') }}`;
                    }
                },
                error: function() {
                    alert("Production data saving error");
                }
            });
        }

        function saveFormulas() {
            let validate = true;
            for (let i = 0; i < $(".row_formula_select").length; i++) {
                const element = $(".row_formula_select")[i];
                if (element.value == "") {
                    validate = false;
                    element.reportValidity();
                }
            }
            if (validate) {
                save_all_product();
            }

        }
    </script>
@endsection
