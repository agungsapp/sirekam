<section class="section">
		<div class="row">
				<div class="col-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">{{ $selectedGalleryId ? 'Edit Galeri' : 'Buat Galeri Baru' }}</h4>
								</div>
								<form wire:submit.prevent="simpan">
										<div class="card-body">
												<div class="row">
														<div class="col-md-4 mb-3">
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
														<div class="col-md-8 mb-3">
																<label for="keterangan" class="form-label">Keterangan</label>
																<textarea class="form-control @error('keterangan') is-invalid @enderror" wire:model="keterangan" id="keterangan"
																  rows="4" placeholder="Masukkan keterangan galeri"></textarea>
																@error('keterangan')
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
														{{ $selectedGalleryId ? 'Update Galeri' : 'Simpan Galeri' }}
												</button>
												@if ($selectedGalleryId)
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
										<h4 class="card-title">Daftar Galeri</h4>
								</div>
								<div class="card-content">
										<div class="table-responsive">
												<table id="tableData" class="table-striped table">
														<thead>
																<tr>
																		<th>Gambar</th>
																		<th>Keterangan</th>
																		<th>Aksi</th>
																</tr>
														</thead>
														<tbody>
																@forelse ($galleries as $g)
																		<tr>
																				<td>
																						<img src="{{ Storage::url($g->image) }}" alt="{{ $g->keterangan }}" class="img-fluid"
																								style="max-width: 100px;">
																				</td>
																				<td>{{ $g->keterangan }}</td>
																				<td>
																						<button wire:click="edit({{ $g->id }})" class="btn btn-sm btn-warning me-1">
																								<i class="bi bi-pencil-fill"></i>
																						</button>
																						<button wire:click="delete({{ $g->id }})" class="btn btn-sm btn-danger">
																								<i class="bi bi-trash-fill"></i>
																						</button>
																				</td>
																		</tr>
																@empty
																		<tr>
																				<td colspan="3" class="text-center">Belum ada data galeri</td>
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
