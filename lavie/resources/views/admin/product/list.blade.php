@extends('admin.master')

@section('content')
<div class="breadcrumb">
    	<div class="col-auto btn-add">
    		<a href="{{ route('seller.product.new') }}" class="btn btn-primary">Add Product</a>
    	</div>
</div>

<div class="container">
	<div class="row">
		@if (count($product) == 0)
			<h2>You do not have any products</h2>
		@endif
		<?php $check = []; ?>
		@foreach ($product as $value)
		@if (in_array($value['product_id'],$check))
		@else
		<?php $check[] = $value['product_id']; ?>
		<div class="col-lg-4 col-md-6 col-12  mt-2 mb-3">
			<form method="POST" action="{{ url('seller/product/delProduct', $value['product_id']) }}">
			@csrf
			<div class="card" style="width: 18rem;">
			    <img class="card-img-top img-content" src="{{ asset('uploads/products/').'/'.$value['image'][0]['image'] }}" alt="Card image cap">
			    <div class="card-body">
			        <h5 class="card-title">{{ $value['pname'] }}</h5>
			        </div>
			    <ul class="list-group list-group-flush">
			        <li class="list-group-item">Real price: <b>
	        			<?php $max = 0; ?>
			        	@foreach($value['agen_pro'] as $item)
			        		<?php 
			        			if($max < $item['discount_rate']) $max = $item['discount_rate'];
			        		?>
			        	@endforeach
			        </b>{{ $value['base_price'] - ($value['base_price'] * $max) / 100 }} USD</li>
			    </ul>
			    <div class="card-body">
			        <a href="{{ url('seller/product/edit',$value['product_id']) }}" class="card-link btn btn-success">Edit</a>
			        <input type="submit" name="submit" class="btn btn-danger" value="Delete">
			    </div>
			</div>
			</form>
		</div>
		@endif
		@endforeach
	</div>
</div>

<div class="container row justify-content-center">
	{{ $product->render('vendor.pagination.name') }}
</div>

@endsection()