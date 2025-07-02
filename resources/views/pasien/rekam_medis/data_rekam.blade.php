<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Data Rekam Pasien</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
				integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<style>
				body {
						font-family: Arial, sans-serif;
						line-height: 1.6;
				}

				.header {
						border-bottom: 2px solid #000;
						padding: 15px 0;
						text-align: center;
						margin-bottom: 20px;
				}

				.header h1 {
						margin: 0;
						font-size: 1.8rem;
						font-weight: bold;
				}

				.header p {
						margin: 5px 0;
						font-size: 1rem;
						color: #333;
				}

				.table th {
						background-color: #e9ecef;
				}

				.card-header {
						background-color: #f8f9fa;
						font-weight: bold;
				}

				@media print {
						@page {
								size: landscape;
								margin: 1cm;
						}
				}
		</style>
</head>

<body onload="window.print()">
		<div class="container my-4">
				<div class="header">
						<h1>Klinik BPS Nurhidayah</h1>
						<p>G8WM+VCQ, Tanjung Baru, Merbau Mataram, South Lampung Regency, Lampung 35245</p>
						<p>Telp: (0721) 123-4567 | Email: info@bpsnurhidayah.com</p>
				</div>

				<h2 class="mb-4">Data Pasien</h2>
				<div class="card mb-4">
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
												<td>
														@php
																$umur = now()->diffInYears($pasien->tanggal_lahir);
														@endphp
														{{ $umur }} Tahun
												</td>
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
												<td>{{ $pasien->created_at->format('d-m-Y') }}</td>
										</tr>
								</table>
						</div>
				</div>

				<h2 class="mb-4">Riwayat Pendaftaran</h2>
				@forelse ($pasien->pendaftaran as $pd)
						<div class="card mb-3">
								<div class="card-header">
										<strong>{{ $pd->tanggal_kunjungan }} - {{ ucfirst($pd->status) }}</strong>
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
																<td>{{ $pd->awal ? $pd->awal->tanggal_periksa : '-' }}</td>
																<td>{{ $pd->awal ? $pd->awal->tekanan_darah : '-' }}</td>
																<td>{{ $pd->awal ? $pd->awal->berat_badan . ' kg' : '-' }}</td>
																<td>{{ $pd->awal ? $pd->awal->tinggi_badan . ' cm' : '-' }}</td>
																<td>{{ $pd->awal ? $pd->awal->keluhan : '-' }}</td>
																<td>{{ $pd->lanjut ? $pd->lanjut->diagnosa : '-' }}</td>
																<td>{{ $pd->lanjut ? $pd->lanjut->tindakan : '-' }}</td>
																<td>{{ $pd->lanjut && $pd->lanjut->ruang ? $pd->lanjut->ruang->nama : '-' }}</td>
																<td>
																		@if ($pd->lanjut && $pd->lanjut->resep->isNotEmpty())
																				<ul class="list-unstyled">
																						@foreach ($pd->lanjut->resep as $plr)
																								<li>{{ $plr->obat->nama . ' aturan ' . $plr->aturan . ' x sehari' }}</li>
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
				@empty
						<p class="text-muted">Tidak ada riwayat pendaftaran.</p>
				@endforelse
		</div>
</body>

</html>
