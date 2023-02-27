<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Order Invoice</title>

  <style>
      .mt6 {
        margin-top: 6px;
      }
      .mt12 {
        margin-top: 12px;
      }
      .mt18 {
        margin-top: 18px;
      }
      .mt24 {
        margin-top: 24px;
      }
      .mt30 {
        margin-top: 30px;
      }
      .ml6 {
        margin-left: 6px;
      }
      .ml12 {
        margin-left: 12px;
      }
      .ml18 {
        margin-left: 18px;
      }
      .ml24 {
        margin-left: 24px;
      }
      .ml30 {
        margin-left: 30px;
      }
      .mb6 {
        margin-bottom: 6px;
      }
      .mb12 {
        margin-bottom: 12px;
      }
      .mb18 {
        margin-bottom: 18px;
      }
      .mb24 {
        margin-bottom: 24px;
      }
      .mb30 {
        margin-bottom: 30px;
      }
      .mr6 {
        margin-right: 6px;
      }
      .mr12 {
        margin-right: 12px;
      }
      .mr18 {
        margin-right: 18px;
      }
      .mr24 {
        margin-right: 24px;
      }
      .mr30 {
        margin-right: 30px;
      }

      
      .pt6 {
        padding-top: 6px;
      }
      .pt12 {
        padding-top: 12px;
      }
      .pt18 {
        padding-top: 18px;
      }
      .pt24 {
        padding-top: 24px;
      }
      .pt30 {
        padding-top: 30px;
      }
      .pl6 {
        padding-left: 6px;
      }
      .pl12 {
        padding-left: 12px;
      }
      .pl18 {
        padding-left: 18px;
      }
      .pl24 {
        padding-left: 24px;
      }
      .pl30 {
        padding-left: 30px;
      }
      .pb6 {
        padding-bottom: 6px;
      }
      .pb12 {
        padding-bottom: 12px;
      }
      .pb18 {
        padding-bottom: 18px;
      }
      .pb24 {
        padding-bottom: 24px;
      }
      .pb30 {
        padding-bottom: 30px;
      }
      .pr6 {
        padding-right: 6px;
      }
      .pr12 {
        padding-right: 12px;
      }
      .pr18 {
        padding-right: 18px;
      }
      .pr24 {
        padding-right: 24px;
      }
      .pr30 {
        padding-right: 30px;
      }
      
      .size30 {
          font-size: 30px;
      }
      .size28 {
          font-size: 28px;
      }
      .size26 {
          font-size: 26px;
      }
      .size25 {
          font-size: 25px;
      }
      .size24 {
          font-size: 24px;
      }
      .size22 {
          font-size: 22px;
      }
      .size20 {
          font-size: 20px;
      }
      .size18 {
          font-size: 18px;
      }
      .size17 {
          font-size: 17px;
      }
      .size16 {
          font-size: 16px;
      }
      .size15 {
          font-size: 15px;
      }
      .size14 {
          font-size: 14px;
      }
      .size13 {
          font-size: 13px;
      }
      .size12 {
          font-size: 12px;
      }
      .size11 {
          font-size: 11px;
      }

      .b4 {
          font-weight: 400 !important;
      }
      .b6 {
          font-weight: 600 !important;
      }
      .b8 {
          font-weight: 800 !important;
      }

      .tl {
          text-align: left !important;
      }
      .tr {
          text-align: right !important;
      }
      .tj {
          text-align: justify !important;
      }
      .tc {
          text-align: center !important;
      }
      
      .t_uCase {
          text-transform: uppercase;
      }

      .t_lCase {
          text-transform: lowercase;
      }

      .t_cap {
          text-transform: capitalize;
      }

      .centre {
          display: flex;
          flex-direction: column;
          align-items: center;
          /* it center the item vertically */
          justify-content: center;
          /* it center the item horizontally */
      }

      .verCen {
          margin: auto;
      }

      .verAuto {
          vertical-align: baseline !important;
          /* vertical-align: middle !important; */
      }
      
      .clear {
          clear: both;
      }

      .float_r {
          float: right;
      }

      .float_l {
          float: left;
      }

      .d_in {
          display: inline;
      }

      .d_b {
          display: block;
      }

      .d_in_b {
          display: inline-block;
      }

      .cl_gdd {
        color: #5E5873;
      }
      .cl_gd {
        color: #777289;
      }
      .cl_gm {
        color: #B7B6BE;
      }
      .cl_gl {
        color: #F3F2F7;
      }

      * {
        font-family: 'Montserrat';
      }

      body {
        background-color: #e8e8e8;
      }
      p {
        margin: 7px 0px !important;
      }
      hr {
          border: 1px solid rgba(0, 0, 0, 0.1);
      }

      .body{
        background-color: #e6e5e5;
        padding: 50px 0px;
      }
      .invoce_body {
        width: 700px;
        background-color: white !important;
        border: 1px solid #cccccc;
        border-radius: 5px;
        margin: auto;
      }

      .invoice_header > .sec1{
        display: inline-block;
        width: 69.3%;
        vertical-align: middle; 
      }
      .invoice_header > .sec2{
        display: inline-block;
        width: 30%;
        vertical-align: top; 
      }
      .invoice_header2 > .sec1{
        display: inline-block;
        width: 49.3%;
        vertical-align: top; 
      }
      .invoice_header2 > .sec2{
        display: inline-block;
        width: 50%;
        vertical-align: top; 
      }
      .invoice_header2 > .sec2 > .sec1 > p.sec1{
        display: inline-block;
        width: 50%;
        vertical-align: top; 
        margin-top: 0px !important
      }
      .invoice_header2 > .sec2 > .sec1 > p.sec2{
        display: inline-block;
        width: 45.5%;
        vertical-align: top; 
        margin-top: 0px !important
      }
      
      table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 60px;
      }
      
      table th {
        font-weight: 600;
        padding: 12px 24px;
        color: #5D6975;
        background-color: whitesmoke;
        text-align: left;
      }
      
      th,
      td {
        font-size: 15px;
        padding: 10px 24px;
        /* text-align: center;
        vertical-align: middle; */
        border-top: 1px solid #ddd;
      }

      .invoice_footer {
        margin-top: 80px;
      }
      .invoice_footer > .sec1{
        display: inline-block;
        width: 60%;
        vertical-align: top; 
      }
      .invoice_footer > .sec2{
        display: inline-block;
        width: 38%;
        vertical-align: top; 
      }
      .invoice_footer > .sec2 p.sec1{
        display: inline-block;
        width: 60%;
        vertical-align: top; 
        margin-top: 0px !important;
      }
      .invoice_footer > .sec2 p.sec2{
        display: inline-block;
        width: 38%;
        vertical-align: top; 
        margin-top: 0px !important;
        text-align: right;
      }

      .bottom_footer {
        margin-top: 60px;
      }

      footer {
        width: 700px;
        margin: auto;
      }
      
  </style>

  </head>
  <body>
    <section class="body">
      <section class="invoce_body">
        <div class="invoice_header pt24 pl30 pr30">
          <div class="sec2">
            <p class="size24 cl_gd  ">Invoice </p>
          </div>
        </div>

        <div class="invoice_header mt24 mb24 pl30 pr30">
          <div class="sec1">
            <h3>Address</h3>
            <p class="size16 cl_gd">Name: {{ $ship['name'] ?? '' }}</p>
            <p class="size16 cl_gd">Email: {{ $ship['email'] ?? '' }}</p>
            <p class="size16 cl_gd">Address1: {{ $ship['address'] ?? '' }}</p>
            <p class="size16 cl_gd">Address2: {{ $ship['address2'] ?? 'N/A' }}</p>
            <p class="size16 cl_gd">Country: {{ $ship['country'] ?? '' }}</p>
            <p class="size16 cl_gd">City: {{ $ship['city'] ?? '' }}</p>
            <p class="size16 cl_gd">Zip: {{ $ship['zip'] ?? '' }}</p>
          </div>
        </div>

        <hr>

        <div class="order_prescription">
          <!-- Invoice Description starts -->
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
          <hr>
          <h3>Order Items</h3>
          <table>
            <thead>
              <tr>
                <th>Order Number</th>
                <th>Product ID</th>
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
                <td>{{$item->quantity}}</td>
                <td>{{$item->unit_price}}</td>
                <td>{{$item->total_price}}</td>
                <td>{{$item->due_date}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="bottom_footer  pb24 pl30 pr30">
          <span class="size16 cl_gdd b6 pr6">Note:</span>
          <span class="size16 cl_gdd">Thank you for ordering with us!</span>
        </div>

      </section>

      <footer class="mt24">
        <p class="size16 cl_gdd tc">SHADEOTECH</p>
      </footer>
    </section>
  </body>
</html>
