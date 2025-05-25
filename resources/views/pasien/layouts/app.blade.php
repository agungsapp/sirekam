<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title>Ridho Nurhidayah</title>
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Favicons -->
		<link href="{{ asset('pasien') }}/img/favicon.png" rel="icon">
		<link href="{{ asset('pasien') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com" rel="preconnect">
		<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
		<link
				href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
				rel="stylesheet">

		<!-- Vendor CSS Files -->
		<link href="{{ asset('pasien') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="{{ asset('pasien') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="{{ asset('pasien') }}/vendor/aos/aos.css" rel="stylesheet">
		<link href="{{ asset('pasien') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="{{ asset('pasien') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
		<link href="{{ asset('pasien') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

		<!-- Main CSS File -->
		<link href="{{ asset('pasien') }}/css/main.css" rel="stylesheet">

		<!-- =======================================================
		* Template Name: Medilab
		* Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
		* Updated: Aug 07 2024 with Bootstrap v5.3.3
		* Author: BootstrapMade.com
		* License: https://bootstrapmade.com/license/
		======================================================== -->
</head>

<body class="index-page">

		<header id="header" class="header sticky-top">

				<div class="topbar d-flex align-items-center">
						<div class="d-flex justify-content-center justify-content-md-between container">
								<div class="contact-info d-flex align-items-center">
										<i class="bi bi-instagram d-flex align-items-center"><a href="#">@pmb.nurhidayah_tanjungrame</a></i>
										<i class="bi bi-phone d-flex align-items-center ms-4"><span>0812-7956-0799</span></i>
								</div>
								<div class="social-links d-none d-md-flex align-items-center">
										{{-- <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
										<a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
										<a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
										<a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> --}}
								</div>
						</div>
				</div><!-- End Top Bar -->

				<div class="branding d-flex align-items-center">

						<div class="position-relative d-flex align-items-center justify-content-between container">
								<a href="/" class="logo d-flex align-items-center me-auto">
										<!-- Uncomment the line below if you also wish to use an image logo -->
										<!-- <img src="/img/logo.png" alt=""> -->
										<h1 class="sitename">Sirekam</h1>
								</a>

								<nav id="navmenu" class="navmenu">
										<ul>
												<li><a href="#hero" class="active">Home<br></a></li>
												<li><a href="#about">About</a></li>
												<li><a href="#faq">FaQ</a></li>
												<li><a href="#testimoni">Testimoni</a></li>
												{{-- <li><a href="#services">Services</a></li>
												<li><a href="#departments">Departments</a></li>
												<li><a href="#doctors">Doctors</a></li> --}}

												<li><a href="#gallery">Galeri</a></li>
												<li><a href="#lokasi">Lokasi</a></li>
										</ul>
										<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
								</nav>

								<a class="cta-btn d-none d-sm-block" href="#pasien-baru">Pendaftaran</a>

						</div>

				</div>

		</header>

		<main class="main">

				@yield('content')

		</main>

		<footer id="footer" class="footer light-background">
				<div class="footer-top container">
						<div class="row gy-4">
								<div class="col-12 footer-about text-center">
										<a href="/" class="logo d-flex align-items-center justify-content-center">
												<span class="sitename">SIREKAM - Klinik & Rumah Bersalin BPS Ridho Nurhidayah</span>
										</a>
										<div class="footer-contact pt-3">
												<p>Jl. Raya Suban Tanjung Rame, Kec. Merbau Mataram, Lampung Selatan</p>
												<p><strong>Telp:</strong> <span>0812-7956-0799</span></p>
												<p><strong>Instagram:</strong> <span><a href="https://instagram.com/pmb.nurhidayah_tanjungrame"
																		target="_blank">@pmb.nurhidayah_tanjungrame</a></span></p>
												<p><strong>Jam Layanan:</strong> <span>Praktik Setiap Hari 07.00–21.00 (Layanan Persalinan 24 Jam)</span>
												</p>
										</div>
										<div class="social-links d-flex justify-content-center mt-4">
												<a href="https://instagram.com/pmb.nurhidayah_tanjungrame" target="_blank"><i
																class="bi bi-instagram"></i></a>
										</div>
								</div>
						</div>
				</div>

				<div class="copyright container mt-4 text-center">
						<p>© <span>Copyright</span> <strong class="sitename px-1">SIREKAM</strong> <span>All Rights Reserved</span></p>
						<div class="credits">
								Created by <a href="https://bootstrapmade.com/">Melia Kartika</a>
						</div>
				</div>
		</footer>

		<!-- Scroll Top -->
		<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
						class="bi bi-arrow-up-short"></i></a>

		<!-- Preloader -->
		<div id="preloader"></div>

		<!-- Vendor JS Files -->
		<script src="{{ asset('pasien') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="{{ asset('pasien') }}/vendor/php-email-form/validate.js"></script>
		<script src="{{ asset('pasien') }}/vendor/aos/aos.js"></script>
		<script src="{{ asset('pasien') }}/vendor/glightbox/js/glightbox.min.js"></script>
		<script src="{{ asset('pasien') }}/vendor/purecounter/purecounter_vanilla.js"></script>
		<script src="{{ asset('pasien') }}/vendor/swiper/swiper-bundle.min.js"></script>

		<!-- Main JS File -->
		<script src="{{ asset('pasien') }}/js/main.js"></script>

</body>

</html>
