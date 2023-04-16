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
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>#theThing</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>

      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->

      <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width: 50%; padding: 30px;">
         <div class="box">
            <div class="img-box" style="padding: 10px;">
               <img src="product/{{$product->image}}" alt="">
            </div>
            <div class="detail-box">
               <h5>
                  {{$product->name}}
               </h5>
               <h6>
                  @if($product->discount != null)
                     <p style="color: tomato;">
                        Discount: ${{$product->discount}}
                     </p>
                     <p>
                        List Price: <span style="color: black; text-decoration: line-through">${{$product->price}}</span>
                     </p>
                  @else
                     <p style="color:darkblue;">
                        Price: ${{$product->price}}
                     </p>
                  @endif
                  <h6>Category: {{$product->category}}</h6>
                  <h6>Description: {{$product->description}}</h6>
                  <h6>Available: {{$product->quantity}}</h6>
                  <form action="{{url('add_cart',$product->id)}}" method="POST">
                     @csrf
                     <div class="row">
                        <div class="col-md-4">
                           <input type="number" style="width: 65px" name="quantity" value="1" min="1" max="{{$product->quantity}}">
                        </div>
                        <div class="col-md-4">
                           <input type="submit" value="Add to Cart" class="" style="padding: 10px;">
                        </div>
                     </div>
                  </form>
               </h6>
            </div>
         </div>
      </div>
      </div>
      
      <!-- footer start -->
      @include('home.footer')
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