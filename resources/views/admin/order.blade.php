<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    @include('admin.css')
    <style type="text/css">
        .tb_design {
            margin: auto;
            width: 90%;
            border: 2px solid white;
            margin-top: 40px;
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
               border: 1px solid white;
               border-collapse: collapse;
         }
         th, td {
               padding: 15px;
               text-align: left;
         }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                         {{session()->get('message')}}
                    </div>
                @endif
                <h1 class="h1_style">All Order:</h1>
                <div style="padding-botoom: 40px; padding-left: 5%;">
                    <form action="{{url('search_order')}}" method="GET">
                        @csrf
                        <input type="text" style="color: black;" name="search" placeholder="Search...">
                        <input type="submit" value="Search" class="btn btn-outline-primary">
                    </form>
                </div>
                <table class="tb_design">
                    <tr>
                        <th class="th_color">Name</th>
                        <th class="th_color">Email</th>
                        <th class="th_color">Phone</th>
                        <th class="th_color">Address</th>
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
                        <th>{{$order->user_name}}</th>
                        <th>{{$order->email}}</th>
                        <th>{{$order->phone}}</th>
                        <th>{{$order->address}}</th>
                        <th>{{$order->product_name}}</th>
                        <th>
                            <img src="product/{{$order->image}}" width="100px" height="100px" class="img_size">
                        </th>
                        <th>{{$order->quantity}}</th>
                        <th>${{$order->price}}</th>
                        <th>${{$order->price*$order->quantity}}</th>
                        <th>{{$order->status}}</th>
                        @if ($order->status == 'Pending')
                            <th> <a href="{{url('delivery',$order->id)}}" class="btn btn-success">Delivery</a> </th>
                        @elseif ($order->status == 'Delivering')
                            <th> <a href="{{url('complete_order',$order->id)}}" class="btn btn-primary">Complete</a> </th>
                        @elseif ($order->status == 'Completed')
                            <th> <span style="color: green;">Completed</span></th>
                        @elseif ($order->status == 'Cancelled')
                            <th> <span style="color: #f7444e;">Cancelled</span></th>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <th colspan="11" style="text-align: center; color: white;">Oops! No Order Found!</th>
                    @endforelse
                </table>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.js')
  </body>
</html>