<section class="section">
		<div class="row">
				<div class="col-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">Data Pemeriksaan Lanjutan</h4>
								</div>

								<form wire:submit.prevent="simpan">
										<div class="card-body">
												<div class="row">
														<div class="col-6">
																<div class="col-md-8 mb-3">
																		<label for="diagnosa" class="form-label">Diagnosa</label>
																		<textarea class="form-control @error('diagnosa') is-invalid @enderror" wire:model="diagnosa" id="diagnosa"
																		  rows="4" placeholder="Masukkan diagnosa pasien"></textarea>
																		@error('diagnosa')
																				<div class="invalid-feedback">{{ $message }}</div>
																		@enderror
																</div>
																<div class="col-md-8 mb-3">
																		<label for="tindakan" class="form-label">Tindakan</label>
																		<textarea class="form-control @error('tindakan') is-invalid @enderror" wire:model="tindakan" id="tindakan"
																		  rows="4" placeholder="Masukkan tindakan yang dilakukan"></textarea>
																		@error('tindakan')
																				<div class="invalid-feedback">{{ $message }}</div>
																		@enderror
																</div>
																<div class="col-md-8 form-check form-switch mb-3">
																		<input class="form-check-input" type="checkbox" id="perluRuang" wire:model.live="perluRuang">
																		<label class="form-check-label" for="perluRuang">Perlu Ruang Bersalin?</label>
																</div>
																@if ($perluRuang)
																		<div class="col-md-8 mb-3" wire:ignore.self>
																				<label for="selectedRuang" class="form-label">Pilih Ruangan</label>
																				<select wire:model="selectedRuang" id="selectedRuang"
																						class="form-control @error('selectedRuang') is-invalid @enderror">
																						<option value="">-- Pilih Ruangan --</option>
																						@foreach ($ruangans as $ruang)
																								<option value="{{ $ruang->id }}">{{ $ruang->nama }}</option>
																						@endforeach
																				</select>
																				@error('selectedRuang')
																						<div class="invalid-feedback">{{ $message }}</div>
																				@enderror
																		</div>
																@endif
														</div>
														<div class="col-6">
																<div class="col-md-10 mb-3">
																		<label for="selectedObat" class="form-label">Pilih Obat (Opsional)</label>
																		<div class="input-group">
																				<select wire:model="selectedObat" id="selectedObat"
																						class="form-control @error('selectedObat') is-invalid @enderror">
																						<option value="">-- Pilih Obat --</option>
																						@foreach ($obats as $obat)
																								<option value="{{ $obat->id }}">{{ $obat->nama }}
																										{{ $obat->keterangan ? '(' . $obat->keterangan . ')' : '' }}</option>
																						@endforeach
																				</select>
																				<input type="text" wire:model="aturan" id="aturan"
																						class="form-control @error('aturan') is-invalid @enderror"
																						placeholder="Masukkan aturan (contoh: 3x1 tablet)">
																				<button wire:click="tambahResep" type="button" class="btn btn-outline-primary">Tambah</button>
																		</div>
																		@error('selectedObat')
																				<div class="invalid-feedback">{{ $message }}</div>
																		@enderror
																		@error('aturan')
																				<div class="invalid-feedback">{{ $message }}</div>
																		@enderror
																</div>
																<div class="col-md-10 mb-3">
																		<h6>Daftar Resep Sementara</h6>
																		<div class="table-responsive">
																				<table class="table-bordered table-striped table">
																						<thead>
																								<tr>
																										<th>Nama Obat</th>
																										<th>Keterangan</th>
																										<th>Aturan</th>
																										<th>Aksi</th>
																								</tr>
																						</thead>
																						<tbody>
																								@forelse ($tempReseps as $index => $resep)
																										<tr>
																												<td>{{ $resep['nama_obat'] }}</td>
																												<td>{{ $resep['keterangan'] ?? '-' }}</td>
																												<td>{{ $resep['aturan'] }}</td>
																												<td>
																														<button wire:click="hapusResep({{ $index }})"
																																class="btn btn-sm btn-danger">Hapus</button>
																												</td>
																										</tr>
																								@empty
																										<tr>
																												<td colspan="4" class="text-center">Belum ada obat ditambahkan</td>
																										</tr>
																								@endforelse
																						</tbody>
																				</table>
																		</div>
																		@if (session('success_temp'))
																				<div class="alert alert-success alert-dismissible fade show" role="alert">
																						{{ session('success_temp') }}
																						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																				</div>
																		@endif
																</div>
														</div>
												</div>
										</div>

										<div class="card-footer">
												@if (session('success'))
														<div class="alert alert-success">{{ session('success') }}</div>
												@endif
												@if (session('error'))
														<div class="alert alert-danger">{{ session('error') }}</div>
												@endif
												<button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
										</div>
								</form>
						</div>
				</div>
		</div>

		<div class="row">
				<div class="col-md-4 col-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">Data Pasien</h4>
								</div>
								<div class="card-body">
										<table class="table-bordered table">
												<tr>
														<th>NIK</th>
														<td>{{ $pendaftar->pasien->nik ?? '-' }}</td>
												</tr>
												<tr>
														<th>Nama</th>
														<td>{{ $pendaftar->pasien->nama ?? '-' }}</td>
												</tr>
												<tr>
														<th>Jenis Kelamin</th>
														<td>{{ $pendaftar->pasien->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
												</tr>
												<tr>
														<th>Umur</th>
														<td>{{ $pendaftar->pasien->umur ? $pendaftar->pasien->umur . ' Tahun' : '-' }}</td>
												</tr>
												<tr>
														<th>No. HP</th>
														<td>{{ $pendaftar->pasien->no_hp ?? '-' }}</td>
												</tr>
												<tr>
														<th>Alamat</th>
														<td>{{ $pendaftar->pasien->alamat ?? '-' }}</td>
												</tr>
												<tr>
														<th>Tanggal Daftar</th>
														<td>{{ $pendaftar->pasien->created_at?->format('d-m-Y') ?? '-' }}</td>
												</tr>
										</table>
								</div>
						</div>
				</div>

				<div class="col-md-8 col-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">Data Pemeriksaan Awal</h4>
								</div>
								<div class="card-body">
										@if ($pemeriksaanAwal)
												<table class="table-bordered table">
														<tr>
																<th>Tanggal Periksa</th>
																<td>{{ $pemeriksaanAwal->tanggal_periksa }}</td>
														</tr>
														<tr>
																<th>Tekanan Darah</th>
																<td>{{ $pemeriksaanAwal->tekanan_darah ?? '-' }}</td>
														</tr>
														<tr>
																<th>Berat Badan</th>
																<td>{{ $pemeriksaanAwal->berat_badan ? $pemeriksaanAwal->berat_badan . ' kg' : '-' }}</td>
														</tr>
														<tr>
																<th>Tinggi Badan</th>
																<td>{{ $pemeriksaanAwal->tinggi_badan ? $pemeriksaanAwal->tinggi_badan . ' cm' : '-' }}</td>
														</tr>
														<tr>
																<th>Keluhan</th>
																<td>{{ $pemeriksaanAwal->keluhan ?? '-' }}</td>
														</tr>
														<tr>
																<th>Petugas</th>
																<td>{{ $pemeriksaanAwal->user?->name ?? '-' }}</td>
														</tr>
														<tr>
																<th>Tanggal Dibuat</th>
																<td>{{ $pemeriksaanAwal->created_at }}</td>
														</tr>
												</table>
										@else
												<div class="alert alert-warning">Data pemeriksaan awal belum tersedia.</div>
										@endif
								</div>
						</div>
				</div>
		</div>
</section>
