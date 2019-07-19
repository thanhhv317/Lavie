@extends('admin.master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    	<div class="col-auto btn-add">
    		<a href="{{ route('seller.product.new') }}" class="btn btn-primary">Add Product</a>
    	</div>
    </ol>
</nav>

<div class="container">
	<div class="row">
		@if (count($product) == 0)
			<h2>You do not have any products</h2>
		@endif
		@foreach ($product as $value)
		<div class="col-4 mt-2 mb-3">
			<form method="POST" action="{{ url('seller/product/delProduct', $value['id']) }}">
			@csrf
			<div class="card" style="width: 18rem;">
			    <img class="card-img-top img-content" src="{{ asset('uploads/products/').'/'.$value['image'][0]['image'] }}" alt="Card image cap">
			    <div class="card-body">
			        <h5 class="card-title">{{ $value['name'] }}</h5>
			        </div>
			    <ul class="list-group list-group-flush">
			        <li class="list-group-item">Base price: <b>{{ $value['base_price'] }}</b> USD</li>
			    </ul>
			    <div class="card-body">
			        <a href="{{ url('seller/product/edit',$value['id']) }}" class="card-link btn btn-success">Edit</a>
			        <input type="submit" name="submit" class="btn btn-danger" value="Delete">
			    </div>
			</div>
			</form>
		</div>
		@endforeach
	</div>
</div>

<div class="container row justify-content-center">
	<nav aria-label="Page navigation example">
	  <ul class="pagination">
	  	@if($product->onFirstPage())
	    <li class="page-item disabled"><a class="page-link" href="{{ $product->previousPageUrl() }}">Previous</a></li>
	    @else
	    <li class="page-item"><a class="page-link" href="{{ $product->previousPageUrl() }}">Previous</a></li>
	    @endif

	    <li class="page-item"><a class="page-link" href="#">1</a></li>
	    <li class="page-item"><a class="page-link" href="#">2</a></li>
	    <li class="page-item"><a class="page-link" href="{{ $product->url(3) }}">3</a></li>
	    @if($product->lastPage() == $product->currentPage())
	    <li class="page-item disabled"><a class="page-link" href="{{ $product->nextPageUrl() }}">Next</a></li>
	    @else
	    <li class="page-item"><a class="page-link" href="{{ $product->nextPageUrl() }}">Next</a></li>
	    @endif
	  </ul>
	</nav>
</div>

<?php  ?>

@endsection()