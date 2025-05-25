<section class="section">
		<div class="row">
				<div class="col-md-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">Data Pasien</h4>
										<span class="badge bg-warning text-dark text-capitalize">{{ $pendaftar->status }}</span>
								</div>
								<div class="card-body">
										<table class="table-bordered table">
												<tr>
														<th>NIK</th>
														<td>{{ $pendaftar->pasien->nik }}</td>
												</tr>
												<tr>
														<th>Nama</th>
														<td>{{ $pendaftar->pasien->nama }}</td>
												</tr>
												<tr>
														<th>Jenis Kelamin</th>
														<td>{{ $pendaftar->pasien->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
												</tr>
												<tr>
														<th>Umur</th>
														<td>{{ $pendaftar->pasien->umur }} Tahun</td>
												</tr>
												<tr>
														<th>No. HP</th>
														<td>{{ $pendaftar->pasien->no_hp }}</td>
												</tr>
												<tr>
														<th>Alamat</th>
														<td>{{ $pendaftar->pasien->alamat }}</td>
												</tr>
												<tr>
														<th>Tanggal Daftar</th>
														<td>{{ $pendaftar->pasien->created_at }}</td>
												</tr>
										</table>
								</div>
						</div>
				</div>
		</div>
		<div class="row">
				<div class="col-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">Data Pemeriksaan</h4>
								</div>
								<div class="card-body">
										<table class="table-bordered table">
												<thead>
														<tr>
																<th>Tanggal Periksa</th>
																<th>Tekanan Darah</th>
																<th>Berat Badan</th>
																<th>Tinggi Badan</th>
																<th>Keluhan</th>
																<th>Diagnosa</th>
																<th>Tindakan</th>
																<th>Ruang Bersalin</th>
																<th>Obat</th>
														</tr>
												</thead>
												<tbody>
														<tr>
																<td>{{ $pendaftar->awal ? $pendaftar->awal->tanggal_periksa : '' }}</td>
																<td>{{ $pendaftar->awal ? $pendaftar->awal->tekanan_darah : '-' }}</td>
																<td>{{ $pendaftar->awal ? $pendaftar->awal->berat_badan . ' kg' : '-' }}</td>
																<td>{{ $pendaftar->awal ? $pendaftar->awal->tinggi_badan . ' cm' : '-' }}</td>
																<td>{{ $pendaftar->awal ? $pendaftar->awal->keluhan : '-' }}</td>
																<td>{{ $pendaftar->lanjut ? $pendaftar->lanjut->diagnosa : '-' }}</td>
																<td>{{ $pendaftar->lanjut ? $pendaftar->lanjut->tindakan : '-' }}</td>
																<td>{{ $pendaftar->lanjut && $pendaftar->lanjut->ruang ? $pendaftar->lanjut->ruang->nama : '-' }}</td>
																<td>
																		@if ($pendaftar->lanjut && $pendaftar->lanjut->resep->isNotEmpty())
																				{{-- {{ $pendaftar->lanjut->resep->pluck('obat.nama')->implode(', ') }} --}}
																				<ul>
																						{{-- @dd($pendaftar->lanjut->resep) --}}
																						@foreach ($pendaftar->lanjut->resep as $plr)
																								{{-- @dd($plr) --}}
																								<li>{{ $plr->obat->nama . ' aturan ' . $plr->aturan . ' x ' . 'sehari' }}</li>
																						@endforeach
																				</ul>
																		@else
																				-
																		@endif
																</td>
														</tr>
												</tbody>
										</table>
								</div>
						</div>
				</div>

		</div>
</section>
