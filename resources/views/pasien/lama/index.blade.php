@extends('pasien.layouts.app')
@section('content')
		<!-- Appointment Section -->
		<section id="appointment" class="appointment section">

				<!-- Section Title -->
				<div class="section-title container" data-aos="fade-up">
						<h2>Pasien Lama</h2>
						<p>Silakan isi formulir berikut jika anda pernah mendaftar sebelumnya.<br> Jika belum pernah mendaftar, klik tombol
								berikut:</p>
						<a href="{{ route('pasien-baru.index') }}" class="btn btn-success mt-3">Pendaftaran pasien baru</a>
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
												<input type="date" class="form-control" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}"
														id="tanggal_kunjungan" placeholder="Tanggal lahir" required>
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

		</section><!-- /Appointment Section -->
@endsection
