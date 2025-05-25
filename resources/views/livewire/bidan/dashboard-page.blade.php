<div class="page-content">
		<section class="row">
				<div class="col-12 col-lg-9">
						<div class="row">
								<div class="col-6 col-lg-3 col-md-6">
										<div class="card">
												<div class="card-body py-4-5 px-4">
														<div class="row">
																<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
																		<div class="stats-icon purple mb-2">
																				<i class="iconly-boldShow"></i>
																		</div>
																</div>
																<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
																		<h6 class="text-muted font-semibold">Data Obat</h6>
																		<h6 class="mb-0 font-extrabold">{{ $counting['dataObat'] }}</h6>
																</div>
														</div>
												</div>
										</div>
								</div>
								<div class="col-6 col-lg-3 col-md-6">
										<div class="card">
												<div class="card-body py-4-5 px-4">
														<div class="row">
																<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
																		<div class="stats-icon blue mb-2">
																				<i class="iconly-boldProfile"></i>
																		</div>
																</div>
																<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
																		<h6 class="text-muted font-semibold">Data Ruang</h6>
																		<h6 class="mb-0 font-extrabold">{{ $counting['dataRuang'] }}</h6>
																</div>
														</div>
												</div>
										</div>
								</div>
								<div class="col-6 col-lg-3 col-md-6">
										<div class="card">
												<div class="card-body py-4-5 px-4">
														<div class="row">
																<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
																		<div class="stats-icon green mb-2">
																				<i class="iconly-boldAdd-User"></i>
																		</div>
																</div>
																<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
																		<h6 class="text-muted font-semibold">Pasien menunggu</h6>
																		<h6 class="mb-0 font-extrabold">{{ $counting['menunggu'] }}</h6>
																</div>
														</div>
												</div>
										</div>
								</div>
								<div class="col-6 col-lg-3 col-md-6">
										<div class="card">
												<div class="card-body py-4-5 px-4">
														<div class="row">
																<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
																		<div class="stats-icon red mb-2">
																				<i class="iconly-boldBookmark"></i>
																		</div>
																</div>
																<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
																		<h6 class="text-muted font-semibold">Pasien diperiksa</h6>
																		<h6 class="mb-0 font-extrabold">{{ $counting['diperiksa'] }}</h6>
																</div>
														</div>
												</div>
										</div>
								</div>
						</div>

						<div class="row">

								<div class="col-12 col-xl-12">
										<div class="card">
												<div class="card-header">
														<h4>Pasien Terbaru</h4>
												</div>
												<div class="card-body">
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
																				@forelse ($terbaru as $p)
																						<tr>
																								<td class="text-bold-500">{{ $p->pasien->nama }}</td>
																								<td>{{ $p->pasien->nik }}</td>
																								<td class="text-bold-500">{{ $p->pasien->jenis_kelamin == 'l' ? 'laki - laki' : 'perempuan' }}
																								</td>
																								<td>{{ $p->pasien->umur }} Tahun</td>
																								<td>{{ $p->pasien->no_hp }}</td>
																								<td>{{ $p->tanggal_kunjungan }}</td>
																								<td>{{ $p->status }}</td>
																								<td>
																										<a href="{{ route('bidan.detail-pendaftaran', $p->id) }}" class="btn btn-info"><i
																														class="bi bi-info-lg"></i></a>
																										@if ($p->status == 'menunggu')
																												<a href="{{ route('bidan.pemeriksaan-awal', $p->id) }}" class="btn btn-primary"> <i
																																class="bi bi-search"></i> periksa </a>
																										@elseif($p->status == 'diperiksa')
																												<a href="{{ route('bidan.pemeriksaan-lanjut', $p->id) }}" class="btn btn-success"> <i
																																class="bi bi-search"></i> diagnosis</a>
																										@else
																												<p class="d-inline"> Selesai</p>
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
				</div>
				<div class="col-12 col-lg-3">
						<div class="card">
								<div class="card-body px-4 py-4">
										<div class="d-flex align-items-center">
												<div class="avatar avatar-xl">
														<img src="{{ Storage::url(Auth::user()->image) }}" alt="{{ Auth::user()->image }}">
												</div>
												<div class="name ms-3">
														<h5 class="font-bold">{{ Auth::user()->name }}</h5>
														<h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6>
												</div>
										</div>
								</div>
						</div>

				</div>
		</section>
</div>
