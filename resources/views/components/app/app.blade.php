<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Dashboard - Porto Shop</title>
	<link rel="icon" href="{{ asset('assets/img/branding/porto-shop-branding.png') }}" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@400;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/home/index.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/home/login.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/app/sidebar.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	@yield('styles')
</head>
<body>
	@include('components.app.sidebar')
	<div class="main-content">
		<div class="dashboard-header">
			<div class="dashboard-title">@yield('title')</div>
			<div>
				   <form action="{{ route('logout') }}" method="POST" style="display:inline;">
					   @csrf
					   <button type="submit" class="btn btn-primary" style="background:#6c63ff;border:none;">Logout</button>
				   </form>
			</div>
		</div>
		@yield('content')
	</div>
	@include('components.app.footer')
	@yield('scripts')
</body>
</html>
