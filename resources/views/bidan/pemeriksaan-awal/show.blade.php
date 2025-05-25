@extends('bidan.layouts.app')
@section('content')
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
																				<th>TANGGAL KUNJUNGAN</th>
																				<th>STATUS</th>
																				<th>ACTION</th>
																		</tr>
																</thead>
																<tbody>
																		@forelse ($pendaftars as $p)
																				<tr>
																						<td class="text-bold-500">{{ $p->pasien->nama }}</td>
																						<td>{{ $p->pasien->nik }}</td>
																						<td class="text-bold-500">{{ $p->pasien->jenis_kelamin = 'l' ? 'laki - laki' : 'perempuan' }}</td>
																						<td>{{ $p->pasien->umur }}</td>
																						<td>{{ $p->pasien->no_hp }}</td>
																						<td>{{ $p->tanggal_kunjungan }}</td>
																						<td>{{ $p->status }}</td>
																						<td>
																								<a href="" class="btn btn-info">detail</a>
																								@if ($p->status == 'menunggu')
																										<a href="{{ route('bidan.pemeriksaan-awal.show', $p->id) }}" class="btn btn-primary">periksa</a>
																								@elseif($p->status == 'diperiksa')
																										<a href="" class="btn btn-primary">diagnosis</a>
																								@else
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
		</section>
@endsection

@push('script')
		<script>
				new DataTable('#tableData');
		</script>
@endpush
