<!DOCTYPE html>
<html>

<head>
		<title>Laporan History Berobat</title>
		<style>
				body {
						font-family: Arial, sans-serif;
						margin: 20px;
				}

				.header {
						text-align: center;
						margin-bottom: 20px;
				}

				.header h1 {
						font-size: 24px;
						margin: 0;
				}

				.header p {
						margin: 5px 0;
				}

				table {
						width: 100%;
						border-collapse: collapse;
						margin-top: 20px;
				}

				th,
				td {
						border: 1px solid #000;
						padding: 8px;
						text-align: left;
				}

				th {
						background-color: #f2f2f2;
				}

				.text-center {
						text-align: center;
				}
		</style>
</head>

<body>
		<div class="header">
				<h1>LAPORAN KLINIK BPS RIDHO NURHIDAYAH</h1>
				<p>History Berobat Pasien</p>
				<p>Periode: {{ $tanggal_awal }} s/d {{ $tanggal_akhir }}</p>
		</div>

		<table>
				<thead>
						<tr>
								<th>No</th>
								<th>Nama</th>
								<th>NIK</th>
								<th>Jenis Kelamin</th>
								<th>Umur</th>
								<th>No HP</th>
								<th>Tanggal Kunjungan</th>
								<th>Status</th>
						</tr>
				</thead>
				<tbody>
						@foreach ($pendaftars as $index => $p)
								<tr>
										<td class="text-center">{{ $index + 1 }}</td>
										<td>{{ $p->pasien->nama }}</td>
										<td>{{ $p->pasien->nik }}</td>
										<td>{{ $p->pasien->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
										<td>{{ $p->pasien->umur }} Tahun</td>
										<td>{{ $p->pasien->no_hp }}</td>
										<td>{{ \Carbon\Carbon::parse($p->tanggal_kunjungan)->format('d-m-Y') }}</td>
										<td>{{ $p->status }}</td>
								</tr>
						@endforeach
				</tbody>
		</table>
</body>

</html>
