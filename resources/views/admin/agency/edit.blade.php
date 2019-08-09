@extends('admin.dashboard')


@section('content')
<div class="breadcrumb container">
	<div class="col-auto">
		<h1>EDIT AGENCY</h1>
	</div>
</div>
@include('admin.blocks.error')

<div class="container">
<form  action="{{ route('seller.agency.postEdit',$agency['id']) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12 col-md-6">
			<div class="form-group">
			    <label for="formGroupExampleInput">Agency name:</label>
			    <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Name" value="{{ $agency['name'] }}" required="">
		 	</div>
			<div class="form-group">
			    <label for="formGroupExampleInput2">Address:</label>
			    <label for="formGroupExampleInput2">Address:</label>
			    <textarea class="form-control" required="" name="address" placeholder="Address" rows="5">{{ $agency['address'] }}</textarea>
			</div>
			<div class="form-group">
				 <button class="btn btn-success">OKE</button>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="form-group item row">
				@foreach ($agency_img as $value)
				<div id="{{ $value['id'] }}" class="col-6">
					<img src="{{ asset('uploads/agency/').'/'.$value['image'] }}" class="img-thumbnail">
					@if (count($agency_img) > 1)
					<a class="btn btn-danger delete-me mt-1" style="cursor: pointer;" onclick="ajaxFunction({{ $value['id'] }}, '/seller/agency/delImg' )"><i class="fas fa-times"></i> delete</a>
					<hr>
					@endif
				</div>
				@endforeach
				<input id="gallery-photo-add" type="file" class="form-control" name="fImage[]" accept="image/*" multiple="">
				<div class="gallery"></div>
			</div>
		</div>
	</div>
</form>
</div>
	
<script type="text/javascript">
	var tmp = {{ count($agency_img) }};
</script>

@endsection()
