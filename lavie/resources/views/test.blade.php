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

	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<!-- menu navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<div class="container">
		<a class="navbar-brand" href="#">Navbar</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Link</a>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link" href="#" id="navbarDropdown">
		          Dropdown
		        </a>
		        <div class="dropdown-content">
		          <a class="dropdown-item" href="#">Action</a>
		          <a class="dropdown-item" href="#">Another action</a>
		          <div class="dropdown-divider"></div>
		          <a class="dropdown-item" href="#">Something else here</a>
		        </div>
		      </li>
		    </ul>
		    <form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		    </form>
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

<!-- list product -->
<div class="container">
	<div class="row mt-5">
		<h2 class="list-product-title">New Product</h2>
		<div class="list-product-subtitle">
			<p>List proc descrip</p>
		</div>
		<div class="product-group">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>	
			</div>
		</div>
		<div class="product-group">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>	
			</div>
		</div>
		<div class="product-group">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row justify-content-center">
		<nav aria-label="Page navigation example">
		  <ul class="pagination">
		    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
		    <li class="page-item"><a class="page-link" href="#">1</a></li>
		    <li class="page-item"><a class="page-link" href="#">2</a></li>
		    <li class="page-item"><a class="page-link" href="#">3</a></li>
		    <li class="page-item"><a class="page-link" href="#">Next</a></li>
		  </ul>
		</nav>
	</div>
</div>
<!-- end list product -->

<!-- list Best sales product -->
<div class="container">
	<div class="row mt-5">
		<h2 class="list-product-title">best sales</h2>
		<div class="list-product-subtitle">
			<p>top 12 product</p>
		</div>
		<div class="product-group">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>	
			</div>
		</div>
		<div class="product-group">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>	
			</div>
		</div>
		<div class="product-group">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
					<div class="card card-product mb-3">
					  <img class="card-img-top" src="https://via.placeholder.com/280x280" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title product-title">Product</h5>
					    <div class="card-text">
					    	<span class="discount-rate">123</span>
					    	<span class="price">1000 USD</span>
					    </div>
				    	<a class="btn btn-info btn-add-to-card"><i class="fas fa-shopping-cart"></i></a>
				    	<a class="btn btn-outline-info">View detail</a>
					  </div>
					</div>
				</div>	
			</div>
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