@extends('admin.master')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    	<div class="col-auto">
    		<h1>EDIT AGENCY</h1>
    	</div>
    </ol>
</nav>

<div class="container">
<form  action="{{ route('seller.agency.postEdit',$agency['id']) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col">
	  <div class="form-group">
	    <label for="formGroupExampleInput">Agency name:</label>
	    <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Name" value="{{ $agency['name'] }}" required="">
	  </div>
	  <div class="form-group">
	    <label for="formGroupExampleInput2">Address:</label>
	    <input type="text" class="form-control" id="formGroupExampleInput2" name="address" placeholder="Address" value="{{ $agency['address'] }}" required="">
	  </div>
	  
	  <div class="form-group">
	  	<button class="btn btn-success">OKE</button>
	  </div>
		</div>
		<div class="col">
			<div class="form-group item">
				@foreach ($agency_img as $value)
				<div id="{{ $value['id'] }}" class="row">
					<img src="{{ asset('uploads/agency/').'/'.$value['image'] }}" class="img-thumbnail">
					<a class="btn btn-danger delete-me" style="cursor: pointer;" onclick="deleteMe({{ $value['id'] }}, '/seller/agency/delImg' )">delete</a>
					<hr>
				</div>
				@endforeach
				<input type="file" class="form-control" name="fImage[]" accept="image/*" multiple="">
				<hr>
				<!-- <button id="add-image" type="button" class="btn btn-primary" onclick="addImage()">Add Image</button>
				<hr> -->
			</div>
		</div>
	</div>
</form>
</div>
	
<script type="text/javascript">
	var tmp = {{ count($agency_img) }};
</script>

@endsection()
