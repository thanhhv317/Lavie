@extends('admin.dashboard')

@section('content')
<div class="breadcrumb container">
	<div class="col-auto btn-add">
		<a href="{{ route('seller.agency.new') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Agency</a>
	</div>
</div>

<div class="container">
	<div class="row">
		@if (count($agency) == 0)
			<h2>You do not have any agency</h2>
		@endif
		@foreach( $agency as $value)
		<div class="col-lg-4 col-md-6 col-12 mt-3">
			<form method="POST" action="{{ url('seller/agency/delete', $value['id']) }}">
			@csrf
			<div class="card" style="width: 18rem;">
			    <img class="card-img-top img-content" src="{{ asset('uploads/agency/').'/'.$value['image'][0]['image'] }}" alt="Card image cap">
			    <div class="card-body">
			        <h5 class="card-title">{{ $value['name'] }}</h5>
			        </div>
			    <ul class="list-group list-group-flush">
			        <li class="list-group-item box-address">{{ $value['address'] }}</li>
			    </ul>
			    <div class="card-body">
			        <a href="{{ url('seller/agency/edit',$value['id']) }}" class="card-link btn btn-success"><i class="fas fa-edit"></i> Edit</a>
			        <input type="submit" name="submit" class="btn btn-danger" value="Delete">
			    </div>
			</div>
			</form>
		</div>
		@endforeach
	</div>
</div>

@endsection()