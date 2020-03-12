<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="HONOMEDIC CRM">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="MC TEAM">
        <meta name="robots" content="noindex, nofollow">

        @yield('links')

    </head>

    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">

			<!-- Header -->
            @include('layout/header')
			<!-- /Header -->

			<!-- Sidebar -->
			@include('layout/sidebar')
			<!-- /Sidebar -->

			<!-- Page Wrapper -->
			@yield('contenido')
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->


        @yield('scripts')

    </body>
</html>
