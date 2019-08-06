var foo_order_id;

function getDetailOrder(id)
{
	foo_order_id = id;
	$.ajax({
		url: '/seller/order/viewOrderDetail' +`/${id}`,
		success: function(data) {
			var arr = data[0];
			var link = data[1];

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
				views += `<div class="row box-order-detai-${arr[i].o_id}">
					<hr>
            		<div class="col-3">
            			<img src="${link + '/' + arr[i].image}" alt="..." class="img-thumbnail">
            		</div>
            		<div class="col-9">
            		  <div class="form-group">
					    <label>Name product: <b>${arr[i].name}</b>
				    	</label>
				    	<br>
					    <label>Price: <b class="order-detail-price-${arr[i].o_id}">${arr[i].price * arr[i].quantity}</b> USD</label>
					  </div>

					  <div class="form-group row">
					    <label class="col-sm-2 col-form-label">Quantity</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control order-detail-quantity-${arr[i].o_id}" placeholder="quantity" value="${arr[i].quantity}">
					     
					    </div>
					   
					  </div>
					  <div class="form-group">
					  	<a class="btn btn-outline-success ml-2 btn-cusort-point" onclick="editOrderDetail('${arr[i].o_id}')"><i class="fas fa-address-book"></i> Ok</a>
				    	<a class="btn btn-outline-danger ml-2 btn-cusort-point" onclick="deleteOrderDetail('${arr[i].o_id}')"><i class="fas fa-backspace"></i> Delete</a>
					  </div>
            		</div>
            	</div>`;
			}
			$('.order-detail-body').html(views);
		}
	});
}

function setStatus(id){
	var _token = $('input[name="_token"]').val();
	var status = $('#status-content-'+id).find(":selected").val();
	$.ajax({
		url: '/seller/order/setStatus',
		type: 'POST',
		data: {
			_token: _token,
			id: id,
			status: status
		},
		success: function(data) {
			if (data == 1) {
				Swal.fire('OK!','','success');
			}
		}
	});	
}

editOrderDetail = (id) => {
	var _token = $('input[name="_token"]').val();
	let quantity = $('.order-detail-quantity-' + id).val();
	$.ajax({
		url: '/seller/order/editOrderDetail',
		type: 'POST',
		data: {
			_token: _token,
			quantity: quantity,
			order_id: id
		},
		success: function(data) {
			console.log(data);
			$('.order-detail-price-'+id).text(data);
			Swal.fire('OK!','','success');
		}
	});
}

deleteOrderDetail = (id) => {
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
			let quantity = $('.order-detail-quantity-' + id).val();
			$.ajax({
				url: '/seller/order/deleteOrderDetail',
				type: 'POST',
				data: {
					_token: _token,
					quantity: quantity,
					id: id
				},
				success: function(data) {
					console.log(data);
					$('.box-order-detai-'+id).hide(1000);
					if(data == 1) {
						$('.order-body-'+foo_order_id).hide(1000);
					}
				}
			});
		}
	})
}


deleteOrder = (id) => {
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
			let quantity = $('.order-detail-quantity-' + id).val();
			$.ajax({
				url: '/seller/order/deleteOrder',
				type: 'POST',
				data: {
					_token: _token,
					id: id
				},
				success: function(data) {
					if(data == 1) {
						$('.order-body-'+id).hide(1000);
					}
				}
			});
		}
	})
}
