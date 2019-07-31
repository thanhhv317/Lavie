function searchByPrice() {

	let priceFrom = ($("#slider-range").slider("values", 0));
	let priceTo = ($("#slider-range").slider("values", 1));
	
	window.location = `/search/${priceFrom}/${priceTo} `;
}

// get value for price slider
$( function() {
  $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 500,
    values: [ 75, 300 ],
    slide: function( event, ui ) {
      $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
    }
  });
  $("#amount").val("$" + $("#slider-range").slider("values", 0) +
    " - $" + $("#slider-range").slider("values", 1));
});


// back to top button
$(document).ready(function() {
   $(window).scroll(function() { 
      if($(window).scrollTop() != 0) { 
        $('#top').fadeIn();
      } else {
        $('#top').fadeOut();
      }
   });
 $('#top').click(function() {
   $('html, body').animate({scrollTop:0},500);
 });
});

//zoom image 
$(document).ready(function(){
   $('.zoom').hover(function() {
      $(this).addClass('transition');
   }, function() {
      $(this).removeClass('transition');
   });
});

$(function() {
  $('.zoom-image').each(function(){
    var originalImagePath = $(this).find('img').data('original-image');
    $(this).zoom({
      url: originalImagePath,
      magnify: 1
    });
  });
}); 

// image list

$(document).ready(function() {
  $('.thumb-link').click(function(event) {
    event.preventDefault();
    $('.imgBox img').attr('src', $(this).children("img").attr("src"));
  });
  checkStatusCartIcon();
});

// quantity product

function subQuantity(){
  let tmp = $('.box-quantity').val();
  if (tmp <= 1) {
    return;
  }
  else {
    $('.box-quantity').val(tmp - 1);
  }
}

function addQuantity(){
  let tmp = $('.box-quantity').val();
  let max = $('.sum-quantity').text();
  if (tmp >= Number(max)){
    return
  }
  else {
    $('.box-quantity').val(Number(tmp) + 1);
  }
}

// add to cart
function addToCart(seller_id, id, name, price, quantity, img){
  if (getTotalQuantity() < 1){
    $('.quantity-product').show();
  }
  obj = {
    seller_id  : seller_id,
    id        : id,
    name      : name,
    price     : price,
    quantity  : quantity,
    image     : img
  }
  obj = JSON.stringify(obj);
  var count_obj = 0;

  let max = localStorage.length;
  for(let i =0; i < max; ++i){
    var key = localStorage.key(i);
    if(key == ('ca-' + id)) {
      count_obj ++;
    }
  }

  if (count_obj < 1){
    localStorage.setItem('ca-' + id, obj);
  } 
  else {
    editQuantityProduct('ca-' + id, quantity);
  }
  if (getTotalQuantity() > 9){
    $('.quantity-product').text('9+');
  }
  else {
    $('.quantity-product').text(getTotalQuantity());
  }
  Swal.fire(
      'Success!',
      'added item.',
      'success'
  );
}

function editQuantityProduct(pkey, quantity = 1)
{
  let obj = JSON.parse(localStorage.getItem(pkey));
  obj.quantity += quantity;
  obj = JSON.stringify(obj);
  localStorage.setItem(pkey, obj);
}

function getTotalQuantity()
{
  var result = 0;
  let max = localStorage.length;
  for(let i = 0; i < max; ++i){
    var key = localStorage.key(i);
    if(key.charAt(0) == 'c' && key.charAt(1) == 'a'){
      let obj = JSON.parse(localStorage.getItem(key));
      result += obj.quantity;
    }
  }
  return Number(result);
}

function getTotalPrice()
{
  var result = 0;
  let max = localStorage.length;
  for(let i =0; i < max; ++i){
    var key = localStorage.key(i);
    if(key.charAt(0) == 'c' && key.charAt(1) == 'a'){
      let obj = JSON.parse(localStorage.getItem(key));
      result += (obj.quantity * obj.price);
    }
  }
  return Math.round(result * 100) / 100;
}

//get quantity product - product detail page
function getQuantityProduct(){
  return Number($('.box-quantity').val());
}

function checkStatusCartIcon(){
  let quantity = getTotalQuantity();
  if (quantity < 1){
    $('.quantity-product').hide();
  } 
  else if (quantity >9){
    $('.quantity-product').text('9+');
  }
  else {
    $('.quantity-product').text(quantity);
  }
}

function getDeliveryCost(){
  var result = 0;
  let cost = getTotalPrice();
  if ( cost < 20 && cost > 0){
    result = cost * 0.1;
  }
  else if (cost > 20 && cost < 50){
    result = cost * 0.05;
  }
  return Math.round(result * 100) / 100; 
}

function groupCart()
{
  var result = [];
  let max = localStorage.length;
  for(let i =0; i < max; ++i){
      var key = localStorage.key(i);
      if(key.charAt(0) == 'c' && key.charAt(1) == 'a'){
      result.push(localStorage.getItem(key));
      }
  }
  return result;
}
