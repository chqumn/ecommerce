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
        padding-top: 40px;
      }
      .h2_font{
        font-size: 40px;
        font-weight: padding-bottom: 40px;
      }
      .input_color{
        color: black;
      }
      .center {
        margin: auto;
        width: 40%;
        text-align: center;
        margin-top: 30px;
        border: 3px solid white;
      }
      table, th, td {
        border: 1px solid white;
        border-collapse: collapse;
      }
      th, td {
        padding: 10px;
        text-align: left;
        font-size: 20px;
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
        <div class="main-panel">
          <div class="content-wrapper">
            @include('admin.navbar')
            <!-- partial -->
            @if (session()->has('message'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                  &times;
                </button>
                {{session()->get('message')}}
              </div>
            @endif
              <div class="div_center">
                <h2 class="h2_font">Add Category</h2> 
                <form action="{{url('/add_category')}}" method="POST">
                  @csrf
                  <input type="text" name="category" class="input_color" placeholder="Write category name">
                  <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                </form>
              </div>
              <table class="center">
                <tr>
                  <td>Category Name</td>
                  <td>Action</td>
                </tr>
                @foreach ($data as $category)
                  <tr>
                    <td style="">{{$category->category_name}}</td>
                    <td>
                      <a onclick="return confirm('Do you want to delete this?')" class="btn btn-danger" href="{{url('/delete_category/'.$category->id)}}">
                        Delete
                      </a>
                    </td>
                  </tr>  
                @endforeach
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