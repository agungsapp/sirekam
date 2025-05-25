<div class="page-heading">
		<div class="page-title">
				<div class="row">
						<div class="col-12 col-md-6 order-md-1 order-last">
								<h3>Data Pasien</h3>
								<p class="text-subtitle text-muted">Kelola data pasien klinik.</p>
						</div>
						<div class="col-12 col-md-6 order-md-2 order-first">
								<nav aria-label="breadcrumb" class="breadcrumb-header float-lg-end float-start">
										<ol class="breadcrumb">
												<li class="breadcrumb-item"><a href="{{ url('/bidan') }}">Dashboard</a></li>
												<li class="breadcrumb-item active" aria-current="page">Data Pasien</li>
										</ol>
								</nav>
						</div>
				</div>
		</div>

		<section class="section">
				<!-- Form Input Pasien -->
				<div class="card">
						<div class="card-header">
								<h4 class="card-title">{{ $editMode ? 'Edit Pasien' : 'Tambah Pasien' }}</h4>
						</div>
						<div class="card-body">
								<form wire:submit.prevent="{{ $editMode ? 'updatePasien' : 'simpanPasien' }}">
										<div class="row">
												<div class="col-md-6">
														<div class="form-group">
																<label for="nik">NIK</label>
																<input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
																		wire:model.defer="nik">
																@error('nik')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="col-md-6">
														<div class="form-group">
																<label for="nama">Nama</label>
																<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
																		wire:model.defer="nama">
																@error('nama')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="col-md-6">
														<div class="form-group">
																<label for="jenis_kelamin">Jenis Kelamin</label>
																<select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
																		wire:model.defer="jenis_kelamin">
																		<option value="">Pilih Jenis Kelamin</option>
																		<option value="l">Laki-laki</option>
																		<option value="p">Perempuan</option>
																</select>
																@error('jenis_kelamin')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="col-md-6">
														<div class="form-group">
																<label for="tanggal_lahir">Tanggal Lahir</label>
																<input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
																		id="tanggal_lahir" wire:model.defer="tanggal_lahir">
																@error('tanggal_lahir')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="col-md-6">
														<div class="form-group">
																<label for="no_hp">No. HP</label>
																<input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
																		wire:model.defer="no_hp">
																@error('no_hp')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="col-md-6">
														<div class="form-group">
																<label for="alamat">Alamat</label>
																<textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" wire:model.defer="alamat"
																  rows="4"></textarea>
																@error('alamat')
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
												<button type="submit"
														class="btn btn-primary">{{ $editMode ? 'Simpan Perubahan' : 'Simpan Pasien' }}</button>
												@if ($editMode)
														<button type="button" wire:click="batalEdit" class="btn btn-secondary">Batal</button>
												@endif
										</div>
								</form>
						</div>
				</div>

				<!-- Tabel Pasien -->
				<div class="row" id="table-striped">
						<div class="col-12">
								<div class="card">
										<div class="card-header">
												<h4 class="card-title">Daftar Pasien</h4>
										</div>
										<div class="card-content">
												<div class="card-body">
														<p class="card-text">Daftar semua pasien yang terdaftar di klinik.</p>
												</div>
												<!-- table striped -->
												<div class="table-responsive">
														<table id="tableData" class="table-striped mb-0 table">
																<thead>
																		<tr>
																				<th>NAMA</th>
																				<th>NIK</th>
																				<th>JENIS KELAMIN</th>
																				<th>UMUR</th>
																				<th>NO HP</th>
																				<th>HISTORY</th>
																				<th>ACTION</th>
																		</tr>
																</thead>
																<tbody>
																		@forelse ($pasiens as $p)
																				<tr>
																						<td class="text-bold-500">{{ $p->nama }}</td>
																						<td>{{ $p->nik }}</td>
																						<td class="text-bold-500">{{ $p->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
																						<td>{{ $p->umur }} Tahun</td>
																						<td>{{ $p->no_hp }}</td>
																						<td>
																								<span class="badge rounded-pill bg-danger">{{ $p->pendaftaran->count() }}</span>
																						</td>
																						<td>
																								<a href="{{ route('bidan.detail-pasien', $p->id) }}" class="btn btn-info"><i
																												class="bi bi-info-lg"></i></a>
																								<button wire:click="editPasien({{ $p->id }})" class="btn btn-warning"><i
																												class="bi bi-pencil-square"></i></button>
																						</td>
																				</tr>
																		@empty
																				<tr>
																						<td colspan="7" class="text-center">-- belum ada data --- </td>
																				</tr>
																		@endforelse
																</tbody>
														</table>
												</div>
										</div>
								</div>
						</div>
				</div>
		</section>
</div>

@push('script')
		<script>
				$(document).ready(function() {
						$('#tableData').DataTable({
								ordering: false // Nonaktifkan sorting otomatis
						});
				});
		</script>
@endpush
