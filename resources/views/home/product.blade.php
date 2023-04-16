<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>
            Our <span>products</span>
         </h2>
      </div>
      <form action="{{url('product_search')}}" method="GET" style="width: 50%; margin: auto;">
         @csrf
         <input type="text" name="search" placeholder="Search...">
         <input type="submit" value="Search"> 
      </form>
      <div class="row">
         @forelse ($product as $item)
            <div class="col-sm-6 col-md-4 col-lg-4">
               <div class="box">
                  <div class="option_container">
                     <div class="options">
                        <a href="{{url('product_details', $item->id)}}" class="option1">
                        Details
                        </a>
                        <form action="{{url('add_cart',$item->id)}}" method="POST">
                           @csrf
                           <div class="row">
                              <div class="col-md-4">
                                 <input type="number" style="width: 65px" name="quantity" value="1" min="1" max="{{$item->quantity}}">
                              </div>
                              <div class="col-md-4">
                                 <input type="submit" value="Add to Cart" class="option2" style="padding: 10px;">
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="img-box">
                     <img src="product/{{$item->image}}" alt="">
                  </div>
                  <div class="detail-box">
                     <h5>
                        {{$item->name}}
                     </h5>
                     <h6>
                        @if($item->discount != null)
                           <p style="color: tomato;">
                              ${{$item->discount}}
                           </p>
                           <p style="color: black; text-decoration: line-through">
                              ${{$item->price}}
                           </p>
                        @else
                           <p style="color:darkblue;">
                              ${{$item->price}}
                           </p>
                        @endif
                     </h6>
                  </div>
               </div>
            </div>
            @empty
                <div style="margin: auto; font-size: 40px;"> <span style="color: #f7444a;">Oops!</span> No Product Found!</div>
         @endforelse
      </div>
      <span style="padding-bottom: 500px;">
         {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
      </span>
   </div>
</section>