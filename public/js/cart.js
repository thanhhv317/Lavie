$(document).ready(function() {
	let max = localStorage.length;
	for(let i =0; i< max; ++i){
	    var key = localStorage.key(i);
	    if(key.charAt(0) == 'c' && key.charAt(1) == 'a'){
			let obj = JSON.parse(localStorage.getItem(key));
			let totalPrice = Math.round(obj.quantity * obj.price *100)/100;
			let views = `
				<tr class="list-cart-product product-${obj.id}">
				<td>
					<div>
					<img src="${obj.image}" alt="..." class="img-thumbnail cart-product-image">
					</div>
					${obj.name}
				</td>
				<td>${obj.price} USD</td>
				<td>
					<div>
					<button class="btn btn-outline-info sub-quantity" onclick="editQuantity(${obj.id}, 0)">-</button>
						<input class="box-quantity quantity-${obj.id}" type="text" name="quantity" value="${obj.quantity}" >
					<button class="btn btn-outline-info add-quantity" onclick="editQuantity(${obj.id}, 1)">+</button>
					</div>
				</td>
				<td><b class="total-price-${obj.id}">${totalPrice}</b> USD</td>
				<td><a class="del-product delete-product-${obj.id}" onclick="deleteProduct(${obj.id})" ><i class="fas fa-times"></i> Delete</a></td>
			</tr>
			`;
			$('.append-product').append(views);
		}
	}
	$('.total-quantity-all-product').text(getTotalQuantity());
	$('.total-price-all-product').text(getTotalPrice());
	$('.delivery-cost').text(getDeliveryCost());
	
  	checkStatusCartIcon();


  //clear cart
  $('.btn-clear-cart').click(function(event) {
	  	localStorage.clear();
	  	$('.append-product').hide(1000);
	  	$('.total-quantity-all-product').text(0);
	    $('.total-price-all-product').text(0);
	    $('.delivery-cost').text(0);
	    checkStatusCartIcon();
	    Swal.fire(
	      'Success!',
	      'deleted all item.',
	      'success'
	    );
  });


});

function checkStatusCartIcon(){
	let quantity = getTotalQuantity();
	if(quantity < 1){
		$('.quantity-product').hide();
	} 
	else if(quantity >9){
		$('.quantity-product').text('9+');
	}
	else {
		$('.quantity-product').text(quantity);
	}
}


function editQuantity(id, flag = 0){
	let item = localStorage.getItem('ca-'+id);
	item = $.parseJSON(item);
	if(flag == 0){
		// sub
		if(item.quantity > 1) {
		item.quantity--;
		}
	}
	else {
		//add
		item.quantity++;
	}
	$(".quantity-"+id).val(item.quantity);
	$(".total-price-"+id).text( Math.round(item.quantity*item.price * 100)/100);
	item = JSON.stringify(item);
	localStorage.setItem('ca-'+id, item);
    $('.total-quantity-all-product').text(getTotalQuantity());
    $('.total-price-all-product').text(getTotalPrice());
    $('.delivery-cost').text(getDeliveryCost());
}

function deleteProduct(id){
	localStorage.removeItem('ca-'+id);
  	$('.total-quantity-all-product').text(getTotalQuantity());
  	$('.total-price-all-product').text(getTotalPrice());
    $('.delivery-cost').text(getDeliveryCost());

    checkStatusCartIcon();

	$('.product-'+id).hide(1000);
	Swal.fire(
      'Success!',
      'delete item.',
      'success'
  );
}

function getDeliveryCost(){
	var result =0;
	let cost = getTotalPrice();
	if( cost < 20 && cost >0){
		result = cost * 0.1;
	}
	else if (cost > 20 && cost < 50){
		result = cost * 0.05;
	}
	// return result;
	return Math.round(result * 100)/100; 
}