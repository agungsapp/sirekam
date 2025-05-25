@extends('pasien.layouts.app')
@section('content')
		<!-- Hero Section -->
		<section id="hero" class="hero section light-background">

				<img src="{{ asset('pasien') }}/img/hero-bg.png" alt="" data-aos="fade-in">

				<div class="position-relative container">

						<div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
								<h2>Bidan Nurhidayah, Amd.Keb</h2>
								<p>Mendampingi ibu dan bayi dengan kasih sayang</p>
						</div><!-- End Welcome -->

						<div class="row mt-5">
								<div>
										<a href="#pasien-baru" class="btn btn-primary">Pasien Baru <i class="bi bi-arrow-right"></i></a>
										<a href="#pasien-lama" class="btn btn-secondary">Pasien Lama <i class="bi bi-arrow-right"></i></a>
								</div>
						</div>

						<div class="content row gy-4">
								<div class="col-lg-4 d-flex align-items-stretch">
										<div class="why-box" data-aos="zoom-out" data-aos-delay="200">
												<h3>Kenapa Memilih Kami?</h3>
												<p>
														Kami memberikan pendampingan penuh perhatian untuk ibu hamil dan bayi, dengan pengalaman dan kehangatan
														seperti keluarga sendiri.
												</p>
												<div class="text-center">
														<a href="#about" class="more-btn"><span>Selengkapnya</span> <i class="bi bi-chevron-right"></i></a>
												</div>
										</div>
								</div><!-- End Why Box -->

								<div class="col-lg-8 d-flex align-items-stretch">
										<div class="d-flex flex-column justify-content-center">
												<div class="row gy-4">

														<div class="col-xl-4 d-flex align-items-stretch">
																<div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
																		<i class="bi bi-heart"></i>
																		<h4>Pendampingan Kehamilan</h4>
																		<p>Pemeriksaan rutin dan konsultasi untuk ibu hamil agar tetap sehat dan nyaman.</p>
																</div>
														</div><!-- End Icon Box -->

														<div class="col-xl-4 d-flex align-items-stretch">
																<div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
																		<i class="bi bi-calendar2-heart-fill"></i>
																		<h4>Persalinan Aman</h4>
																		<p>Pelayanan persalinan yang aman dan nyaman dengan sentuhan penuh kasih.</p>
																</div>
														</div><!-- End Icon Box -->

														<div class="col-xl-4 d-flex align-items-stretch">
																<div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
																		<i class="bi bi-person-hearts"></i>
																		<h4>Perawatan Ibu & Bayi</h4>
																		<p>Dukungan paska-persalinan untuk kesehatan ibu dan tumbuh kembang bayi.</p>
																</div>
														</div><!-- End Icon Box -->

												</div>
										</div>
								</div>
						</div><!-- End Content -->

				</div>

		</section>
		<!-- /Hero Section -->

		<!-- About Section -->
		<section id="about" class="about section">
				<div class="container">
						<div class="row gy-4 gx-5">
								<div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
										<img src="{{ asset('pasien/img/about.png') }}" class="img-fluid" alt="Tentang Klinik BPS Ridho Nurhidayah">
								</div>

								<div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
										<h3>Tentang Kami</h3>
										<p>
												Klinik BPS Ridho Nurhidayah berkomitmen memberikan pelayanan kesehatan terbaik untuk ibu dan anak.
												Dengan pengalaman bertahun-tahun, kami hadir untuk mendampingi keluarga Anda menuju hidup sehat dan bahagia.
										</p>
										<ul>
												<li>
														<i class="fa-solid fa-vial-circle-check"></i>
														<div>
																<h5>Pelayanan Profesional</h5>
																<p>Tim bidan kami berpengalaman, siap memberikan perawatan dengan penuh perhatian.</p>
														</div>
												</li>
												<li>
														<i class="fa-solid fa-pump-medical"></i>
														<div>
																<h5>Fasilitas Modern</h5>
																<p>Didukung peralatan medis terkini untuk memastikan kenyamanan dan keamanan pasien.</p>
														</div>
												</li>
												<li>
														<i class="fa-solid fa-heart-circle-xmark"></i>
														<div>
																<h5>Perawatan dengan Hati</h5>
																<p>Kami melayani setiap pasien dengan kasih sayang, seperti keluarga sendiri.</p>
														</div>
												</li>
										</ul>
								</div>
						</div>
				</div>
		</section><!-- /About Section -->



		<!-- Services Section -->
		<section id="services" class="services section">
				<!-- Section Title -->
				<div class="section-title container" data-aos="fade-up">
						<h2>Layanan Kami</h2>
						<p>Ketahui berbagai layanan kesehatan ibu dan anak yang kami sediakan di Klinik BPS Ridho Nurhidayah.</p>
				</div><!-- End Section Title -->

				<div class="container" data-aos="fade-up" data-aos-delay="100">
						<div class="row">
								<div class="col-lg-3">
										<ul class="nav nav-tabs flex-column">
												<li class="nav-item">
														<a class="nav-link active show" data-bs-toggle="tab" href="#services-tab-1">Pemeriksaan Kehamilan</a>
												</li>
												<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#services-tab-2">Persalinan</a>
												</li>
												<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#services-tab-3">Perawatan Bayi</a>
												</li>
												<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#services-tab-4">Keluarga Berencana</a>
												</li>
										</ul>
								</div>
								<div class="col-lg-9 mt-lg-0 mt-4">
										<div class="tab-content">
												<div class="tab-pane active show" id="services-tab-1">
														<div class="row">
																<div class="col-lg-12 details order-lg-1 order-2">
																		<h3>Pemeriksaan Kehamilan</h3>
																		<p class="fst-italic">Kami menyediakan pemeriksaan rutin untuk memastikan kesehatan ibu dan janin.</p>
																		<p>Pemeriksaan meliputi, pemantauan rutin kesahatan ibu dan janin, dan konsultasi dengan bidan
																				berpengalaman
																				untuk mendukung kehamilan yang sehat.</p>
																</div>

														</div>
												</div>
												<div class="tab-pane" id="services-tab-2">
														<div class="row">
																<div class="col-lg-12 details order-lg-1 order-2">
																		<h3>Persalinan</h3>
																		<p class="fst-italic">Proses persalinan yang aman dan nyaman bersama tim bidan kami.</p>
																		<p>Kami menawarkan pelayanan persalinan normal dengan pendampingan penuh perhatian, serta fasilitas
																				ruang bersalin yang modern dan steril.</p>
																</div>

														</div>
												</div>
												<div class="tab-pane" id="services-tab-3">
														<div class="row">
																<div class="col-lg-12 details order-lg-1 order-2">
																		<h3>Perawatan Bayi</h3>
																		<p class="fst-italic">Perawatan terbaik untuk buah hati Anda sejak lahir.</p>
																		<p>Layanan mencakup pemeriksaan kesehatan bayi, imunisasi, dan edukasi orang tua untuk mendukung tumbuh
																				kembang anak.</p>
																</div>

														</div>
												</div>
												<div class="tab-pane" id="services-tab-4">
														<div class="row">
																<div class="col-lg-12 details order-lg-1 order-2">
																		<h3>Keluarga Berencana</h3>
																		<p class="fst-italic">Konsultasi dan layanan untuk merencanakan keluarga yang sehat.</p>
																		<p>Kami menyediakan konseling KB, pemasangan alat kontrasepsi, dan edukasi untuk membantu keluarga
																				merencanakan masa depan.</p>
																</div>

														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</section><!-- /Services Section -->

		<!-- Pendaftaran pasien baru -->
		<section id="pasien-baru" class="appointment section">

				<!-- Section Title -->
				<div class="section-title container" data-aos="fade-up">
						<h2>Pasien Baru</h2>
						<p>Silakan isi formulir berikut untuk mendaftar sebagai pasien baru. <br> Jika sudah pernah mendaftar, klik tombol
								berikut:</p>
						<a href="#pasien-lama" class="btn btn-success mt-3">Pendaftaran pasien lama</a>
				</div><!-- End Section Title -->

				<div class="container" data-aos="fade-up" data-aos-delay="100">

						<form action="{{ route('pasien-baru.store') }}" method="post">
								@csrf
								<div class="row">
										<div class="col-md-4 form-group">
												<input type="number" name="nik" class="form-control" id="nik" placeholder="NIK" required>
										</div>

										<div class="col-md-4 form-group">
												<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anda"
														required>
										</div>

										<div class="col-md-4 form-group">
												<select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
														<option value="">Jenis Kelamin</option>
														<option value="p">Perempuan</option>
														<option value="l">Laki-laki</option>
												</select>
										</div>
								</div>
								<div class="row">
										<div class="col-md-4 form-group mt-3">
												<label for="tanggal_lahir">Tanggal Lahir</label>
												<input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
														placeholder="Tanggal lahir" required>
										</div>
										<div class="col-md-4 form-group mt-3">
												<label for="tanggal_kunjungan">Tanggal Kunjungan</label>
												<input type="date" class="form-control" name="tanggal_kunjungan" id="tanggal_kunjungan"
														placeholder="Tanggal lahir" required>
										</div>

										<div class="col-md-4 form-group mt-3">
												<label for="no_hp">Nomor HP</label>
												<input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP/WA"
														required>
										</div>
								</div>

								<div class="form-group mt-3">
										<textarea class="form-control" name="alamat" rows="5" placeholder="Alamat saat ini" required></textarea>
								</div>

								@if ($errors->any())
										<div class="error-message">
												<ul>
														@foreach ($errors->all() as $error)
																<li>{{ $error }}</li>
														@endforeach
												</ul>
										</div>
								@endif
								@if (session('sent-message'))
										<div class="alert alert-success mt-5" role="alert">
												{{ session('sent-message') }}
										</div>
								@endif
								@if (session('error-message'))
										<div class="alert alert-danger mt-5" role="alert">
												{{ session('error-message') }}
										</div>
								@endif

								<div class="mt-3">
										<div class="text-center"><button type="submit" class="btn btn-primary">Daftar</button></div>
								</div>
						</form>

				</div>

		</section><!-- /Pendaftaran pasien baru -->



		<!-- Stats Section -->
		<section id="stats" class="stats section light-background">

				<div class="container" data-aos="fade-up" data-aos-delay="100">

						<div class="row gy-4">

								<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center">
										<i class="fa-solid fa-user-doctor"></i>
										<div class="stats-item">
												<span data-purecounter-start="0" data-purecounter-end="{{ $pendaftar['menunggu'] }}"
														data-purecounter-duration="1" class="purecounter"></span>
												<p>Menunggu</p>
										</div>
								</div><!-- End Stats Item -->

								<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center">
										<i class="fa-regular fa-hospital"></i>
										<div class="stats-item">
												<span data-purecounter-start="0" data-purecounter-end="{{ $pendaftar['diperiksa'] }}"
														data-purecounter-duration="1" class="purecounter"></span>
												<p>Diperiksa</p>
										</div>
								</div><!-- End Stats Item -->

								<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center">
										<i class="fas fa-flask"></i>
										<div class="stats-item">
												<span data-purecounter-start="0" data-purecounter-end="{{ $pendaftar['selesai'] }}"
														data-purecounter-duration="1" class="purecounter"></span>
												<p>Selesai</p>
										</div>
								</div><!-- End Stats Item -->



						</div>

				</div>

		</section><!-- /Stats Section -->

		<!-- Pendaftaran pasien lama -->
		<section id="pasien-lama" class="appointment section">

				<!-- Section Title -->
				<div class="section-title container" data-aos="fade-up">
						<h2>Pasien Lama</h2>
						<p>Silakan isi formulir berikut jika anda pernah mendaftar sebelumnya.<br> Jika belum pernah mendaftar, klik tombol
								berikut:</p>
						<a href="#pasien-baru" class="btn btn-success mt-3">Pendaftaran pasien baru</a>
				</div><!-- End Section Title -->

				<div class="container" data-aos="fade-up" data-aos-delay="100">

						<form action="{{ route('pasien-lama.store') }}" method="post">
								@csrf
								<div class="row">
										<div class="col-md-4 form-group">
												<label for="nik">Nik</label>
												<input type="number" name="nik" class="form-control" value="{{ old('nik') }}" id="nik"
														placeholder="NIK" required>
										</div>
										<div class="col-md-4 form-group">
												<label for="no_hp">Nomor Handphone</label>
												<input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ old('no_hp') }}"
														placeholder="Nomor HP/WA" required>
										</div>
										<div class="col-md-4 form-group">
												<label for="tanggal_kunjungan">Tanggal Kunjungan</label>
												<input type="date" class="form-control" name="tanggal_kunjungan"
														value="{{ old('tanggal_kunjungan') }}" id="tanggal_kunjungan" placeholder="Tanggal lahir" required>
										</div>
								</div>
								@if ($errors->any())
										<div class="error-message">
												<ul>
														@foreach ($errors->all() as $error)
																<li>{{ $error }}</li>
														@endforeach
												</ul>
										</div>
								@endif
								@if (session('sent-message'))
										<div class="alert alert-success mt-5" role="alert">
												{{ session('sent-message') }}
										</div>
								@endif
								@if (session('error-message'))
										<div class="alert alert-danger mt-5" role="alert">
												{{ session('error-message') }}
										</div>
								@endif
								<div class="mt-3">
										<div class="text-center"><button type="submit" class="btn btn-primary">Daftar</button></div>
								</div>
						</form>

				</div>

		</section><!-- /Pendaftaran pasien lama -->




		<!-- Faq Section -->
		<section id="faq" class="faq section light-background">

				<div class="section-title container" data-aos="fade-up">
						<h2>Pertanyaan Umum</h2>
						<p>Temukan jawaban atas pertanyaan seputar layanan kami di Klinik BPS Ridho Nurhidayah.</p>
				</div>

				<div class="container">

						<div class="row justify-content-center">

								<div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

										<div class="faq-container">
												@forelse ($faq as $index => $f)
														<div class="faq-item {{ $index == 0 ? 'faq-active' : '' }}">
																<h3>{{ $f->question }}</h3>
																<div class="faq-content">
																		<p>{{ $f->answer }}</p>
																</div>
																<i class="faq-toggle bi bi-chevron-right"></i>
														</div><!-- End Faq item-->
												@empty
														<p class="text-center">Belum ada FAQ tersedia saat ini.</p>
												@endforelse
										</div>

								</div><!-- End Faq Column-->

						</div>

				</div>

		</section><!-- /Faq Section -->

		<!-- Testimonials Section -->
		<section id="testimoni" class="testimonials section">

				<div class="container">

						<div class="row align-items-center">

								<div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
										<h3>Testimonials</h3>
										<p>
												Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
												voluptate
												velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
										</p>
								</div>

								<div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

										<div class="swiper init-swiper">
												<script type="application/json" class="swiper-config">
													{
														"loop": true,
														"speed": 600,
														"autoplay": {
															"delay": 5000
														},
														"slidesPerView": "auto",
														"pagination": {
															"el": ".swiper-pagination",
															"type": "bullets",
															"clickable": true
														}
													}
			</script>
												<div class="swiper-wrapper">

														<div class="swiper-slide">
																<div class="testimonial-item">
																		<div class="d-flex">
																				<img src="{{ asset('pasien') }}/img/testimonials/testimonials-1.jpg"
																						class="testimonial-img flex-shrink-0" alt="">
																				<div>
																						<h3>Saul Goodman</h3>
																						<h4>Ceo &amp; Founder</h4>
																						<div class="stars">
																								<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
																										class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
																						</div>
																				</div>
																		</div>
																		<p>
																				<i class="bi bi-quote quote-icon-left"></i>
																				<span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.
																						Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at
																						semper.</span>
																				<i class="bi bi-quote quote-icon-right"></i>
																		</p>
																</div>
														</div><!-- End testimonial item -->

														<div class="swiper-slide">
																<div class="testimonial-item">
																		<div class="d-flex">
																				<img src="{{ asset('pasien') }}/img/testimonials/testimonials-2.jpg"
																						class="testimonial-img flex-shrink-0" alt="">
																				<div>
																						<h3>Sara Wilsson</h3>
																						<h4>Designer</h4>
																						<div class="stars">
																								<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
																										class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
																						</div>
																				</div>
																		</div>
																		<p>
																				<i class="bi bi-quote quote-icon-left"></i>
																				<span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum
																						eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim
																						culpa.</span>
																				<i class="bi bi-quote quote-icon-right"></i>
																		</p>
																</div>
														</div><!-- End testimonial item -->

														<div class="swiper-slide">
																<div class="testimonial-item">
																		<div class="d-flex">
																				<img src="{{ asset('pasien') }}/img/testimonials/testimonials-3.jpg"
																						class="testimonial-img flex-shrink-0" alt="">
																				<div>
																						<h3>Jena Karlis</h3>
																						<h4>Store Owner</h4>
																						<div class="stars">
																								<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
																										class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
																						</div>
																				</div>
																		</div>
																		<p>
																				<i class="bi bi-quote quote-icon-left"></i>
																				<span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis
																						minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
																				<i class="bi bi-quote quote-icon-right"></i>
																		</p>
																</div>
														</div><!-- End testimonial item -->

														<div class="swiper-slide">
																<div class="testimonial-item">
																		<div class="d-flex">
																				<img src="{{ asset('pasien') }}/img/testimonials/testimonials-4.jpg"
																						class="testimonial-img flex-shrink-0" alt="">
																				<div>
																						<h3>Matt Brandon</h3>
																						<h4>Freelancer</h4>
																						<div class="stars">
																								<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
																										class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
																						</div>
																				</div>
																		</div>
																		<p>
																				<i class="bi bi-quote quote-icon-left"></i>
																				<span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim
																						velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum
																						veniam.</span>
																				<i class="bi bi-quote quote-icon-right"></i>
																		</p>
																</div>
														</div><!-- End testimonial item -->

														<div class="swiper-slide">
																<div class="testimonial-item">
																		<div class="d-flex">
																				<img src="{{ asset('pasien') }}/img/testimonials/testimonials-5.jpg"
																						class="testimonial-img flex-shrink-0" alt="">
																				<div>
																						<h3>John Larson</h3>
																						<h4>Entrepreneur</h4>
																						<div class="stars">
																								<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
																										class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
																						</div>
																				</div>
																		</div>
																		<p>
																				<i class="bi bi-quote quote-icon-left"></i>
																				<span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam
																						enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi
																						cillum quid.</span>
																				<i class="bi bi-quote quote-icon-right"></i>
																		</p>
																</div>
														</div><!-- End testimonial item -->

												</div>
												<div class="swiper-pagination"></div>
										</div>

								</div>

						</div>

				</div>

		</section><!-- /Testimonials Section -->

		<!-- Gallery Section -->
		<section id="gallery" class="gallery section">

				<!-- Section Title -->
				<div class="section-title container" data-aos="fade-up">
						<h2>Galeri Kami</h2>
						<p>Lihat momen kebersamaan dan pelayanan penuh perhatian di Klinik BPS Ridho Nurhidayah.</p>
				</div>

				<div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

						<div class="row g-0">

								@forelse ($gallery as $g)
										<div class="col-lg-3 col-md-4">
												<div class="gallery-item">
														<a href="{{ Storage::url($g->image) }}" class="glightbox" data-gallery="images-gallery">
																<img src="{{ Storage::url($g->image) }}" alt="{{ $g->image }}" class="img-fluid">
														</a>
												</div>
										</div>
								@empty
								@endforelse

								<!-- End Gallery Item -->


						</div>

				</div>

		</section><!-- /Gallery Section -->

		<!-- Contact Section -->
		<section id="lokasi" class="contact section">

				<!-- Section Title -->
				<div class="section-title container" data-aos="fade-up">
						<h2>Lokasi</h2>
						<p>Tj. Baru, Kec. Merbau Mataram, Kabupaten Lampung Selatan, Lampung 35245</p>
				</div><!-- End Section Title -->

				<div class="mb-5" data-aos="fade-up" data-aos-delay="200">
						{{-- <iframe style="border:0; width: 100%; height: 270px;"
								src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
								frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}

						<iframe
								src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.7638203459305!2d105.33102187591352!3d-5.452776654376367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40dff0cdaf9f2d%3A0x24ed8d97fecb584!2sBPS%20RIDHO%20Bd%20Nurhidayah%20Amd.Keb!5e0!3m2!1sid!2sid!4v1748105537989!5m2!1sid!2sid"
								allowfullscreen="" loading="lazy" style="border:0; width: 100%; height: 270px;"
								referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div><!-- End Google Maps -->



		</section><!-- /Contact Section -->
@endsection
