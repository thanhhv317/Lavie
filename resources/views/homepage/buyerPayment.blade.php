@extends('master')

@section('content')

<!-- slide -->
<div id="carouselExampleIndicators" class="carousel slide mt-2" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('uploads/banners/banner8.jpg') }}" alt="slide">
      <div class="carousel-caption d-none d-md-block">
	    <h1>Payment</h1>
	    <p>Welcome to store !!! </p>
	  </div>
    </div>
  </div>
</div>
<!-- end slide -->



@endsection