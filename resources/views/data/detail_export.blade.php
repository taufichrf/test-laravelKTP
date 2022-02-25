<head>
	<title>Export Data PDF</title>
</head>

<body>
	<table cellpadding="15">
		<tbody>
			<tr>
				<td><img src="../public/foto/{{ $data->foto }}" width="100px"></img></td>
				<td><h3>{{ $data->nama }}</h3></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table cellpadding="8">
		<tbody>
			<tr>
				<td>NIK</td>
				<td class="text-dark font-weight-semibold"> : {{ $data->nik }}</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td class="text-dark font-weight-semibold"> : {{ $data->nama }}</td>
			</tr>
			<tr>
				<td>Tempat, tanggal lahir</td>
				<td class="text-dark font-weight-semibold"> : {{ $data->tempat_lahir }},  {{ \Carbon\Carbon::parse($data->tgl_lahir)->isoFormat('DD MMMM Y') }}</td>
			</tr>
			<tr>
				<td>Usia</td>
				<td class="text-dark font-weight-semibold"> : {{ \Carbon\Carbon::parse($data->tgl_lahir)->age }} tahun</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				@if ($data->jenis_kelamin == 1)
					<td class="text-dark font-weight-semibold"> : Laki-laki</td>
				@else
					<td class="text-dark font-weight-semibold"> : Perempuan</td>
				@endif
			</tr>
			<tr>
				<td>Golongan Darah</td>
				@if ($data->gol_darah == '-')
					<td class="text-dark font-weight-semibold"> : Tidak tahu</td>
				@else
					<td class="text-dark font-weight-semibold"> : {{ $data->gol_darah }}</td>
				@endif
			</tr>
			<tr>
				<td>Alamat</td>
				<td class="text-dark font-weight-semibold"> : {{ $data->alamat }}, RT {{ $data->rt }}/RW {{ $data->rw }} Kelurahan {{ $data->kelurahan }} Kecamatan {{ $data->kecamatan }}</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td class="text-dark font-weight-semibold"> : {{ $data->agama }}</td>
			</tr>
			<tr>
				<td>Status</td>
				@if ($data->status == 1)
					<td class="text-dark font-weight-semibold"> : Belum Kawin</td>
				@elseif ($data->status == 2)
					<td class="text-dark font-weight-semibold"> : Kawin</td>
				@elseif ($data->status == 3)
					<td class="text-dark font-weight-semibold"> : Cerai Hidup</td>
				@elseif ($data->status == 4)
					<td class="text-dark font-weight-semibold"> : Cerai Mati</td>
				@endif
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td class="text-dark font-weight-semibold"> : {{ $data->pekerjaan }}</td>
			</tr>
			<tr>
				<td>Kewarganegaraan</td>
				<td class="text-dark font-weight-semibold"> : {{ $data->kewarganegaraan }}</td>
			</tr>
		</tbody>
	</table>
</body>