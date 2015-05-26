<!DOCTYPE html>
<html lang="nl">
	<head>
		{{-- Header component --}}
		@include('components.header')
	</head>
	<body>
		{{-- Navbar component --}}
		@include('components.navbar')

		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
					@yield('alert')
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
					@yield('nav')
				</div>
			</div>

			<div class="tab-content" role="tabpanel">
				@yield('users')
				@yield('newUser')
			</div>
		</div>

		{{-- Footer component --}}
		@include('components.footer')
	</body>
</html>
