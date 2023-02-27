<html>

<head>
    <meta name="viewport" content="width=1200, initial-scale=1">
    <title>Delivery Note</title>
    <meta http-equiv="Content-Type" content="text/html;" />
    <meta charset="UTF-8">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 25px;
            font-family: 'Lato', sans-serif;

        }

        table.blueTable {
            border: 1px solid #1C6EA4;
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        table.blueTable td,
        table.blueTable th {
            border: 1px solid #AAAAAA;
            padding: 3px 2px;
        }

        table.blueTable tbody td {
            font-size: 13px;
        }

        table.blueTable tr:nth-child(even) {
            background: #D0E4F5;
        }

        table.blueTable thead {
            background: #1C6EA4;
            background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
            background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
            background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
            border-bottom: 2px solid #444444;
        }

        table.blueTable thead th {
            font-size: 15px;
            font-weight: bold;
            color: #FFFFFF;
            text-align: center;
            border-left: 2px solid #D0E4F5;
        }

        table.blueTable thead th:first-child {
            border-left: none;
        }

        table.blueTable tfoot {
            font-size: 14px;
            font-weight: bold;
            color: #FFFFFF;
            background: #D0E4F5;
            background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
            background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
            background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
            border-top: 2px solid #444444;
        }

        table.blueTable tfoot td {
            font-size: 14px;
        }

        table.blueTable tfoot .links {
            text-align: right;
        }

        table.blueTable tfoot .links a {
            display: inline-block;
            background: #1C6EA4;
            color: #FFFFFF;
            padding: 2px 8px;
            border-radius: 5px;
        }

        .print_btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        @media  print {
            .no_print {
                visibility: hidden;
            }
        }
    </style>
</head>


</body>
<?php if(isset($find_data[0])): ?>
    <div class="row" style="margin-bottom:25px;width:50%;">
        <div class="col-md-6">
            <table class="blueTable">
                <tbody>
                    <tr>
                        <td>Order ID</td>
                        <td><?php echo e($order->order_no); ?></td>
                    </tr>
                    <tr>
                        <td>Side Mark</td>
                        <td><?php echo e(ucwords($seller->company_name)); ?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo e(ucwords($seller->name)); ?></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td><?php echo e(isset($mainOrderFirstItem) && $mainOrderFirstItem ? \Carbon\Carbon::parse($mainOrderFirstItem->date)->toDateString() : today()->toDateString()); ?></td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td><?php echo e(isset($mainOrderFirstItem) && $mainOrderFirstItem ? $mainOrderFirstItem->due_date : today()->toDateString()); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <table class="blueTable">
        <thead>
            <tr>
                <th>Item #</th>
                <th>Width</th>
                <th>Length</th>
                <th>Shades</th>
                <th>Fascia</th>
                <th>Tube</th>
                <th>Bottom Rail</th>
                <th>Bottom Tube</th>
                <th>Fabric Width</th>
                <th>Fabric Height</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $find_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><b><?php echo e(optional($item->order_item)->order_number); ?></b></td>
                    <td><?php echo e($item->width); ?></td>
                    <td><?php echo e($item->length); ?></td>
                    <td><?php echo e($item->shades); ?></td>
                    <td><?php echo e($item->fascia); ?></td>
                    <td><?php echo e($item->tube); ?></td>
                    <td><?php echo e($item->bottom_rail); ?></td>
                    <td><?php echo e($item->bottom_tube); ?></td>
                    <td><?php echo e($item->fabric_width); ?></td>
                    <td><?php echo e($item->fabric_height); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </tr>
    </table>
    <div>
        <div class="">
            <button type="button" class="no_print print_btn" onclick="window.print()">PRINT</button>
        </div>
    </div>
<?php else: ?>
    Sorry, You havn't filled the production form.
<?php endif; ?>
</body>

</html>
<?php /**PATH F:\xampp7\htdocs\ERP\resources\views/backend/production/view_production.blade.php ENDPATH**/ ?>