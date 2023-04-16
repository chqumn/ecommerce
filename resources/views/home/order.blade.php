<!DOCTYPE html>
<html>
   <head>
      <base href="/public">
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="icon" href="home/images/favicon.png?v=2" type="">
      <title>#theThing</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style type="text/css">
        .tb_design {
            margin: auto;
            width: 80%;
            border: 2px solid white;
            margin-top: 40px;
            padding-bottom: 60px;
        }
        .h1_style {
            text-align: center;
            color: white;
            margin-top: 40px;
            font-size: 40px;
        }
        .img_size {
            width: 10vmax;
        }
        .th_color {
            background-color: tomato;
            color: white;
            padding: 10px;
            font-size: 20px;
        }
        table, th, td {
               border: 1px solid black;
               border-collapse: collapse;
         }
         th, td {
               padding: 15px;
               text-align: left;
         }
    </style>
   </head>
   <body>
        <div class="hero_area" style="padding-bottom: 100px;">
        <!-- header section strats -->
            @include('home.header')
            <!-- end header section -->
            <!-- slider section -->
            @if (session()->has('message'))
            <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    {{session()->get('message')}}
            </div>
            @endif
            
                <table class="tb_design">
                    <tr>
                        <th class="th_color">Product</th>
                        <th class="th_color">Image</th>
                        <th class="th_color">Quantity</th>
                        <th class="th_color">Price</th>
                        <th class="th_color">Total</th>
                        <th class="th_color">Status</th>
                        <th class="th_color">Action</th>
                    </tr>
                    @forelse($order as $order)
                    <tr>
                        <th>{{$order->product_name}}</th>
                        <th>
                            <img src="product/{{$order->image}}" width="100px" height="100px" class="img_size">
                        </th>
                        <th>{{$order->quantity}}</th>
                        <th>${{$order->price}}</th>
                        <th>${{$order->price*$order->quantity}}</th>
                        <th>{{$order->status}}</th>
                        @if ($order->status == 'Pending')
                            <th> <a href="{{url('cancel_order',$order->id)}}" onclick="confirm('Do you want to cancel this order?')" class="btn btn-danger">Cancel</a> </th>
                        @elseif ($order->status == 'Delivering')
                            <th> <span style="color:darkslategrey">Cannot cancel</span></th>
                        @elseif ($order->status == 'Completed')
                            <th> <span style="color: green;">Completed</span></th>
                        @elseif ($order->status == 'Cancelled')
                            <th> <span style="color: red;">Cancelled</span></th>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <th colspan="10" style="text-align: center; color: white;">Oops! No Order Found!</th>
                    </tr>
                    @endforelse
                </table>
        </div>
        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            
               Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
            
            </p>
         </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>