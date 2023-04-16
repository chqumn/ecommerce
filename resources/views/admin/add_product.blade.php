<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    @include('admin.css')
    <style type="text/css">
        .div_center{
            text-align: center;
            margin-top: 40px;
        }
        .h1_size{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .input_color{
            color: black;
        }
        label{
            display: inline-block;
            width: 200px;
        }
        select{
            display: inline-block;
            width: 225px;
        }
        .div_gap{
            padding-top: 20px;
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
                <div class="div_center">
                    <h1 class="h1_size">Add Product</h1>
                    <form action="{{url('add_product')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_gap">
                            <label for="">Name(*):</label>
                            <input class="input_color" type="text" name="name" placeholder="Write product's name" required="">
                        </div>
                        <div class="div_gap">
                            <label for="">Description:</label>
                            <input class="input_color" type="text" name="description" placeholder="Write description">
                        </div>
                        <div class="div_gap">
                            <label for="">Price(*):</label>
                            <input class="input_color" type="number" min="0" name="price" placeholder="List price" required>
                        </div>
                        <div class="div_gap">
                            <label for="">Discount Price:</label>
                            <input class="input_color" type="number" min="0" name="discount" placeholder="Discount price">
                        </div>
                        <div class="div_gap">
                            <label for="">Quantity(*):</label>
                            <input class="input_color" type="number" min="0" name="quantity" placeholder="Number of product" required>
                        </div>
                        <div class="div_gap">
                            <label for="">Category(*):</label>
                            <select class="input_color" name="category" required>
                                <option value="" selected>Choose a category</option>
                                @foreach ($category as $category)
                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="div_gap">
                            <label for="">Image(*):</label>
                            <input type="file" name="image" required>
                        </div>
                        <div class="div_gap">
                            <input type="submit" value="Add Product" class="btn btn-primary">
                        </div>
                    </form>
                </div>
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