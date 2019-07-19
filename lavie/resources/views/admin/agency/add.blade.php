@extends('admin.master')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    	<div class="col-auto">
    		<h1>ADD NEW AGENCY</h1>
    	</div>
    </ol>
</nav>

<div class="container">
<form  action="{{ route('seller.agency.postNew') }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col">
	  <div class="form-group">
	    <label for="formGroupExampleInput">Agency name:</label>
	    <input type="text" class="form-control" id="formGroupExampleInput" required="" name="name" placeholder="Name">
	  </div>
	  <div class="form-group">
	    <label for="formGroupExampleInput2">Address:</label>
	    <input type="text" class="form-control" id="formGroupExampleInput2" required="" name="address" placeholder="Address">
	  </div>
	  
	  <div class="form-group">
	  	<button class="btn btn-success">OKE</button>
	  </div>
		</div>
		<div class="col">
			<div id="item" class="form-group item">
				<label for="formGroupExampleInput">Image:</label>
				<input type="file" class="form-control" name="fImage[]" accept="image/*" multiple="" required="">
				<hr>
			</div>
		</div>
	</div>
</form>
</div>
@endsection()
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
