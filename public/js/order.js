function getDetailOrder(id)
{
	$.ajax({
		url: '/seller/order/orderDetail' +`/${id}`,
		success: function(data) {
			var arr = data[0];
			var link = data[1];
			var views = '';
			for (var i = 0; i < arr.length; i++) {
				views += `<hr>
					<div class="row">
            		<div class="col-3">
            			<img src="${link + '/' + arr[i].image}" alt="..." class="img-thumbnail">
            		</div>
            		<div class="col-9">
            		  <div class="form-group">
					    <label>Name product: <b>${arr[i].name}</b>
				    	</label>
				    	<br>
					    <label>Price: <b>${arr[i].price}</b> USD</label>
					  </div>

					  <div class="form-group row">
					    <label class="col-sm-2 col-form-label">Quantity</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" placeholder="quantity" value="${arr[i].quantity}">
					     
					    </div>
					   
					  </div>
					  <div class="form-group">
					  	<a href="" class="btn btn-outline-success ml-2"><i class="fas fa-address-book"></i> Ok</a>
					    	<a href="" class="btn btn-outline-danger ml-2"><i class="fas fa-backspace"></i> Delete</a>
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