{{-- stripped table --}}
<section class="section">
		<div class="row" id="table-striped">
				<div class="col-12">
						<div class="card">

								<div class="card-content">
										<div class="card-body">
												<p class="card-text"></p>
										</div>
										<!-- table striped -->
										<div class="table-responsive">
												<table id="tableData" class="table-striped mb-0 table">
														<thead>
																<tr>
																		<th>NAMA</th>
																		<th>NIK</th>
																		<th>JENIS KELAMIN</th>
																		<th>UMUR</th>
																		<th>NO HP</th>
																		<th>HISTORY</th>
																		<th>ACTION</th>
																</tr>
														</thead>
														<tbody>

																@forelse ($pasiens as $p)
																		<tr>
																				<td class="text-bold-500">{{ $p->nama }}</td>
																				<td>{{ $p->nik }}</td>
																				<td class="text-bold-500">{{ $p->jenis_kelamin == 'l' ? 'laki - laki' : 'perempuan' }}</td>
																				<td>{{ $p->umur }} Tahun</td>
																				<td>{{ $p->no_hp }}</td>
																				<td>

																						<span class="badge rounded-pill bg-danger">{{ $p->pendaftaran->count() }}</span>

																				</td>
																				<td>
																						<a href="{{ route('bidan.detail-pasien', $p->id) }}" class="btn btn-info"><i
																										class="bi bi-info-lg"></i></a>

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


@push('script')
		<script>
				$(document).ready(function() {
						$('#tableData').DataTable({
								ordering: false // Nonaktifkan sorting otomatis
						});
				});
		</script>
@endpush
