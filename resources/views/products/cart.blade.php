@include('layouts.font_header');




<div >
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0F6CB2;color:#EFFFEF; margin-top:14px;">
            <div class='container'>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav" style="text-transform:  uppercase;">
                        <li class="nav-item " >
                            <a class="nav-link" href="{{ url('/') }}">HOME <span class="sr-only">(current)</span></a>
                        </li>
@if ($categorys)
         @foreach ($categorys as $category)
      
    


                        <li class="nav-item">
                          <a class="nav-link" href="{{ url('product/category/'.$category->id) }}">{{$category->category_name}}</a>

                        </li>
          @endforeach             
@endif

                       
                    </ul>
                </div>
            </div>
        </nav>
    </div>






  <script>
   $(document).ready(function() {
    $("#CartMsg").hide();
    //$('#CartTotal').hide();
    @foreach($data as $product)
    $("#upCart{{$product->id}}").on('change keyup', function(){
      var newQty = $("#upCart{{$product->id}}").val();
      var rowID = $("#rowID{{$product->id}}").val();
      $.ajax({
          url:'{{url('/cart/update')}}',
          data:'rowID=' + rowID + '&newQty=' + newQty,
          type:'get',
      
       success: function() {   
        location.reload();  
       }
          // success:function(response){
          //   $("#CartMsg").show();
          //   console.log(response);
          //   $("#CartMsg").html(response);
          // }

      });
    });
    @endforeach
  $('#coupon_btn').click(function(){
      var coupon_id = $('#coupon_id').val();
      //alert(coupon_id);
      $.ajax({
        url:'{{url('/checkCoupon')}}',
        data: 'code=' + coupon_id,
        success:function(res){
       // alert(res);
       $('#cartTotal').html(res);
        }
      })
  });
   
  });
  </script>














<div class="cart_page" style="padding-top:100px;">


    <div class="container"style="background-color:#FFFFFF;">

        @if($data)
<div class="table-responsive">
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">Remove</th>


                <th scope="col">Image</th>
                <th scope="col">products</th>

                <th scope="col">Price</th>

                <th scope="col">Quantity</th>

                <th scope="col">Total</th>


            </tr>


            </thead>


            <tbody>


@foreach($data as $product)

            <tr>


                <th scope="row"><a style="font-size: 30px; color: red;" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash-o" aria-hidden="true"></i></a></th>
           {{--      <th scope="row"><a style="font-size: 30px; color: red;" href="{{ url('cart/remove') }}/{{$product->rowId}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></th> --}}

      <td> 



       <img width="100" src="{{ url('product_image') }}/{{ $product->options->image}}" alt="product image">

 
   </td>

                <td>{{$product->name}}</td>

                <td>{{$product->price}}</td>

                <td>
                    

                                <input type="hidden" value="{{$product->rowId}}"
                                       id="rowID{{$product->id}}"/>
                                    <div class="cart-qty"> <span>Qty : </span>
                                        <input type="number"  max="10" min="1"
                                        value="{{$product->qty}}" class="qty-fill"
                                        id="upCart{{$product->id}}" >
                                         <a class="btn btn-primary" href="{{ url('/cart') }}">update</a>
                                      </div>


                </td>

                <td>{{$product->total}}</td>




            </tr>




{{-- modal  --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="text-align: center;color: red;">are you sure want to delete cart??</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="{{ url('cart/remove') }}/{{$product->rowId}}"> delete</a>
      </div>
    </div>
  </div>
</div>
{{-- end modal  --}}





@endforeach

            </tbody>


        </table>
      </div>
@endif






        <div class="row">
            <div class="col-md-6">
                <div  class="text-left" style="padding-top:50px;padding-bottom:50px;">
                  <a href="{{ url('checkout') }}">
                    <button  class="btn btn-primary">proceed to checkout</button>
                    </a>
                </div>
            </div>


            <div class="col-md-6">
                <div  class=" text-right" style="padding-top:50px;padding-bottom:50px;">
                   {{--  <button  class="btn btn-primary ">update cart</button> --}}
                   <a class="btn btn-primary" href="{{ url('/') }}">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>



</div>

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> --}}

<!-- Modal -->















{{-- footer  --}}

<div class="footer">
<div class="container">
    <div class="row " >
        <div class="col-md-3 contact_inf">
            <h1>CONTACT US</h1>
            <div class="contact"><i class="fa fa-map-marker" aria-hidden="true"></i><a href="">Diu</a></div>
            <div class="contact"><i class="fa fa-mobile" aria-hidden="true"></i><a href="">+8801762 +8801762</a></div>
            <div class="contact"><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="">rabbi15-242@diu.edu.bd</a></div>



        </div>
        <div class="col-md-3 contact_inf">
            <h1>CUSTOMER SERVICE</h1>
            <div>
                <ul>
                    <li><a href="">My account</a></li>
                    <li><a href="">Wishlist</a></li>
                    <li><a href="">My cart</a></li>
                    <li><a href="">checkout</a></li>
                    <li><a href="">Login</a></li>
                </ul>
            </div>

        </div>
        <div class="col-md-3 contact_inf" >
            <h1>CORPORATION</h1>
            <div>
                <ul>
                    <li><a href="">My account</a></li>
                    <li><a href="">Wishlist</a></li>
                    <li><a href="">My cart</a></li>
                    <li><a href="">checkout</a></li>
                    <li><a href="">Login</a></li>
                </ul>
            </div>

        </div>
        <div class="col-md-3 contact_inf"  >
            <h1>WHY CHOOSE US</h1>
            <div>
                <ul>
                    <li><a href="">My account</a></li>
                    <li><a href="">Wishlist</a></li>
                    <li><a href="">My cart</a></li>
                    <li><a href="">checkout</a></li>
                    <li><a href="">Login</a></li>
                </ul>
            </div>

        </div>

    </div>


</div>

</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>