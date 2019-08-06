$(document).ready(function() {
	let max = localStorage.length;
	for(let i =0; i < max; ++i){
	    var key = localStorage.key(i);
	    if(key.charAt(0) == 'c' && key.charAt(1) == 'a'){
	 		let obj = JSON.parse(localStorage.getItem(key));
			let totalPrice = Math.round(obj.quantity * obj.price * 100) / 100;
			let views = `
					<div class="card mb-3 box-payment">
					  <div class="row no-gutters">
					    <div class="col-md-4">
					      <img src="${obj.image}" class="card-img img-payment" alt="...">
					    </div>
					    <div class="col-md-8">
					      <div class="card-body">
					        <h5 class="card-title">${obj.name}</h5>
					        <p class="card-text">quantity: ${obj.quantity}</p>
					        <p class="card-text"><small class="text-muted">${obj.price} USD</small></p>
					      </div>
					    </div>
					  </div>
					</div>
				`;
			$('.payment-product').append(views);
	    }
	}

	let views = `
		<th scope="row"><b id="total-quantity">${getTotalQuantity()}</b></th>
		      <td><b id="total-price">${getTotalPrice()}</b> usd</td>
		      <td><b id="delivery-cost">${getDeliveryCost()}</b> usd</td>
		      <td><b id="total">${ Math.round((getTotalPrice() + getDeliveryCost()) * 100) / 100 }</b> usd</td>
		      <td><a id="btn-continues-shopping" href="/" class="btn btn-outline-success"><i class="fas fa-shopping-basket"></i>  Continue shopping </a>`;
	if(getTotalQuantity() > 0) {
  		views += `<a id="order"  class="btn btn-outline-primary"><i class="far fa-money-bill-alt"></i>  Order </a></td>
		`;
	}
	$('.total-order').append(views);

	$('#order').click(function(event) {
		if ($('input[name="address"]').val() != "" ) {
			var _token = $('input[name="_token"]').val();
			var buyer_id = $('#b_id').val();
			var name = $('input[name="b_name"]').val();
			var phone = $('input[name="phone"]').val();
			var address = $('input[name="address"]').val();
			var deliveryCost = Number($('#delivery-cost').text());
			var pay = document.querySelector('input[name="pay"]:checked').value;
			$.ajax({
				url: '/payment',
				type: 'POST',
				data: {
					_token: _token,
					name: name,
					buyer_id: buyer_id,
					phone: phone,
					address: address,
					deliveryCost: deliveryCost,
					cart: groupCart(),
					pay: pay
				},
				success: function(data) {
					if(data == 1) {
						Swal.fire(
						    'Success!',
						    'Order complete, view detail at profile.',
						    'success'
					  	);
					  	localStorage.clear();
					  	window.location = '/';
					} 
					else {
						Swal.fire(
						    'warning!',
						    'Order error.',
						    'error'
					  	);
					}
				}
			});
		}
		else alert("please fill your profile")
	});

});
