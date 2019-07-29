@extends('admin.dashboard')


@section('content')
<div class="breadcrumb container">
    	<div class="col-auto">
    		<h1>ADD NEW PRODUCT</h1>
    	</div>
</div>

@include('admin.blocks.error')

<div class="container">
<form  action="{{ route('seller.product.postNew') }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12 col-md-6">
			<div class="form-group">
			    <label for="formGroupExampleInput">Product name:</label>
			    <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Name" required="" value="{{ old('name') }}">
			</div>
			<div class="form-group">
			    <label for="formGroupExampleInput2">Base price:</label>
			    <input type="text" class="form-control" id="formGroupExampleInput2" name="base_price" placeholder="base Price" required="" value="{{ old('basePrice') }}">
			</div>

			<div class="form-group">
			    <label for="formGroupExampleInput2">Category:</label>
			    <select class="form-control" id="sel1" name="cate[]" multiple required="">
				    @foreach($category as $item)
				    	<option value="{{ $item->id }}">{{ $item->name }}</option>
				    @endforeach
			  	</select>
			</div>
			<div class="form-group">
				<label>Description:</label>
				<textarea class="form-control" name="description"></textarea>
			</div>
			
		</div>

		<div class="col-12 col-md-6">
			<div class="form-group">
		    <label>Agency</label>
			<select class="form-control" id="sel2" name="agency[]" multiple required="">
			    @foreach($agency as $item)
			    	<option value="{{ $item->id }}">{{ $item->name }}</option>
			    @endforeach
		  	</select>
		    </div>
			<div id="item" class="form-group item">
				<label for="formGroupExampleInput">Image:</label>
				<input id="gallery-photo-add" type="file" class="form-control" name="fImage[]" required="" accept="image/*" multiple="">
				<div class="gallery"></div>
				<hr>
			</div>
		</div>
	</div>
	<div class="form-group">
	  	<button class="btn btn-success">OKE</button>
	</div>
</form>
</div>

@endsection()
