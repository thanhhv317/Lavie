@extends('master')

@section('content')

<!-- slide -->
<div id="carouselExampleIndicators" class="carousel slide mt-2" data-ride="carousel">
 	<div class="carousel-inner">
	    <div class="carousel-item active">
	      	<img class="d-block w-100" src="{{ asset('uploads/banners/banner8.jpg') }}" alt="slide">
	      	<div class="carousel-caption d-none d-md-block">
		    	<h1>Payment</h1>
		  	</div>
	    </div>
	</div>
</div>
<!-- end slide -->

<div class="container mt-4">
	<div class="row">
		<div class="col-12 col-md-7 append-product">
			<div class="justify-content-center">
				<h2 class="title-right">Your product</h2> 
			</div>
			<div class="row payment-product">
				
			</div>
		</div>

		<div class="col-12 col-md-5">
			<div class="justify-content-center">
				<h2 class="title-right">Please check your profile</h2> 
			</div>
			<hr>
			<form>
				@csrf
				<div class="form-group row">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
				    <div class="col-sm-10">
				    	<input type="text" class="form-control" id="b_id" placeholder="Your name" hidden="" value="{{ Auth::user()->id }}" name="b_id" required="">
				      	<input type="text" class="form-control" id="inputName" placeholder="Your name" value="{{ Auth::user()->name }}" name="b_name" required="">
				    </div>
			  	</div>
			  	<div class="form-group row">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Phone</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputPhone" placeholder="Your phone number" value="{{ Auth::user()->phone }}" name="phone" required="">
				    </div>
			  	</div>
			  	<div class="form-group row">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
				    <div class="col-sm-10">
				      	<input type="text" class="form-control" id="inputAddress" name="address" placeholder="Your address" value="{{ Auth::user()->address }}" required="">
				    </div>
			  	</div>
			  	<div class="form-group">
				  	<div class="form-check mb-2">
					  <input class="form-check-input" type="radio" name="pay" id="exampleRadios1" value="0" checked>
					  <label class="form-check-label" for="exampleRadios1"><i class="fas fa-money-bill-wave-alt"></i> Pay with cash upon delivery
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="pay" id="exampleRadios2" value="1">
					  <label class="form-check-label" for="exampleRadios2"><i class="fab fa-cc-paypal"></i> Pay with Paypal 
					  </label>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<hr>
		<table class="table">
		  	<thead class="thead-light">
			    <tr>
					<th scope="col">Total quantity</th>
					<th scope="col">Total Price</th>
					<th scope="col">Delivery cost</th>
					<th scope="col">Total</th>
					<th scope="col">Action</th>
			    </tr>
		  	</thead>
		  	<tbody>
			    <tr class="total-order">

			    </tr>
		  	</tbody>
		</table>
	</div>
</div>

<script type="text/javascript" src="{{ asset('js/payment.js') }}"></script>

@endsection