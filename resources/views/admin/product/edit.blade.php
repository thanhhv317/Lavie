@extends('admin.dashboard')


@section('content')
<div class="breadcrumb container">
	<div class="col-auto">
		<h1>EDIT PRODUCT</h1>
	</div>
</div>

@include('admin.blocks.error')

<div class="container">
<form  action="{{ route('seller.product.postEdit',$product['id']) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12 col-md-6">
		  <div class="form-group">
		    <label for="formGroupExampleInput">Product name:</label>
		    <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Name" value="{{ $product['name'] }}" required="">
		  </div>
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Base Price:</label>
		    <input type="text" class="form-control" id="formGroupExampleInput2" name="base_price" placeholder="Address" value="{{ $product['base_price'] }}" required="">
		  </div>

	  	  <div class="form-group">
		    <label for="formGroupExampleInput2"><b>Category:</b></label>
		    <select class="form-control" id="sel1" name="cate[]" multiple>
		    	<?php $tmp = count($product_cate) ?>
			    @foreach($category as $item)
			    	<?php $count_cate = 0; ?>
			    	@foreach ($product_cate as $value)
			    		@if ($item->id != $value['category_id'])
			    			<?php $count_cate++; ?>
			    		@endif
			    	@endforeach
			    	@if($count_cate == $tmp)
			    		<option value="{{ $item->id }}">{{ $item->name }}</option>
		    		@else
			    		<option selected="" value="{{ $item->id }}">{{ $item->name }}</option>
		    		@endif
			    @endforeach
		  	</select>
		  </div>

		  <div class="form-group">
			<label>Description:</label>
			<textarea class="form-control" name="description">{{ $product['description'] }}</textarea>
		  </div>

	      @foreach ($agency_product as $value)
  		  <div class="agency-content-{{ $value['id'] }}">
		  <hr>
	  	  <div class="form-group">
		  	<div class="row container">
		  		@if (count($agency_product) >1 )
			  	<a class="delete-agency" onclick="deleteAgency( {{ $value['id'] }} )" ><i class='fas fa-trash'></i> delete</a>
			  	@endif
			    <label for="formGroupExampleInput2"><b>Agency:</b></label>
		  	</div>
			    <select class="form-control" name="agency[]">
			    	@foreach ($agency as $item)
			    	@if ($item->id == $value['agency_id'])
			    	<option selected="" value="{{ $item->id }}">{{ $item->name }}</option>
			    	@endif
			    	@endforeach
			    </select>
		  </div>
	  	  <div class="row">
		  	<div class="col">
			    <div class="form-group">
				    <label for="formGroupExampleInput2">Quantity:</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" name="quantity[]" placeholder="Quantity" value="{{ $value['quantity'] }}" required="">
			    </div>
		  	</div>
	  	    <div class="col">
			  	<div class="form-group">
				    <label for="formGroupExampleInput2">Discount rate:</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" name="discount_rate[]" placeholder="discount rate" value="{{ $value['discount_rate'] }}" required="">
			 	 </div>
		  	</div>
	 	  </div>
		  </div>
		@endforeach
		  <div class="row container main-agency"></div>
		  <div class="form-group">
		  	<a style="cursor: pointer;" class="add-to-agency" onclick="addAgency( {{ $agency }} )" ><i class='fas fa-plus'></i>Add Agency</a>
		  </div>
		</div>
		<div class="col-12 col-md-6">
			<div class="form-group item row">
				@foreach ($product_img as $value)
				<div id="{{ $value['id'] }}" class="col-6">
					<img src="{{ asset('uploads/products/').'/'.$value['image'] }}" class="img-thumbnail">
					@if (count($product_img) > 1)
					<div class="container row mt-1">
					<a class="btn btn-outline-danger mr-3 delete-me" style="cursor: pointer;" onclick="ajaxFunction({{ $value['id'] }}, '/seller/product/delImg', 0, {{ $product['id'] }} )"><i class="far fa-times-circle"></i></a>
					<a class="btn btn-outline-success delete-me" style="cursor: pointer;" onclick="ajaxFunction({{ $value['id'] }}, '/seller/product/setDefaultImg', 1, {{ $product['id'] }} )"><i class="fas fa-wrench"></i> Setting</a>
					</div>
					@endif
					<hr>
				</div>
				@endforeach
				<input id="gallery-photo-add" type="file" class="form-control" name="fImage[]" accept="image/*" multiple="">
				<div class="gallery"></div>
				<hr>
			</div>
		</div>
	</div>
	<hr>
	<div class="form-group">
	  	<button class="btn btn-success ">OKE</button>
	</div>
</form>
</div>
	
<script type="text/javascript">
	var tmp = {{ count($product_img) }};
	var agen_tmp = {{ count($agency_product) }};
</script>

@endsection()
