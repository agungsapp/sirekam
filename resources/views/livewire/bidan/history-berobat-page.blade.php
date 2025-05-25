<div class="page-heading">
		<div class="page-title">
				<div class="row">
						<div class="col-12 col-md-6 order-md-1 order-last">
								<h3>History Berobat</h3>
								<p class="text-subtitle text-muted">Lihat riwayat kunjungan pasien yang telah selesai.</p>
						</div>
						<div class="col-12 col-md-6 order-md-2 order-first">
								<nav aria-label="breadcrumb" class="breadcrumb-header float-lg-end float-start">
										<ol class="breadcrumb">
												<li class="breadcrumb-item"><a href="{{ url('/bidan') }}">Dashboard</a></li>
												<li class="breadcrumb-item active" aria-current="page">History Berobat</li>
										</ol>
								</nav>
						</div>
				</div>
		</div>

		<section class="section">
				<!-- Form Filter Tanggal -->
				<div class="card">
						<div class="card-header">
								<h4 class="card-title">Filter Laporan</h4>
						</div>
						<div class="card-body">
								<form wire:submit.prevent="filterData">
										<div class="row">
												<div class="col-md-5">
														<div class="form-group">
																<label for="tanggal_awal">Tanggal Awal</label>
																<input type="date" class="form-control @error('tanggal_awal') is-invalid @enderror" id="tanggal_awal"
																		wire:model.defer="tanggal_awal">
																@error('tanggal_awal')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="col-md-5">
														<div class="form-group">
																<label for="tanggal_akhir">Tanggal Akhir</label>
																<input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror"
																		id="tanggal_akhir" wire:model.defer="tanggal_akhir">
																@error('tanggal_akhir')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="col-md-2">
														<div class="form-group">
																<label>&nbsp;</label>
																<button type="submit" class="btn btn-primary btn-block">Filter</button>
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
												<button type="button" wire:click="cetakPDF" class="btn btn-success">Cetak PDF</button>
										</div>
								</form>
						</div>
				</div>

				<!-- Tabel History Berobat -->
				<div class="row" id="table-striped">
						<div class="col-12">
								<div class="card">
										<div class="card-header">
												<h4 class="card-title">Daftar History Berobat</h4>
										</div>
										<div class="card-content">
												<div class="card-body">
														<p class="card-text">Daftar kunjungan pasien dengan status selesai.</p>
												</div>
												<div class="table-responsive">
														<table id="tableData" class="table-striped mb-0 table">
																<thead>
																		<tr>
																				<th>NAMA</th>
																				<th>NIK</th>
																				<th>JENIS KELAMIN</th>
																				<th>UMUR</th>
																				<th>NO HP</th>
																				<th>TANGGAL KUNJUNGAN</th>
																				<th>STATUS</th>
																				<th>ACTION</th>
																		</tr>
																</thead>
																<tbody>
																		@forelse ($pendaftars as $p)
																				<tr>
																						<td class="text-bold-500">{{ $p->pasien->nama }}</td>
																						<td>{{ $p->pasien->nik }}</td>
																						<td class="text-bold-500">{{ $p->pasien->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
																						<td>{{ $p->pasien->umur }} Tahun</td>
																						<td>{{ $p->pasien->no_hp }}</td>
																						<td>{{ \Carbon\Carbon::parse($p->tanggal_kunjungan)->format('d-m-Y') }}</td>
																						<td>{{ $p->status }}</td>
																						<td>
																								<a href="{{ route('bidan.detail-pendaftaran', $p->id) }}" class="btn btn-info"><i
																												class="bi bi-info-lg"></i></a>
																								@if ($p->status == 'menunggu')
																										<a href="{{ route('bidan.pemeriksaan-awal', $p->id) }}" class="btn btn-primary">
																												<i class="bi bi-search"></i> Periksa
																										</a>
																								@elseif($p->status == 'diperiksa')
																										<a href="{{ route('bidan.pemeriksaan-lanjut', $p->id) }}" class="btn btn-success">
																												<i class="bi bi-search"></i> Diagnosis
																										</a>
																								@endif
																						</td>
																				</tr>
																		@empty
																				<tr>
																						<td colspan="8" class="text-center">-- belum ada data --- </td>
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
