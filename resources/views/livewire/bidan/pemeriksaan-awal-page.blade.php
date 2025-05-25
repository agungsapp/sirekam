<section class="section">
		<div class="row">
				<div class="col">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">Data Pemeriksaan Awal</h4>
								</div>

								<form wire:submit.prevent="simpan">
										<div class="card-body">
												<div class="row">
														<div class="col-md-4 mb-3">
																<label for="tanggalPeriksa" class="form-label">Tanggal Periksa</label>
																<input type="date" class="form-control @error('tanggalPeriksa') is-invalid @enderror"
																		wire:model="tanggalPeriksa" id="tanggalPeriksa">
																@error('tanggalPeriksa')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>

														<div class="col-md-4 mb-3">
																<label for="tekananDarah" class="form-label">Tekanan Darah (mmHg)</label>
																<input type="text" class="form-control @error('tekananDarah') is-invalid @enderror"
																		wire:model="tekananDarah" id="tekananDarah" placeholder="Contoh: 120/80">
																@error('tekananDarah')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>

														<div class="col-md-4 mb-3">
																<label for="beratBadan" class="form-label">Berat Badan (kg)</label>
																<input type="number" step="0.1" class="form-control @error('beratBadan') is-invalid @enderror"
																		wire:model="beratBadan" id="beratBadan" placeholder="Masukkan berat badan">
																@error('beratBadan')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>

														<div class="col-md-4 mb-3">
																<label for="tinggiBadan" class="form-label">Tinggi Badan (cm)</label>
																<input type="number" step="0.1" class="form-control @error('tinggiBadan') is-invalid @enderror"
																		wire:model="tinggiBadan" id="tinggiBadan" placeholder="Masukkan tinggi badan">
																@error('tinggiBadan')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>

														<div class="col-md-8 mb-3">
																<label for="keluhan" class="form-label">Keluhan</label>
																<textarea class="form-control @error('keluhan') is-invalid @enderror" wire:model="keluhan" id="keluhan" rows="4"
																  placeholder="Masukkan keluhan pasien"></textarea>
																@error('keluhan')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
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
				<div class="col-md-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">Data Pasien</h4>
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
														<td>{{ $pendaftar->pasien->created_at->format('d-m-Y') }}</td>
												</tr>
										</table>
								</div>
						</div>
				</div>
		</div>
</section>
