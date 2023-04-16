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
         .center{
               margin: 0 auto;
               width: 90vmin;
               padding-top: 60px;
               padding-bottom: 70px;
         }
         .th_design{
               background-color: #f7444e;
               color: white;
               font-size: 25px;
         }
         .total{
               text-align: center;
               font-size: 25px;
               color: #f7444e;
               padding-top: 40px;
               padding-block-end: 40px;
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
      <div class="hero_area">
         @include('home.header')
         @if (session()->has('message'))
            <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                     &times;
                  </button>
                  {{session()->get('message')}}
            </div>
         @endif
         <div class="center">
            <table
               <tr>
                  <th class="th_design">Name</th>
                  <th class="th_design">Image</th>
                  <th class="th_design">Quantity</th>
                  <th class="th_design">Unit price</th>
                  <th class="th_design">Total</th>
                  <th class="th_design">Action</th>
               </tr>
               <?php $total = 0; ?>
               @forelse($cart as $item)
                  <tr>
                     <td>{{$item->product_name}}</td>
                     <td>
                        <img src="/product/{{$item->image}}" width="250px" height="250px">
                     </td>
                     <td>{{$item->quantity}}</td>
                     <td>${{$item->unit_price}}</td>
                     <td>${{$item->quantity*$item->unit_price}}</td>
                     <td><a class="btn btn-danger" onclick="return confirm('Do you want to delete this?')" href="{{url('remove_cart/'.$item->id)}}">Remove</a></td>
                  </tr>
                  <?php $total = $total + $item->quantity*$item->unit_price; ?>
                  @empty
                  <tr>
                     <td colspan="6" style="text-align: center; font-size: 25px;"> <span style="color:#f7444e">Oops!</span> You haven't put anything in the cart yet.</td>
               @endforelse
            </table>
            @if ($total)
               <div>
                     <h3 class="total">Total: ${{$total}}</h3>
               </div>
               <div>
                     <a class="btn btn-primary" style="font-size: 25px;" href="{{url('checkout')}}">Checkout</a>
               </div>
            @else
               <div style="padding-top: 40px;">
                     <a class="btn btn-primary" style="font-size: 25px;" href="{{url('product_page')}}">Continue shopping</a>
               </div>
            @endif
         </div>
      </div>
      <!-- footer start -->
      <!-- footer end -->
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