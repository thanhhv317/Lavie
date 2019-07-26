<!DOCTYPE html>
<html>
<head>
	<title>Lavie</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- register css -->
	<link type="text/css" href="{{ asset('css/register.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('css/login.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet">

	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- jquery validate -->
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

	<!-- validate form register jquery -->
	<!-- <script src="{{ asset('js/register.js') }}"></script> -->


</head>
<body>
	<div id="app">
		<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top mb-5">
			<div class="container">
				<div class="text-center logo">
					<a class="navbar-brand" href="{{ url('/') }}">
					  <img class="rounded" src="{{ asset('uploads/logo/logo.png') }}"  alt="...">
				  	</a>
				</div>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>

				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav mr-auto">
				  	  <li class="nav-item nav-text-menu">
				        <a class="nav-link" href="#"><h3>Happy new year 2019 </h3><span class="sr-only">(current)</span></a>
				      </li>
				  </div>
			</div>
		</nav>
		
	 	<main class="py-4">
            @yield('content')
        </main>
	</div>

<script type="text/javascript">
	$('#formRegister').validate({
    rules : {
        name : 'required',
        email : {
            required : true,
            minlength : 8,
            email : true
        },
        password : {
            required : true,
            minlength : 8
        },
        password_confirmation : {
            required : true,
            minlength : 8,
            equalTo: "#password"
        },
        phone : {
            required : true,
            minlength : 9,
            maxlength : 16
        }
    },
    messages: {
        name : "Please fill out this field",
        email : {
            required : "Please fill out this field",
            minlength : "Your mail must be at least 8 characters long",
            email : "Format mail ???"
        },
        password : {
            required : "Please fill out this field",
            minlength : "Your mail must be at least 8 characters long",
            pattent : "invalid"
        },
        password_confirmation : {
            required : "Please fill out this field",
            minlength : "Your password must be at least 8 characters long",
            equalTo : "Please enter the same password as above"
        },
        phone : {
            required : "Please fill out this field",
            minlength : "Your phone must be at least 9 characters long",
            maxlength : "Max is 16 characters long"
        }
    }
});
</script>

</body>
</html>
