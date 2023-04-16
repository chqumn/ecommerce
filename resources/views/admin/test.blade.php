<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    @include('admin.css')
    <style type="text/css">
        .debai {
            margin: auto;
            width: 70%;
            border: 2px solid white;
            margin-top: 40px;
            padding: 20px;
        }

        .dapan {
            margin: auto;
            width: 70%;
            margin-top: 40px;
            padding: 20px;
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
                <div class="debai">
                    <h1>
                        Câu 2 (4đ): Giả sử trong cơ sở dữ liệu của một hệ thống thương mại điện tử có bảng donhang (đơn hàng) với các thuộc tính 
                        (mã đơn hàng, ngày đơn hàng, tên khách hàng, tổng tiền). Sử dụng Laravel, hay viết các câu lệnh sau:
                    </h1>
                    <h2>
                        a)	Lấy ra mã đơn hàng, ngày đơn hàng và tên khách hàng mua đơn hàng với tổng tiền lớn nhất
                    </h2>
                    <h2>
                        b)	Lấy ra trung bình tổng tiền của các đơn hàng
                    </h2>
                    <h2>
                        c)	Lấy ra tổng doanh số bán hàng trong tháng 2 năm 2020
                    </h2>
                    <h2>
                        d)	Lấy ra tên khách hàng có nhiều đơn hàng nhất
                    </h2>
                </div>
                <div class="dapan">
                    <div>
                        <p>a:</p>
                        <p>
                            {{-- {{$order = DB::table('orders')->select('user_name', 'product_name', 'price')->orderBy('price', 'desc')->first()}}; --}}
                        </p>
                        <p>
                            Kết quả:
                            <br>
                            Ten khach hang: {{$order}}

                            
                        </p>
                    </div>
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