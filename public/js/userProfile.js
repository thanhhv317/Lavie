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
		$(this).parent().parent().find('a.active').removeClass('active');
		$(this).attr('class', "active list-group-item list-group-item-action btn-cusort-pointer")
		var _token = $('input[name="_token"]').val();
		$.ajax({
			url: '/buyer/profile/listOrder',
			type: 'POST',
			data: {
				_token: _token
			},
			success: function(data) {
				var views = 
					`<table class="table table-striped">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Date</th>
					      <th scope="col">Quantity</th>
					      <th scope="col">Price</th>
					      <th scope="col">Delivery Cost</th>
					      <th scope="col">Status</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>`;
				for (var i = 0; i < data.length; i++) {
					let status ;
					switch (Number(data[i].status)) {
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

					views += `<tr>
				      <th scope="row">${i+1}</th>
				      <td title="${data[i].created_at}">${jQuery.timeago(data[i].created_at)}</td>
				      <td>${data[i].quantity}</td>
				      <td>${data[i].price} <small>USD</small></td>
				      <td>${data[i].cost} <small>USD</small></td>
				      <td>${status}</td>
				      <td>
				      <a class="btn btn-outline-primary" onclick="viewOrderDetail(${data[i].id})"><i class="fas fa-info-circle"></i> detail</a>
				      </td>
				    </tr>`;
				}
			    views += `</tbody></table>`;
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

function viewOrderDetail(id) {
	alert(id);
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
