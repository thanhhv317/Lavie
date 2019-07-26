@extends('master')

@section('content')

<!-- slide -->
<div id="carouselExampleIndicators" class="carousel slide mt-2" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('uploads/banners/banner4.jpg') }}" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('uploads/banners/banner2.jpg') }}" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('uploads/banners/banner5.jpg') }}" alt="Third slide">
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

<!-- list product -->
<div class="container">
	<div class="row mt-5">
		<h2 class="list-product-title">New Product</h2>
		<div class="list-product-subtitle d-flex justify-content-end mb-3">
			<!-- <p>List proc descrip</p> -->
			
		    <div class="price-range">
		    	<p>
				  <label for="amount">Price range:</label>
				  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
				  <div id="slider-range"></div>
				</p>
		    </div>
		    <div class="btn-search-price ml-2"> 
		    <input class="btn btn-primary" type="button" name="searchByPrice" value="search" onclick="searchByPrice()">
		</div>
		</div>
	</div>
</div>
<br>

@if(isset($maxPrice))
<div class="container">
	<div class="row justify-content-center mb-4">
		<h4 class="filter-price">Product filter from ${{ $minPrice}} to ${{ $maxPrice}}</h4>
	</div>
</div>
@endif

<div class="container">
	<div class="row-mt-5">
		<div class="product-group">
			
			<?php $check = []; ?>
			<?php $i=0; ?>
			@foreach ($product as $item)
			@if (in_array($item['product_id'],$check))
			@else
			<?php $check[] = $item['product_id']; ?>
			<?php $i++; ?>
			@if($i % 4 == 1)
			<div class="row">
			@endif
				<div class="col-xl-3 col-lg-4 col-md-6 col-12 product-boder">
					<div class="card card-product mb-3">
					  <img class="card-img-top img-content" src="{{ asset('uploads/products'). '/' . $item['image'][0]['image']  }}" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">{{ $item['pname'] }}</h5>
					    <div class="card-text">
					   <?php $rmax = 0; $qmax = 0; ?>
			        	@foreach($item['agen_pro'] as $value)
			        		<?php 
			        			if($qmax < $value['quantity']) $qmax = $value['quantity'];
			        			if($rmax < $value['discount_rate']) $rmax = $value['discount_rate'];
			        		?>
			        	@endforeach
			        	@if($rmax == 0 && $qmax != 0) 
			        	<!-- haven't discount rate -->
			        		<span class="price">{{ $item['base_price'] }} USD</span>
			        	@elseif($rmax != 0 && $qmax != 0)
			        	<!-- have discount rate -->
					    	<h4 class="sale-sticky">{{ $rmax }}%</h4>
					    	<span class="price">{{ $item['base_price'] - ($item['base_price'] * $rmax) / 100 }} USD</span>
					    @else
					    	<span class="price">Out of store</span>
			        	@endif
					    </div>
					  {!! isset($item['aname']) ? ('<p class="detail-product">Agency: '.$item['aname']."</p>") : "" !!}
					  {!! isset($item['cname']) ? ('<p class="detail-product">Category: '.$item['cname']."</p>") : "" !!}
					  {!! isset($item['uname']) ? ('<p class="detail-product">Seller: '.$item['uname']."</p>") : "" !!}
					    <div class="box-null"></div>
					    <div class="box-button">
					    	<a class="btn btn-info ml-4 mr-2 btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
					    	<?php $slug = str_slug($item['pname']); ?>
					    	<a class="btn btn-outline-info" href="{{ url('products/'.$slug.'/'.$item['product_id']) }}">View detail</a>
				    	</div>
					  </div>
					  
					</div>
				</div>
			@if( $i % 4 == 0)
			</div>
			@endif
			@endif
			@endforeach
		</div>
	</div>
</div>


<div class="container">
	<div class="row justify-content-center">
		{{ $product->render('vendor.pagination.bootstrap-4') }}
	</div>
</div>
<!-- end list product -->

<div class="container">
	<hr>
</div>

<!-- list Best sales product -->
<div class="container">
	<div class="row mt-5">
		<h2 class="list-product-title">best sales</h2>
		<div class="list-product-subtitle">
			<p>top 12 product</p>
		</div>
		</div>
</div>
<div class="container">
	<div class="row-mt-5">
		<div class="product-group">
			<?php $j = 0; ?>
			@foreach($topsales as $value)
			<?php $j++; ?>
			@if ($j %4==1)
			<div class="row">
			@endif
				<div class="col-xl-3 col-lg-4 col-md-6 col-12 product-boder">
					<div class="card card-product mb-3">
					  <img class="card-img-top img-content" src="{{ asset('uploads/products/'). '/' . $value->image[0]['image'] }}" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">{{ $value->name }}</h5>
					    <div class="card-text">
					    	<h4 class="sale-sticky">{{ $value['discount_rate'] }}%</h4>
					    	<h4 class="sale-sticky-best-sales">Best sale</h4>
					    	<span class="price">{{ $value['base_price'] - ($value['base_price'] * $value['discount_rate']) / 100 }} USD </span>
					    </div>
					    <div class="box-null"></div>
					    <div class="box-button">
				    	<a class="btn btn-info ml-4 mr-2 btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<?php $slug = str_slug($value->name ); ?>
				    	<a class="btn btn-outline-info" href="{{ url('products/'.$slug.'/'.$value->product_id) }}">View detail</a>
				    	</div>
					  </div>
					</div>
				</div>
			@if($j%4==0 )	
			</div>
			@endif
			@endforeach
		</div>
	</div>
</div>
<!-- end list best sales product -->
@endsection()