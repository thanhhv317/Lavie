<!DOCTYPE html>
<html>
<head>
	<title>hi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

	<!-- bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- fontawesome -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

	<!-- jquery price slider -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!-- bootstrap -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- end bootstrap -->

	<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

</head>
<body>
<!-- menu navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">Home</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		  	@guest
		  	@else
		      <li class="nav-item">
		        <a class="nav-link" href="{{ route('seller.product') }}">Product <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="{{ route('seller.agency') }}">Agency</a>
		      </li>
		    @endguest
		    </ul>
		    <form class="form-inline my-2 my-lg-0" action="{{ url('/') }}" method="post">
		    	@csrf
		      <input class="form-control mr-sm-2" name="name" type="search" title="Search by name product, category, agency" placeholder="Search" aria-label="Search">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		    </form>
		    <li class="nav-item dropdown">
		    	@guest
		    	<a class="nav-link" href="{{ route('login') }}" id="navbarDropdown">
		          Login
		        </a>
		      	@else
		    	<a class="nav-link" href="#" id="navbarDropdown">
		          {{ Auth::user()->name }}
		        </a>
		        <div class="dropdown-content">
		          <a class="dropdown-item" href="{{ route('seller.product') }}">View</a>
		          	<form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
		            <input type="submit" class="dropdown-item" value="Logout"/>
                    </form>
		      </li>

		      @endguest
		  </div>
	</div>
</nav>
<!-- end menu navbar -->

<!-- slide -->
<div id="carouselExampleIndicators" class="carousel slide mt-2" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://via.placeholder.com/1920x530" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://via.placeholder.com/1920x530" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://via.placeholder.com/1920x530" alt="Third slide">
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

<div id="top">Back to Top</div>

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
				<div class="col-xl-3 col-lg-4 col-md-6 col-12 ">
					<div class="card card-product mb-3">
					  <img class="card-img-top img-content" src="{{ asset('uploads/products'). '/' . $item['image'][0]['image']  }}" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">{{ $item['name'] }}</h5>
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
					    <div class="box-button">
				    	<a class="btn btn-info ml-4 mr-2 btn-add-to-card{{ ($qmax == 0) ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
				    	</div>
					  </div>
					  {!! isset($item['aname']) ? ('<p class="detail-product">Agency: '.$item['aname']."</p>") : "" !!}
					  {!! isset($item['cname']) ? ('<p class="detail-product">Category: '.$item['cname']."</p>") : "" !!}
					  {!! isset($item['uname']) ? ('<p class="detail-product">Seller: '.$item['uname']."</p>") : "" !!}
					  
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
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top img-content" src="{{ asset('uploads/products/'). '/' . $value->image[0]['image'] }}" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">{{ $value->name }}</h5>
					    <div class="card-text">
					    	<h4 class="sale-sticky">{{ $value['discount_rate'] }}%</h4>
					    	<h4 class="sale-sticky-best-sales">Best sale</h4>
					    	<span class="price">{{ $value['base_price'] - ($value['base_price'] * $value['discount_rate']) / 100 }} USD </span>
					    </div>
					    <div class="box-button">
				    	<a class="btn btn-info ml-4 mr-2 btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
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

<!-- footer page -->
<div class="mt-5">
	<div class="footer">
		<h1>Lavie</h1>
		<p>Contact: + 123123123</p>
		<i class="fas fa-circle-notch fa-spin"></i>
	</div>
</div>
<!-- end footer page -->

</body>
</html>