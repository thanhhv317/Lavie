@extends('admin.dashboard')


@section('content')
<div class="breadcrumb container">
    	<div class="col-auto">
    		<h1><a href="{{ route('seller.order') }}">List all order</a></h1>
    	</div>
</div>

<!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
            <div class="container">
            	<form class="order-detail-body" method="POST">
            	
            	</form>
            </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


<table class="table table-striped">
 	 <thead>
	    <tr>
			<th scope="col">#</th>
			<th scope="col">Customer</th>
			<th scope="col">Quantity</th>
			<th scope="col">Price</th>
			<th scope="col">Status</th>
			<th scope="col">action</th>
	    </tr>
  	</thead>
  	<tbody>
    	<form>
		@csrf
	    @foreach ($order as $key => $value)
	    <tr class="order-body-{{ $value['id'] }}">
	   		<th scope="row">{{ $key+1 }}</th>
			<td>{{ $value['name'] }}</td>
			<td>{{ $value['quantity'] }}</td>
			<td>{{ $value['total_price'] }}</td>
			<td>
				<div class="row select-status">
					<select class="" id="status-content-{{ $value['id'] }}">

				        <option value="0" {{ ($value['status'] == 0) ? "selected" : "" }}>No Process</option>
				        <option value="1" {{ ($value['status'] == 1) ? "selected" : "" }}>Processing</option>
				        <option value="2" {{ ($value['status'] == 2) ? "selected" : "" }}>Processed</option>
				        <option value="3" {{ ($value['status'] == 3) ? "selected" : "" }}>Expires</option>
			      	</select>
			      	<button type="button" class="btn btn-success ml-1" onclick="setStatus({{ $value['id'] }})">OK</button>
				</div>
			</td>
			<td>
				<div class="row ">
					<a class="btn-cusort-point btn btn-outline-danger" onclick="deleteOrder({{ $value['id'] }})"><i class="fas fa-times-circle mr-1"></i></a>
					<a class="btn-cusort-point btn btn-outline-success ml-1" onclick="getDetailOrder({{ $value['id'] }})" data-toggle="modal" data-target="#exampleModal"><i class="far fa-edit"></i> </a>
				</div>
			</td>
	    </tr>
	    @endforeach
		</form>
  	</tbody>
</table>

<script type="text/javascript" src="{{ asset('js/order.js') }}"></script>
	
@endsection()
