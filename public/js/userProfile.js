$(document).ready(function() {

	loadMyProfile(); 

	$('#change-password').click(function(event) {
		let newPass 	= $('#newPassword').val();
		let confirmPass = $('#confirmPassword').val();
		var pattern = /^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/;
		var checkval = pattern.test($("#newPassword").val());
		let arr = [newPass, confirmPass];
		if (checkArr(arr) && checkPass(newPass, confirmPass)) {
			if(!checkval) {
		        Swal.fire('error!','password must be at least 8 characters with uppercase letters and numbers.','error');
		    }
		    else {
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '/buyer/profile/changePass',
					type: 'POST',
					data: {
						_token: _token,
						newPass: newPass,
						confirmPass: confirmPass
					},
					success: function(data) {
						if(data == 1) {
							Swal.fire('success!','change password completed.','success');
						}
					}
				});
			}
		}
		else {
			Swal.fire('error!','Review the password section.','error');
		}
	});

	$('#list-order').click(function(event) {
		skip = 2;
		$(this).parent().parent().find('a.active').removeClass('active');
		$(this).attr('class', "active list-group-item list-group-item-action btn-cusort-pointer")
		var _token = $('input[name="_token"]').val();
		$.ajax({
			url: '/buyer/profile/listOrder',
			type: 'POST',
			data: {
				_token: _token,
				skip: 0
			},
			success: function(data) {
				var views = 
					`<table class="table table-striped">
					  <thead>
					    <tr>
					      <th scope="col">#ID</th>
					      <th scope="col">Date</th>
					      <th scope="col">Quantity</th>
					      <th scope="col">Price</th>
					      <th scope="col">Delivery Cost</th>
					      <th scope="col">Status</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody id="body-table-order-detail">`;
				for (var i = 0; i < data.length; i++) {
					status = getStatus(data[i].status);
					views += createTableBody(data[i].id, data[i].created_at, data[i].quantity, data[i].price, data[i].cost, status);
					
				}
			    views += `</tbody></table><hr>
			    <div class="d-flex justify-content-center">
				    <button type="button" class="btn btn-outline-success" onclick="loadMore()">Load more</button>
				    </div>`;
				$('.box-profile').html(views);
			}
		});
	});

	$('#profile').click(function(event) {
		$(this).parent().parent().find('a.active').removeClass('active');
		$(this).attr('class', "active list-group-item list-group-item-action btn-cusort-pointer");
		loadMyProfile();
	});

	function loadMyProfile() {
		var _token = $('input[name="_token"]').val();
		$.ajax({
			url: '/buyer/profile/account',
			type: 'POST',
			data: {
				_token: _token,
			},
			success: function (data) {
				let views = `<div class="form-group row">
				    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputName" placeholder="Name" value="${data['name']}" required>
				    </div>
			  	</div>
			  	<div class="form-group row">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
				    <div class="col-sm-10">
				      <input type="email" disabled class="form-control" id="inputEmail" placeholder="email" value="${data['email']}">
				    </div>
			  	</div>
			  	<div class="form-group row">
				    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputPhone" placeholder="Phone" value="${data['phone']}" required>
				    </div>
			  	</div>
			  	<div class="form-group row">
				    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputAddress" placeholder="Address" value="${data['address']}" required="">
				    </div>
			  	</div>
			  	<div class="row container justify-content-end">
			  		<button type="button" onclick="updateProfile()" class="btn btn-outline-info" id="save-profile"><i class="fas fa-share-alt-square"></i> OK</button>
			  	</div>`;

			  	$('.box-profile').html(views);
			}
		});
	}

});

function viewOrderDetail(id, status) {
	$.ajax({
		url: '/buyer/profile/orderDetail/' + id,
		data: {
			id: id,
		},
		success: function(data) {
			var arr = data[0];
			var link = data[1];
			var totalPrice = 0;

			//handle data[0];
			var tmp =[];
			for (var i = 0; i < arr.length; i++) {
				tmp.push(arr[i].product_id);
			}

			function unique(value, index, self){
				return self.indexOf(value) == index;
			}
			tmp = tmp.filter(unique);

			var item = [];
			for (var i = 0; i < tmp.length; i++) {
				for (var j = 0; j < arr.length; j++) {
					if(arr[j].product_id == tmp[i]){
						item.push(arr[j]);
						break;
					}
				}
			}
			
			arr = item;

			var views = '';
			for (var i = 0; i < arr.length; i++) {
				totalPrice += arr[i].price * arr[i].quantity;
				views += `<div class="row box-order-detai-${arr[i].o_id} mt-1">
					<hr>
            		<div class="col-3">
            			<img src="${link + '/' + arr[i].image}" alt="..." class="img-thumbnail">
            		</div>
            		<div class="col-9">
            		  <div class="form-group">
					    <label>Name product: <b>${arr[i].name}</b>
				    	</label>
				    	<br>
					    <label>Price: <b class="order-detail-price-${arr[i].o_id}">${rounding(arr[i].price * arr[i].quantity)}</b> USD</label>
					    <br>
					    <label class="col-form-label">Quantity: <b>${arr[i].quantity}</b></label>
					  </div>
					  </div>
            		</div>`;
			}

			views += `<hr><div class="d-flex justify-content-center">
					<h5>Total Price: ${rounding(totalPrice)} <small> USD</small></h5>
				</div>
				<div class="d-flex justify-content-center">
					<h6>Order date: ${arr[0].created_at} </h6>
				</div>
				<div class="d-flex justify-content-center">
					<h6>Order status: ${status}</h6>
				</div>`;

			$('.order-detail-body').html(views);

			if (status == 'No process') {
				$('.footer-order-detail').html(`
					<button type="button" class="btn btn-danger" onclick="cancelOrder(${id})" data-dismiss="modal">Cancel order</button>
				`);
			}
			else {
				$('.footer-order-detail').html("");
			}

		}
	});
	
}

function updateProfile(){
	var _token = $('input[name="_token"]').val();
	let name = $('#inputName').val();
	let phone = $('#inputPhone').val();
	let address = $('#inputAddress').val();

	//check value is null
	let arr = [name, phone, address];
	if (checkArr(arr)) {
		$.ajax({
			url: '/buyer/profile',
			type: 'POST',
			data: {
				_token: _token,
				arr: arr
			},
			success: function(data) {
				console.log(data);
				if (data == 1) {
					Swal.fire('success!','Change profile completed','success');
				}
			}
		});
	}
	else {
		Swal.fire('warning!','Please fill out this field.','error');
	}
}

var checkArr = (arr) => {
	for (var i = 0; i < arr.length; i++) {
		if( arr[i] == null || arr[i] == "") return false;
	}
	return true;
}

var checkPass = (newPass, confirmPass) => {
	return (newPass === confirmPass);
}

var cancelOrder = (id) => {
	Swal.fire({
		title: 'Are you sure?',
		text: "Do you want to delete",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.value) {
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: '/buyer/profile/deleteOrder',
				type: 'POST',
				data: {
					_token: _token,
					id: id
				},
				success: function(data) {
					if(data == 1) {
						Swal.fire('success!','Cancel order completed','success');
						$('.order-detail-' + id).hide(1000);
					}
				}
			});
		}
	})
}

function convertToUTC(orderDate){
	var orderDate = new Date(orderDate);
	var utc = new Date(orderDate.getTime() + orderDate.getTimezoneOffset() +25200000 );
	return utc;
}

function rounding(n) {
	return Math.round(n * 100) / 100;
}

var skip = 2;

function loadMore() {
	var _token = $('input[name="_token"]').val();
	$.ajax({
		url: '/buyer/profile/listOrder',
		type: 'POST',
		data: {
			_token: _token,
			skip: skip
		},
		success: function(data) {
			var views = "";
			for (var i = 0; i < data.length; i++) {
				status = getStatus(data[i].status);
				views += createTableBody(data[i].id, data[i].created_at, data[i].quantity, data[i].price, data[i].cost, status);
			}
			$('#body-table-order-detail').append(views);
		}
	});
	skip += 2;
}

function getStatus(x) {
	var status;
	switch (Number(x)) {
		case 1:
			status = "Processing";
			break;
		case 2:
			status = "Finish";
			break;
		case 3:
			status = "Expires";
			break;
		case 0:
			status = "No process";
			break;
	}
	return status;
}

function createTableBody(id, created_at, quantity, price, cost, status) {
	var views;
	let utc = convertToUTC(created_at);
	views = `<tr class="order-detail-${id}">
				<th scope="row">${id}</th>
				<td title="${created_at}">${jQuery.timeago(utc)}</td>
				<td>${quantity}</td>
				<td>${price} <small>USD</small></td>
				<td>${cost} <small>USD</small></td>
				<td>${status}</td>
				<td>
				<a class="btn btn-outline-primary"  data-toggle="modal" data-target="#viewDetail" 
				onclick="viewOrderDetail(${id}, '${status}')"><i class="fas fa-info-circle"></i> detail</a>
				</td>
		    </tr>`;
    return views;
}