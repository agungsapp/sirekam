@extends('pasien.layouts.app')
@section('content')
		<!-- Appointment Section -->
		<section id="appointment" class="appointment section">

				<!-- Section Title -->
				<div class="section-title container" data-aos="fade-up">
						<h2>Pasien Baru</h2>
						<p>Silakan isi formulir berikut untuk mendaftar sebagai pasien baru. <br> Jika sudah pernah mendaftar, klik tombol
								berikut:</p>
						<a href="{{ route('pasien-lama.index') }}" class="btn btn-success mt-3">Pendaftaran pasien lama</a>
				</div><!-- End Section Title -->

				<div class="container" data-aos="fade-up" data-aos-delay="100">

						<form action="{{ route('pasien-baru.store') }}" method="post">
								@csrf
								<div class="row">
										<div class="col-md-4 form-group">
												<input type="number" name="nik" class="form-control" id="nik" placeholder="NIK" required>
										</div>

										<div class="col-md-4 form-group">
												<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anda" required>
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
												<input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal lahir"
														required>
										</div>
										<div class="col-md-4 form-group mt-3">
												<label for="tanggal_kunjungan">Tanggal Kunjungan</label>
												<input type="date" class="form-control" name="tanggal_kunjungan" id="tanggal_kunjungan"
														placeholder="Tanggal lahir" required>
										</div>

										<div class="col-md-4 form-group mt-3">
												<label for="no_hp">Nomor HP</label>
												<input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP/WA" required>
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

		</section><!-- /Appointment Section -->
@endsection
