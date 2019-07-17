<!DOCTYPE html>
<html>
<head>
	<title>Lavie</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style type="text/css">
		.logo {
			width: 35%;
			margin: 0 auto;
		}

		.slogant {
			margin:10px auto;
		}
		
	</style>
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
			<div class="row">
				<div class="col-md-3">
					<img class="logo" src="http://file.talaweb.com/u1095229/home/%E1%BA%A2nh/nuoc-khoang-lavie-miru%20%2816%29.png">
				</div>
				<div class="col-md-9">
					<label class="col-form-label slogant">
						<h1>AN ESSENTIAL PART OF LIFE</h1>
					</label>
				</div>
			</div>
		</nav>
		
	 	<main class="py-4">
            @yield('content')
        </main>
	</div>


</body>
</html>