<x-guest-layout>
		<div class="row h-100">
				<div class="col-lg-5 col-12">
						<div id="auth-left">
								<div class="auth-logo">
										<a href="{{ url('/') }}">
												<h1>Sirekam</h1>
												<h3>Sistem Informasi Rekam Medis</h3>
										</a>
								</div>
								<h1 class="auth-title">Daftar</h1>
								<p class="auth-subtitle mb-5">Masukkan data Anda untuk mendaftar di situs kami.</p>

								<form method="POST" action="{{ route('register') }}">
										@csrf

										<!-- Nama -->
										<div class="form-group position-relative has-icon-left mb-4">
												<input type="text" class="form-control form-control-xl" id="name" name="name" placeholder="Nama"
														value="{{ old('name') }}" required autofocus autocomplete="name">
												<div class="form-control-icon">
														<i class="bi bi-person"></i>
												</div>
												<x-input-error :messages="$errors->get('name')" class="text-danger mt-2" />
										</div>

										<!-- Email -->
										<div class="form-group position-relative has-icon-left mb-4">
												<input type="email" class="form-control form-control-xl" id="email" name="email" placeholder="Email"
														value="{{ old('email') }}" required autocomplete="username">
												<div class="form-control-icon">
														<i class="bi bi-envelope"></i>
												</div>
												<x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
										</div>

										<!-- NIP -->
										<div class="form-group position-relative has-icon-left mb-4">
												<input type="text" class="form-control form-control-xl" id="nip" name="nip" placeholder="NIP"
														value="{{ old('nip') }}" required>
												<div class="form-control-icon">
														<i class="bi bi-id-card"></i>
												</div>
												<x-input-error :messages="$errors->get('nip')" class="text-danger mt-2" />
										</div>

										<!-- Nomor HP -->
										<div class="form-group position-relative has-icon-left mb-4">
												<input type="text" class="form-control form-control-xl" id="no_hp" name="no_hp"
														placeholder="Nomor HP" value="{{ old('no_hp') }}" required>
												<div class="form-control-icon">
														<i class="bi bi-phone"></i>
												</div>
												<x-input-error :messages="$errors->get('no_hp')" class="text-danger mt-2" />
										</div>

										<!-- Password -->
										<div class="form-group position-relative has-icon-left mb-4">
												<input type="password" class="form-control form-control-xl" id="password" name="password"
														placeholder="Kata Sandi" required autocomplete="new-password">
												<div class="form-control-icon">
														<i class="bi bi-shield-lock"></i>
												</div>
												<x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
										</div>

										<!-- Konfirmasi Password -->
										<div class="form-group position-relative has-icon-left mb-4">
												<input type="password" class="form-control form-control-xl" id="password_confirmation"
														name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required autocomplete="new-password">
												<div class="form-control-icon">
														<i class="bi bi-shield-lock"></i>
												</div>
												<x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
										</div>

										<button class="btn btn-primary btn-block btn-lg mt-5 shadow-lg">Daftar</button>
								</form>

								<div class="fs-4 mt-5 text-center text-lg">
										<p class="text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold">Masuk</a>.</p>
								</div>
						</div>
				</div>
				<div class="col-lg-7 d-none d-lg-block">
						<div id="auth-right"
								style="
			background-image: url('{{ asset('bidan') }}/gambar/bg-auth.png');
			background-size: cover;
			background-posisition: center;
			background-repeat: no-repeat;
			">
						</div>
				</div>
		</div>
</x-guest-layout>
