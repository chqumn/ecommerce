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
                <div style="padding-botoom: 40px; padding-left: 5%;">
                    <form action="{{url('search_product')}}" method="GET">
                        @csrf
                        <input type="text" style="color: black;" name="search" placeholder="Search...">
                        <input type="submit" value="Search" class="btn btn-outline-primary">
                    </form>
                </div>
                <h1 class="h1_style">Product list:</h1>
                <table class="tb_design">
                    <tr>
                        <th class="th_color">Name</th>
                        <th class="th_color">Description</th>
                        <th class="th_color">Price</th>
                        <th class="th_color">Discount</th>
                        <th class="th_color">Quantity</th>
                        <th class="th_color">Category</th>
                        <th class="th_color">Image</th>
                        <th class="th_color">Update</th>
                        <th class="th_color">Delete</th>
                    </tr>
                    @forelse ($data as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->discount}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->category}}</td>
                        <td>
                            <img class="img_size" src="/product/{{$product->image}}" alt="Product's image">
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{url('update_product', $product->id)}}">Update</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Do you want to delete this?')" href="{{url('delete_product', $product->id)}}">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" style="text-align: center;">Oops! No product found.</td>
                    </tr>
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