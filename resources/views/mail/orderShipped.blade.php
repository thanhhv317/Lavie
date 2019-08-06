<!DOCTYPE html>
<html>
<head>
	<title>Thanks you</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/mail.css') }}">
</head>
<body>
	<h1>Thank you !!!</h1>
	<table id="customers">
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>quantity</th>
			<th>price</th>
		</tr>
		<?php $i=1; ?>
		@foreach($e_order_detail as $item)
	    <tr>
			<td>{{ $i++ }}</td>
			<td>{{ $item['name'] }}</td>
			<td>{{ $item['quantity'] }}</td>
			<td>{{ $item['price'] }}</td>
	    </tr>
		@endforeach
	</table>
	
</body>
</html>