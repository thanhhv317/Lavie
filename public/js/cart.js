$(document).ready(function() {

	var status = Number($('.quantity-product').text());
	if (status > 0 || isNaN(status)){
		$.ajax({
			url: '/getDataCart',
			data: {
				cart: groupCart(),
			},
			success: function(data) {
				var i;
				for (i = 0; i < data.length; ++i) {

					let obj = JSON.parse(data[i]);

					localStorage.setItem('ca-' + obj.id, data[i]);

					let totalPrice = Math.round(obj.quantity * obj.price * 100) / 100;
					let views = `
						<tr class="list-cart-product product-${obj.id}">
						<td>
							<div>
							<img src="${obj.image}" alt="..." class="img-thumbnail cart-product-image">
							</div>
							<a href="/products/${convertToSlug(obj.name)}/${obj.id}">
							${obj.name}
							</a>
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
				showText();
			}
		});
	}

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
	if (quantity < 1){
		$('.quantity-product').hide();
	} 
	else if (quantity > 9){
		$('.quantity-product').text('9+');
	}
	else {
		$('.quantity-product').text(quantity);
	}
}


function editQuantity(id, flag = 0){
	let item = localStorage.getItem('ca-' + id);
	item = $.parseJSON(item);
	if(flag == 0){
		// sub
		if(item.quantity > 1) {
			item.quantity--;
		}
	}
	else {
		if(item.quantity < getMaxQuantityById(id)) {
			item.quantity++;
		}
	}
	$(".quantity-" + id).val(item.quantity);
	$(".total-price-" + id).text(Math.round(item.quantity * item.price * 100) / 100);
	item = JSON.stringify(item);
	localStorage.setItem('ca-' + id, item);
    showText();
    checkStatusCartIcon();
}

function getMaxQuantityById(id){
	let obj = JSON.parse(localStorage.getItem('ca-' + id));
	return obj.max;
}

function deleteProduct(id){
	localStorage.removeItem('ca-' + id);
  	showText();
    checkStatusCartIcon();
	$('.product-' + id).hide(1000);
	Swal.fire(
      'Success!',
      'delete item.',
      'success'
    );
}

function showText(){
	$('.total-quantity-all-product').text(getTotalQuantity());
  	$('.total-price-all-product').text(getTotalPrice());
    $('.delivery-cost').text(getDeliveryCost());
}

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}