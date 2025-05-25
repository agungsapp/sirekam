<x-guest-layout>
		<!-- Session Status -->
		<x-auth-session-status class="mb-4" :status="session('status')" />

		<div class="row h-100">
				<div class="col-lg-5 col-12">
						<div id="auth-left">
								<div class="auth-logo">
										<a href="{{ url('/') }}">
												<h1>Sirekam</h1>
												<h3>Sistem Informasi Rekam Medis</h3>
										</a>
								</div>
								<h1 class="auth-title">Masuk</h1>
								<p class="auth-subtitle mb-5">Masukkan data Anda untuk masuk ke akun Anda.</p>

								<form method="POST" action="{{ route('login') }}">
										@csrf

										<!-- Email -->
										<div class="form-group position-relative has-icon-left mb-4">
												<input type="email" class="form-control form-control-xl" id="email" name="email" placeholder="Email"
														value="{{ old('email') }}" required autofocus autocomplete="username">
												<div class="form-control-icon">
														<i class="bi bi-envelope"></i>
												</div>
												<x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
										</div>

										<!-- Password -->
										<div class="form-group position-relative has-icon-left mb-4">
												<input type="password" class="form-control form-control-xl" id="password" name="password"
														placeholder="Kata Sandi" required autocomplete="current-password">
												<div class="form-control-icon">
														<i class="bi bi-shield-lock"></i>
												</div>
												<x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
										</div>

										<!-- Remember Me -->
										<div class="form-check form-check-lg d-flex align-items-end mb-4">
												<input class="form-check-input me-2" type="checkbox" id="remember" name="remember">
												<label class="form-check-label text-gray-600" for="remember">
														Simpan saya tetap masuk
												</label>
										</div>

										<button class="btn btn-primary btn-block btn-lg mt-5 shadow-lg">Masuk</button>
								</form>

								<div class="fs-4 mt-5 text-center text-lg">
										<p class="text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="font-bold">Daftar</a>.</p>
										@if (Route::has('password.request'))
												<p><a class="font-bold" href="{{ route('password.request') }}">Lupa kata sandi?</a>.</p>
										@endif
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
