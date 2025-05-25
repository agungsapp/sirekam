<section class="section">
		<div class="row">
				<div class="col-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">{{ $selectedTestimoniId ? 'Edit Testimoni' : 'Buat Testimoni Baru' }}</h4>
								</div>
								<form wire:submit.prevent="simpan">
										<div class="card-body">
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="nama" class="form-label">Nama</label>
																<input type="text" class="form-control @error('nama') is-invalid @enderror" wire:model="nama"
																		id="nama" placeholder="Contoh: Budi Santoso">
																@error('nama')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="pekerjaan" class="form-label">Pekerjaan</label>
																<input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
																		wire:model="pekerjaan" id="pekerjaan" placeholder="Contoh: Pegawai Swasta">
																@error('pekerjaan')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="testimoni" class="form-label">Testimoni</label>
																<textarea class="form-control @error('testimoni') is-invalid @enderror" wire:model="testimoni" id="testimoni"
																  rows="4" placeholder="Masukkan pesan testimoni"></textarea>
																@error('testimoni')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="image" class="form-label">Gambar</label>
																<input type="file" class="form-control @error('image') is-invalid @enderror" wire:model="image"
																		id="image" accept="image/*">
																@error('image')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
																@if ($imagePreview)
																		<div class="mt-2">
																				<img src="{{ $imagePreview }}" alt="Pratinjau Gambar" class="img-fluid" style="max-width: 200px;">
																		</div>
																@endif
														</div>
														<div class="col-md-6 mb-3">
																<label for="rating" class="form-label">Rating</label>
																<select class="form-control @error('rating') is-invalid @enderror" wire:model="rating" id="rating">
																		<option value="">Pilih Rating</option>
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																		<option value="5">5</option>
																</select>
																@error('rating')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="status" class="form-label">Status</label>
																<select class="form-control @error('status') is-invalid @enderror" wire:model="status" id="status">
																		<option value="">Pilih Status</option>
																		<option value="active">Active</option>
																		<option value="inactive">Inactive</option>
																</select>
																@error('status')
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
												<button type="submit" class="btn btn-primary">
														{{ $selectedTestimoniId ? 'Update Testimoni' : 'Simpan Testimoni' }}
												</button>
												@if ($selectedTestimoniId)
														<button type="button" class="btn btn-secondary" wire:click="resetForm">
																Batal
														</button>
												@endif
										</div>
								</form>
						</div>
				</div>
		</div>
		<div class="row" id="table-striped">
				<div class="col-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">Daftar Testimoni</h4>
								</div>
								<div class="card-content">
										<div class="table-responsive">
												<table id="tableData" class="table-striped table">
														<thead>
																<tr>
																		<th>Nama</th>
																		<th>Pekerjaan</th>
																		<th>Testimoni</th>
																		<th>Gambar</th>
																		<th>Rating</th>
																		<th>Status</th>
																		<th>Aksi</th>
																</tr>
														</thead>
														<tbody>
																@forelse ($testimonis as $t)
																		<tr>
																				<td>{{ $t->nama }}</td>
																				<td>{{ $t->pekerjaan }}</td>
																				<td>{{ Str::limit($t->testimoni, 100) }}</td>
																				<td>
																						<img src="{{ Storage::url($t->image) }}" alt="{{ $t->nama }}" class="img-fluid"
																								style="max-width: 100px;">
																				</td>
																				<td>{{ $t->rating }}</td>
																				<td>{{ ucfirst($t->status) }}</td>
																				<td>
																						<button wire:click="edit({{ $t->id }})" class="btn btn-sm btn-warning me-1">
																								<i class="bi bi-pencil-fill"></i>
																						</button>
																						<button wire:click="delete({{ $t->id }})" class="btn btn-sm btn-danger">
																								<i class="bi bi-trash-fill"></i>
																						</button>
																				</td>
																		</tr>
																@empty
																		<tr>
																				<td colspan="7" class="text-center">Belum ada data testimoni</td>
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

@push('script')
		<script>
				new DataTable('#tableData', {
						ordering: false,
						language: {
								search: "Cari:",
								lengthMenu: "Tampilkan _MENU_ entri",
								info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
								infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
								infoFiltered: "(disaring dari _MAX_ total entri)",
								paginate: {
										first: "Pertama",
										last: "Terakhir",
										next: "Selanjutnya",
										previous: "Sebelumnya"
								},
								zeroRecords: "Tidak ada data yang ditemukan"
						}
				});
		</script>
@endpush
