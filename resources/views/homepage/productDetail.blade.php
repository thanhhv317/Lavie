@extends('master')

@section('content')

<!-- slide -->
<div id="carouselExampleIndicators" class="carousel slide mt-2" data-ride="carousel">
    <div class="carousel-inner">
	    <div class="carousel-item active">
	      	<img class="d-block w-100" src="{{ asset('uploads/banners/banner6.jpg') }}" alt="First slide">
	      	<div class="carousel-caption d-none d-md-block">
		    	<h1>Product Detail</h1>
		  	</div>
	    </div>
    </div>
</div>
<!-- end slide -->

<!-- product detail -->

<div class="container">
	<div class="row mt-5">
		<!-- first column -->
		<div class="col-md-9 col-sm-12 col-12">
			<div class="row">
				<div class="col-md-7 col-sm-7 col-12">
					<div class="row">
						<div class="product-wrapper zoom-image imgBox">
							<img src="{{ asset('uploads/products/'.$product['image'][0]['image']) }}" alt="..." class="img-fluid img-thumbnail product-photo product-show">	
						</div>
					</div>
					<div class="row mt-2 box-content">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					  	<div class="carousel-inner">
					  		<?php $size = count($product['image']); $i=0;?>
							@foreach($product['image'] as $value)
							<?php ++$i; ?>
							@if($i %3 == 1 && $i<3)
						    	<div class="carousel-item active">
						    @elseif ($i %3 == 1 && $i>3)
						    	<div class="carousel-item">
						    @endif
						    @if($i%3 == 1)
						    	<div class="row">
						    @endif
						    		<div class="col-4">
						    			<a class="thumb-link" target="imgBox">
									      <img class="d-block w-100 img-item" src="{{ asset('uploads/products/'.$value['image']) }}" alt="First slide">
									  	</a>
							      	</div>
							@if ($i %3 == 0 || ($i % $size == 0))
								</div>
								</div>
							@endif
							@endforeach
					  	</div>
					  	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
					  	</a>
					  	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
					  	</a>
					</div>
											

					</div>
				</div>
				<div class="col-md-5 col-sm-5 col-12">
					<h4 class="product-name">{{ $product['pname'] }}</h4>
					<hr>
					<?php $price = $product['base_price'] - (($product['base_price'] * $product['discount_rate'])/100); ?>
					<p class="product-price">Price: <strong>{{ $price }} USD</strong>.</p>
					<p>Seller: {{ $product['name'] }}.</p>
					<p>Discount rate: {{ $product['discount_rate'] }} %.</p>
					<p>Categories: 
						@foreach ($product['categories'] as $value)
						<i class="box-cate mr-1">
							{{ $value['name'] }}
						</i>
						@endforeach
					</p>
					<p>
						<div>
						<button class="btn btn-outline-info sub-quantity" onclick="subQuantity()">-</button>
							<input class="box-quantity" type="text" name="quantity" value="1" >
						<button class="btn btn-outline-info add-quantity" onclick="addQuantity()">+</button>

						<i class="sum-quantity">
							{{ $product['sum_quantity'] }}
						</i>available.
						</div>
					</p>
					@if($product['sum_quantity'] < 1)
					<div class="box-error">
						<a href="{{ url('/') }}"><i class="fas fa-sign-out-alt"></i> Get out</a>
					</div>
					@else
					<button class="btn btn-outline-primary" onclick='addToCart({{ $product["user_id"] }}, {{ $product["product_id"] }}, "{{ $product["pname"] }}", {{ $price }}, getQuantityProduct(), `{{ asset("uploads/products"). "/" . $product["image"][0]["image"] }}` )' ><i class="fas fa-cart-arrow-down"></i> Add to cart</button>
					@endif
				</div>
			</div>
			<div class="mt-3 container">
				<hr>
				<h2>Description:</h2>
				<p>
					{{ $product['description'] }}
				</p>
			</div>
		</div>
		<!-- end first column -->

		<!-- second column -->
		<div class="col-md-3 col-sm-12 col-12">
			<!-- Grid row -->
			<div class="row">
			  	<div class="col-md-12">
				    <!-- same category -->
				    <h4 id="section1"><strong>Same category</strong></h4>
				    <div class="card example-1 square scrollbar-dusty-grass square thin">
				      	<div class="card-body">
				        @foreach($product_same as $value)
				        <p>
			        	<div class=" product-boder">
							<div class="card card-product mb-3">
							  	<img class="card-img-top img-content" src="{{ asset('uploads/products/'). '/' . $value['image'][0]['image'] }}" alt="Card image cap">
							  	<div class="card-body">
							    	<h5 class="card-title product-title">{{ $value['name'] }}</h5>
							    	<div class="card-text">
							    		<h4 class="sale-sticky">{{ $value['discount_rate'] }}%</h4>
							    		<?php $price = $value['base_price'] - (($value['base_price'] * $value['discount_rate']) / 100); ?>
							    		<span class="price">{{ $price }} USD </span>
							    	</div>
							    	<div class="box-same-product">
							    		@if ($value['sum_quantity'] > 0)
						    			<a class="btn btn-info" onclick='addToCart( {{ $value["user_id"] }}, {{ $value["id"] }}, "{{ $value["name"] }}", {{ $price }}, 1, `{{ asset("uploads/products"). "/" . $value["image"][0]["image"] }}` )'><i class="fas fa-shopping-cart"></i></a>
						    			@endif
						    			<a class="btn btn-outline-info" href="{{ url('products/'.$value['slug'].'/'.$value['product_id']) }}">View</a>
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
			    	<h4 class="mt-5" id="section1"><strong>Same seller</strong></h4>
				    <div class="card example-1 square scrollbar-dusty-grass square thin">
				      	<div class="card-body">
					        @foreach($seller_product as $value)
					        <p>
				        	<div class=" product-boder">
								<div class="card card-product mb-3">
								  	<img class="card-img-top img-content" src="{{ asset('uploads/products/'). '/' . $value['image'][0]['image'] }}" alt="Card image cap">
								  	<div class="card-body">
									    <h5 class="card-title product-title">{{ $value['pname'] }}</h5>
									    <div class="card-text">
									    	<h4 class="sale-sticky">{{ $value['discount_rate'] }}%</h4>
									    	<?php $price = $value['base_price'] - (($value['base_price'] * $value['discount_rate']) / 100); ?>
									    	<span class="price">{{ $price }} USD </span>
									    </div>
									    <div class="box-same-product">
									    	@if ($value['sum_quantity'] > 0)
								    		<a class="btn btn-info"><i class="fas fa-shopping-cart"  onclick='addToCart( {{ $value["user_id"] }}, {{ $value["product_id"] }}, "{{ $value["pname"] }}", {{ $price }}, 1, `{{ asset("uploads/products"). "/" . $value["image"][0]["image"] }}` )'></i></a>
								    		@endif
								    		<a class="btn btn-outline-info" href="{{ url('products/'.$value['slug'].'/'.$value['product_id']) }}">View</a>
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