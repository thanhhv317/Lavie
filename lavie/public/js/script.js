function searchByPrice() {
	let priceFrom = $('#priceFrom').val();
	let priceTo = $('#priceTo').val();
	window.location = `/search/${priceFrom}/${priceTo} `;
}