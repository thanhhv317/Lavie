@extends('master')

@section('content')


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Change password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  		<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
					    <label for="exampleFormControlInput1">New password</label>
					    <input type="password" class="form-control" id="newPassword" placeholder="Enter the new password">

					    <label for="exampleFormControlInput1">Confirm password</label>
					    <input type="password" class="form-control" id="confirmPassword" placeholder="">

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="change-password">Save changes</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="viewDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View order</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  		<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container order-detail-body">
					
				</div>
				
			</div>
			<div class="modal-footer">
				<div class="footer-order-detail"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

			</div>
		</div>
	</div>
</div>


<div class="container mt-5">
	<div class="row mt-1">
		<div class="col-3">
			<div class="list-group">
				<a class="list-group-item list-group-item-action list-group-item-info "><i class="fas fa-user-tie"></i> 
					My account
				</a>
				<a class="list-group-item list-group-item-action btn-cusort-pointer active" id="profile"><i class="fas fa-address-card"></i> Profile</a>
				<a class="list-group-item list-group-item-action btn-cusort-pointer" data-toggle="modal" data-target="#exampleModal" id="profile-change-password"><i class="fas fa-lock"></i> Change password</a>
			</div>
			<div class="list-group">
				<a class="list-group-item list-group-item-action list-group-item-dark "><i class="fas fa-money-bill"></i> Order</a>
				<a class="list-group-item list-group-item-action btn-cusort-pointer" id="list-order"><i class="fas fa-file-invoice"></i> List order</a>
			</div>
		</div>


		<div class="col-9 mt-1 mb-4" id="profile-content">
			<h1 class="mt-5">MY ACCOUNT</h1>
			<form id="formRegister">
				@csrf
				<div class="box-profile">
					
				</div>
			</form>
		</div>

	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.7/jquery.timeago.js"></script>
<script type="text/javascript" src="{{ asset('js/userProfile.js') }}"></script>

@endsection