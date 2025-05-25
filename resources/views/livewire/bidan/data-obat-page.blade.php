<section class="section">
		<div class="row">
				<div class="col-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">{{ $selectedObatId ? 'Edit Obat' : 'Buat Obat Baru' }}</h4>
								</div>
								<form wire:submit.prevent="simpan">
										<div class="card-body">
												<div class="row">
														<div class="col-md-4 mb-3">
																<label for="nama" class="form-label">Nama Obat</label>
																<input type="text" class="form-control @error('nama') is-invalid @enderror" wire:model="nama"
																		id="nama" placeholder="Contoh: Paracetamol">
																@error('nama')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-8 mb-3">
																<label for="keterangan" class="form-label">Keterangan (Opsional)</label>
																<textarea class="form-control @error('keterangan') is-invalid @enderror" wire:model="keterangan" id="keterangan"
																  rows="4" placeholder="Masukkan keterangan obat"></textarea>
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
														{{ $selectedObatId ? 'Update Obat' : 'Simpan Obat' }}
												</button>
												@if ($selectedObatId)
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
										<h4 class="card-title">Daftar Obat</h4>
								</div>
								<div class="card-content">
										<div class="table-responsive">
												<table id="tableData" class="table-striped table">
														<thead>
																<tr>
																		<th>Nama</th>
																		<th>Keterangan</th>
																		<th>Aksi</th>
																</tr>
														</thead>
														<tbody>
																@forelse ($obats as $obat)
																		<tr>
																				<td>{{ $obat->nama }}</td>
																				<td>{{ $obat->keterangan ?? '-' }}</td>
																				<td>
																						<div class="d-flex">
																								<button wire:click="edit({{ $obat->id }})" class="btn btn-sm btn-warning me-1">
																										<i class="bi bi-pencil-fill"></i>
																								</button>
																								<button wire:click="delete({{ $obat->id }})" class="btn btn-sm btn-danger">
																										<i class="bi bi-trash-fill"></i>
																								</button>
																						</div>
																				</td>
																		</tr>
																@empty
																		<tr>
																				<td colspan="3" class="text-center">Belum ada data obat</td>
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
