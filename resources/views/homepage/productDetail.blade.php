@extends('master')

@section('content')

<!-- slide -->
<div id="carouselExampleIndicators" class="carousel slide mt-2" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('uploads/banners/banner6.jpg') }}" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
	    <h1>Product Detail</h1>
	    <p>Welcome to store !!! </p>
	  </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- end slide -->

<!-- product detail -->

<div class="container">
	<div class="row mt-5">
		<!-- first column -->
		<div class="col-9">
			
			<div class="row">
				<div class="col-7">
					<div class="row">
						<div class="product-wrapper zoom-image">
							<img src="{{ asset('uploads/products/'.$product['image'][0]['image']) }}" alt="..." class="img-fluid img-thumbnail product-photo" style="height: auto;">	
						</div>
					</div>
					<div class="row mt-2">
						@foreach($product['image'] as $value)
						<div class="col-4">
							<img name="options" src="{{ asset('uploads/products/'.$value['image']) }}" alt="..." class="img-thumbnail">	
						</div>
						@endforeach
					</div>
				</div>
				<div class="col-5">
					<h4>{{ $product['pname'] }}</h4>
					<p>Price: {{ $product['base_price'] - ($product['base_price'] * $product['discount_rate'])/100 }}</p>
					<p>Seller: {{ $product['name'] }}</p>
					<p>Discount rate: {{ $product['discount_rate'] }} %</p>
					<button class="btn btn-primary">Add to cart</button>
				</div>
			</div>
		</div>
		<!-- end first column -->

		<!-- second column -->
		<div class="col-3">
			<!-- Grid row -->
			<div class="row">


			  <div class="col-md-12">

			    <!-- same category -->
			    <div class="card example-1 square scrollbar-dusty-grass square thin">
			      <div class="card-body">
			        <h4 id="section1"><strong>Product same category</strong></h4>
			        <hr>
			        @foreach($product_same as $value)
			        <p>
			        	<div class=" product-boder">
						<div class="card card-product mb-3">
						  <img class="card-img-top img-content" src="{{ asset('uploads/products/'). '/' . $value['image'][0]['image'] }}" alt="Card image cap">
						  <div class="card-body">
						    <h5 class="card-title product-title">{{ $value['name'] }}</h5>
						    <div class="card-text">
						    	<h4 class="sale-sticky">{{ $value['discount_rate'] }}%</h4>
						    	<span class="price">{{ $value['base_price'] - ($value['base_price'] * $value['discount_rate']) / 100 }} USD </span>
						    </div>
						    <div class="box-same-product">
					    	<a class="btn btn-info"><i class="fas fa-shopping-cart"></i></a>
					    	<?php $slug = str_slug($value['name'] ); ?>
					    	<a class="btn btn-outline-info" href="{{ url('products/'.$slug.'/'.$value['product_id']) }}">View detail</a>
					    	</div>
						  </div>
						</div>
					</div>
			        </p>
			        @endforeach
			      </div>
			    </div>
			    <!-- end same category -->

			    <!-- seller product-->
			    <div class="card example-1 square scrollbar-dusty-grass square thin mt-5">
			      <div class="card-body">
			        <h4 id="section1"><strong>Seller product</strong></h4>
			        <hr>
			        @foreach($seller_product as $value)
			        <p>
			        	<div class=" product-boder">
						<div class="card card-product mb-3">
						  <img class="card-img-top img-content" src="{{ asset('uploads/products/'). '/' . $value['image'][0]['image'] }}" alt="Card image cap">
						  <div class="card-body">
						    <h5 class="card-title product-title">{{ $value['name'] }}</h5>
						    <div class="card-text">
						    	<h4 class="sale-sticky">{{ $value['discount_rate'] }}%</h4>
						    	<span class="price">{{ $value['base_price'] - ($value['base_price'] * $value['discount_rate']) / 100 }} USD </span>
						    </div>
						    <div class="box-same-product">
					    	<a class="btn btn-info"><i class="fas fa-shopping-cart"></i></a>
					    	<?php $slug = str_slug($value['name'] ); ?>
					    	<a class="btn btn-outline-info" href="{{ url('products/'.$slug.'/'.$value['product_id']) }}">View detail</a>
					    	</div>
						  </div>
						</div>
					</div>
			        </p>
			        @endforeach
			      </div>
			    </div>
			    <!-- end seller product -->

			  </div>
			</div>
		</div>
</div>

<!-- end product detail  -->

@endsection