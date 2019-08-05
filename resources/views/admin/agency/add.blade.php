@extends('admin.dashboard')


@section('content')
<div class="breadcrumb container">
	<div class="col-auto">
		<h1>ADD NEW AGENCY</h1>
	</div>
</div>
@include('admin.blocks.error')

<div class="container">
<form action="{{ route('seller.agency.postNew') }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12 col-md-6">
		    <div class="form-group">
			    <label for="formGroupExampleInput">Agency name:</label>
			    <input type="text" class="form-control" id="formGroupExampleInput" required="" name="name" placeholder="Name" value="{{ old('name') }}">
		    </div>
		    <div class="form-group">
			    <label for="formGroupExampleInput2">Address:</label>
			    <textarea class="form-control" required="" name="address" placeholder="Address" rows="10">{{ old('address') }}</textarea>
		    </div>
		</div>
		<div class="col-12 col-md-6">
			<div id="item" class="form-group item">
				<label for="formGroupExampleInput">Image:</label>
				<input id="gallery-photo-add"  type="file" class="form-control" name="fImage[]" accept="image/*" multiple="" required="">
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
