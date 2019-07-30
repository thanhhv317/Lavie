@extends('master')

@section('content')

<!-- slide -->
<div id="carouselExampleIndicators" class="carousel slide mt-2" data-ride="carousel">
  	<div class="carousel-inner">
	    <div class="carousel-item active">
	        <img class="d-block w-100" src="{{ asset('uploads/banners/banner2.jpg') }}" alt="First slide">
	        <div class="carousel-caption d-none d-md-block">
		    	<h1>Cart</h1>
		    </div>
	    </div>
  	</div>
</div>
<!-- end slide -->

<div class="container">
	<div class="row">
		<table class="table mt-4 table-responsive-sm table-hover">
		  	<thead class="thead-light">
			    <tr class="list-cart-product">
			        <th scope="col">Product</th>
			        <th scope="col">Price</th>
			        <th scope="col">Quantity</th>
			        <th scope="col">Total Price</th>
			        <th scope="col">Action</th>
			    </tr>
			</thead>
			<tbody class="append-product">
	
	 	 	</tbody>
		</table>
	</div>
	<hr>

	<div class="row">
		<div class="col-12 col-md-6">
			<table class="table table-striped">
			  <tbody>
			    <tr >
			        <th scope="row">total quantity</th>
			        <td class="total-quantity-all-product">0</td>
			    </tr>
			    <tr class="table-info">
			        <th scope="row">total Price</th>
			        <td><b class="total-price-all-product">0</b> USD</td>
			    </tr>
			  </tbody>
			</table>
		</div>

		<div class="col-12 col-md-6">
			<div>
				<h3>Delivery cost: <b class="delivery-cost">0</b> USD</h3>
			</div>
		</div>
	</div>
		
	<div class="row justify-content-end">
		<button class="btn btn-outline-danger btn-clear-cart"><i class="fas fa-times"></i> Clear cart</button>
		@if(Auth::user())
		<a class="btn btn-outline-primary ml-2 btn-payment" href="{{ route('buyer.payment') }}"><i class="far fa-credit-card"></i> Continue Payment</a>
		@else
		<a class="btn btn-outline-primary ml-2 btn-payment" href="{{ route('buyer.signin') }}"><i class="far fa-credit-card"></i> Continue Payment</a>
		@endif
	</div>

</div>
<script type="text/javascript" src="{{ asset('js/cart.js') }}"></script>

@endsection