<section class="section">
		<div class="row">
				<div class="col-12">
						<div class="card">
								<div class="card-header">
										<h4 class="card-title">{{ $selectedFaqId ? 'Edit FAQ' : 'Buat FAQ Baru' }}</h4>
								</div>
								<form wire:submit.prevent="simpan">
										<div class="card-body">
												<div class="row">
														<div class="col-md-6 mb-3">
																<label for="question" class="form-label">Pertanyaan</label>
																<input type="text" class="form-control @error('question') is-invalid @enderror" wire:model="question"
																		id="question" placeholder="Contoh: Apa jam operasional klinik?">
																@error('question')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="col-md-6 mb-3">
																<label for="answer" class="form-label">Jawaban</label>
																<textarea class="form-control @error('answer') is-invalid @enderror" wire:model="answer" id="answer" rows="4"
																  placeholder="Masukkan jawaban untuk pertanyaan"></textarea>
																@error('answer')
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
														{{ $selectedFaqId ? 'Update FAQ' : 'Simpan FAQ' }}
												</button>
												@if ($selectedFaqId)
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
										<h4 class="card-title">Daftar FAQ</h4>
								</div>
								<div class="card-content">
										<div class="table-responsive">
												<table id="tableData" class="table-striped table">
														<thead>
																<tr>
																		<th>Pertanyaan</th>
																		<th>Jawaban</th>
																		<th>Aksi</th>
																</tr>
														</thead>
														<tbody>
																@forelse ($faqs as $f)
																		<tr>
																				<td>{{ $f->question }}</td>
																				<td>{{ Str::limit($f->answer, 100) }}</td>
																				<td>
																						<button wire:click="edit({{ $f->id }})" class="btn btn-sm btn-warning me-1">
																								<i class="bi bi-pencil-fill"></i>
																						</button>
																						<button wire:click="delete({{ $f->id }})" class="btn btn-sm btn-danger">
																								<i class="bi bi-trash-fill"></i>
																						</button>
																				</td>
																		</tr>
																@empty
																		<tr>
																				<td colspan="3" class="text-center">Belum ada data FAQ</td>
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
