<div class="page-heading">
		<div class="page-title">
				<div class="row">
						<div class="col-12 col-md-6 order-md-1 order-last">
								<h3>Profil Bidan</h3>
								<p class="text-subtitle text-muted">Kelola informasi profil dan kata sandi Anda.</p>
						</div>
						<div class="col-12 col-md-6 order-md-2 order-first">
								<nav aria-label="breadcrumb" class="breadcrumb-header float-lg-end float-start">
										<ol class="breadcrumb">
												<li class="breadcrumb-item"><a href="{{ url('/bidan') }}">Dashboard</a></li>
												<li class="breadcrumb-item active" aria-current="page">Profil</li>
										</ol>
								</nav>
						</div>
				</div>
		</div>

		<section class="section">
				<div class="card">
						<div class="card-header">
								<h4 class="card-title">Edit Profil</h4>
						</div>
						<div class="card-body">
								<ul class="nav nav-tabs" id="profileTabs" role="tablist">
										<li class="nav-item">
												<a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab">Informasi
														Profil</a>
										</li>
										<li class="nav-item">
												<a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab">Ubah Kata
														Sandi</a>
										</li>
								</ul>
								<div class="tab-content" id="profileTabsContent">
										<!-- Tab Informasi Profil -->
										<div class="tab-pane fade show active" id="profile" role="tabpanel">
												<form wire:submit.prevent="updateProfile" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-6">
																		<div class="form-group">
																				<label for="name">Nama</label>
																				<input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
																						wire:model.defer="name">
																				@error('name')
																						<div class="invalid-feedback">{{ $message }}</div>
																				@enderror
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="form-group">
																				<label for="email">Email</label>
																				<input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
																						wire:model.defer="email">
																				@error('email')
																						<div class="invalid-feedback">{{ $message }}</div>
																				@enderror
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="form-group">
																				<label for="nip">NIP (opsional)</label>
																				<input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
																						wire:model.defer="nip">
																				@error('nip')
																						<div class="invalid-feedback">{{ $message }}</div>
																				@enderror
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="form-group">
																				<label for="no_hp">No. HP (opsional)</label>
																				<input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
																						wire:model.defer="no_hp">
																				@error('no_hp')
																						<div class="invalid-feedback">{{ $message }}</div>
																				@enderror
																		</div>
																</div>
																<div class="col-12">
																		<div class="form-group">
																				<label for="image">Foto Profil (opsional)</label>
																				<input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
																						wire:model="image">
																				@if ($current_image)
																						<img src="{{ Storage::url($current_image) }}" alt="Foto Profil" class="img-fluid mt-3"
																								style="max-width: 150px; border-radius: 8px;">
																				@else
																						<img src="{{ asset('mazer/assets/images/faces/1.jpg') }}" alt="Foto Default"
																								class="img-fluid mt-3" style="max-width: 150px; border-radius: 8px;">
																				@endif
																				@error('image')
																						<div class="invalid-feedback">{{ $message }}</div>
																				@enderror
																		</div>
																</div>
														</div>
														<div class="card-footer">
																@if (session('success'))
																		<div class="alert alert-success alert-dismissible fade show" role="alert">
																				{{ session('success') }}
																				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																		</div>
																@endif
																@if (session('error'))
																		<div class="alert alert-danger alert-dismissible fade show" role="alert">
																				{{ session('error') }}
																				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																		</div>
																@endif
																<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
														</div>
												</form>
										</div>
										<!-- Tab Ubah Kata Sandi -->
										<div class="tab-pane fade" id="password" role="tabpanel">
												<form wire:submit.prevent="updatePassword">
														<div class="row">
																<div class="col-md-6">
																		<div class="form-group">
																				<label for="password">Kata Sandi Baru</label>
																				<input type="password" class="form-control @error('password') is-invalid @enderror"
																						id="password" wire:model.defer="password">
																				@error('password')
																						<div class="invalid-feedback">{{ $message }}</div>
																				@enderror
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="form-group">
																				<label for="password_confirmation">Konfirmasi Kata Sandi</label>
																				<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
																						id="password_confirmation" wire:model.defer="password_confirmation">
																				@error('password_confirmation')
																						<div class="invalid-feedback">{{ $message }}</div>
																				@enderror
																		</div>
																</div>
														</div>
														<div class="card-footer">
																@if (session('success'))
																		<div class="alert alert-success alert-dismissible fade show" role="alert">
																				{{ session('success') }}
																				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																		</div>
																@endif
																@if (session('error'))
																		<div class="alert alert-danger alert-dismissible fade show" role="alert">
																				{{ session('error') }}
																				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																		</div>
																@endif
																<button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
														</div>
												</form>
										</div>
								</div>
						</div>
				</div>
		</section>
</div>
