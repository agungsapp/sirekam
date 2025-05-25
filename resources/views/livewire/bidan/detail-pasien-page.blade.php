<section class="section">
		<div class="row">
				<div class="col-md-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">Data Pasien</h4>
								</div>
								<div class="card-body">
										<table class="table-bordered table">
												<tr>
														<th>NIK</th>
														<td>{{ $pasien->nik }}</td>
												</tr>
												<tr>
														<th>Nama</th>
														<td>{{ $pasien->nama }}</td>
												</tr>
												<tr>
														<th>Jenis Kelamin</th>
														<td>{{ $pasien->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
												</tr>
												<tr>
														<th>Umur</th>
														<td>{{ $pasien->umur }} Tahun</td>
												</tr>
												<tr>
														<th>No. HP</th>
														<td>{{ $pasien->no_hp }}</td>
												</tr>
												<tr>
														<th>Alamat</th>
														<td>{{ $pasien->alamat }}</td>
												</tr>
												<tr>
														<th>Tanggal Daftar</th>
														<td>{{ $pasien->created_at }}</td>
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
										<h4 class="card-title">Riwayat Pendaftaran</h4>
								</div>
								<div class="card-body">
										<div class="accordion" id="accordionPendaftaran">
												@forelse ($pasien->pendaftaran as $pd)
														<div class="accordion-item">
																<h2 class="accordion-header" id="heading{{ $pd->id }}">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
																				data-bs-target="#collapse{{ $pd->id }}" aria-expanded="false"
																				aria-controls="collapse{{ $pd->id }}">
																				{{ $pd->tanggal_kunjungan }} - {{ ucfirst($pd->status) }}
																		</button>
																</h2>
																<div id="collapse{{ $pd->id }}" class="accordion-collapse collapse"
																		aria-labelledby="heading{{ $pd->id }}" data-bs-parent="#accordionPendaftaran">
																		<div class="accordion-body">
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
																										<td>{{ $pd->awal ? $pd->awal->tanggal_periksa : '' }}</td>
																										<td>{{ $pd->awal ? $pd->awal->tekanan_darah : '-' }}</td>
																										<td>{{ $pd->awal ? $pd->awal->berat_badan . ' kg' : '-' }}</td>
																										<td>{{ $pd->awal ? $pd->awal->tinggi_badan . ' cm' : '-' }}</td>
																										<td>{{ $pd->awal ? $pd->awal->keluhan : '-' }}</td>
																										<td>{{ $pd->lanjut ? $pd->lanjut->diagnosa : '-' }}</td>
																										<td>{{ $pd->lanjut ? $pd->lanjut->tindakan : '-' }}</td>
																										<td>{{ $pd->lanjut && $pd->lanjut->ruang ? $pd->lanjut->ruang->nama : '-' }}</td>
																										<td>
																												@if ($pd->lanjut && $pd->lanjut->resep->isNotEmpty())
																														{{-- {{ $pd->lanjut->resep->pluck('obat.nama')->implode(', ') }} --}}
																														<ul>
																																{{-- @dd($pd->lanjut->resep) --}}
																																@foreach ($pd->lanjut->resep as $plr)
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
												@empty
														<p>Tidak ada riwayat pendaftaran.</p>
												@endforelse
										</div>
								</div>
						</div>
				</div>
		</div>
</section>
