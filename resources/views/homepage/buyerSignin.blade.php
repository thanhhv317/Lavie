@extends('master')

@section('content')

<!-- slide -->
<div id="carouselExampleIndicators" class="carousel slide mt-2" data-ride="carousel">
	<div class="carousel-inner">
	    <div class="carousel-item active">
	      	<img class="d-block w-100" src="{{ asset('uploads/banners/banner7.jpg') }}" alt="slide">
     	 	<div class="carousel-caption d-none d-md-block">
			    <h1>LOGIN</h1>
		  	</div>
	    </div>
  	</div>
</div>
<!-- end slide -->

<div class="container">
	<div class="row justify-content-center mt-3">
		<h1>LOGIN</h1>
	</div>
	<div class="row mt-3">
		<div class="col-12 col-md-6">
			<form>
			  <div class="form-group">
			    <label for="inputAddress">Email</label>
			    <input type="email" class="form-control" id="inputAddress" placeholder="1234@gmail.com">
			  </div>

			  <div class="form-group">
			    <label for="inputAddress2">Password</label>
			    <input type="password" class="form-control" id="inputAddress2" placeholder="">
			  </div>

			  
			  <button type="submit" class="btn btn-primary">Sign in</button>
			</form>
		</div>

		<div class="col-12 col-md-6">
			<div class="row justify-content-center">
				<a class="btn btn-danger buyer-login mt-5"  href="{{ url('auth/google') }}"><i class="fab fa-google-plus-square"></i> Login with Google</a>
			</div>
			<div class="row justify-content-center">
				<a class="btn btn-primary buyer-login mt-3" href="{{ url('auth/facebook') }}"><i class="fab fa-facebook-square"></i> Login with Facebook</a>
			</div>
		</div>
	</div>
</div>

</div>

@endsection