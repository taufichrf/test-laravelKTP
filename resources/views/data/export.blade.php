<head>
	<title>Export Data PDF</title>
</head>

<h2 style="text-align:center">Data KTP</h2>
<table border="1" cellspacing="0" cellpadding="5">
	<tr>
		<th>No</th>
		<th style="text-align: center">NIK</th>
		<th style="text-align: center">Nama</th>
		<th style="text-align: center">Tempat, Tanggal Lahir</th>
		<th style="text-align: center">Jenis Kelamin</th>
		<th style="text-align: center">Gol. Darah</th>
		<th style="text-align: center">Alamat</th>
		<th style="text-align: center">Agama</th>
		<th style="text-align: center">Status</th>
		<th style="text-align: center">Pekerjaan</th>
		<th style="text-align: center">Kewarganegaraan</th>
	</tr>
	@php
	$i = 1;
	foreach($data as $value){
		echo 
		"<tr>
			<td style='text-align: center'>".$i++."</td>
			<td>".$value->nik."</td>
			<td>".$value->nama."</td>
			<td>".$value->tempat_lahir.", ".\Carbon\Carbon::parse($value->tgl_lahir)->isoFormat('DD MMMM Y')."</td>";
			if($value->jenis_kelamin == 1)
			{
				echo "<td>Laki-laki</td>";
			}
			else{
				echo "<td>Perempuan</td>";
			}
			
			if($value->gol_darah == '-'){
				echo "<td>Tidak tahu</td>";
			}
			else{
				echo "<td style='text-align: center'>".$value->gol_darah."</td>";
			}
			
			echo
			"<td>".$value->alamat.", RT ".$value->rt."/RW ".$value->rw." Kelurahan ".$value->kelurahan." Kecamatan ".$value->kecamatan."</td>
			<td style='text-align: center'>".$value->agama."</td>";
			
			if($value->status == 1){
				echo "<td>Belum Kawin</td>";
			}
			else if($value->status == 2){
				echo "<td>Kawin</td>";
			}
			else if($value->status == 3){
				echo "<td>Cerai Hidup</td>";
			}
			else if($value->status == 4){
				echo "<td>Cerai Mati</td>";
			}
			
			echo
			"<td>".$value->pekerjaan."</td>
			<td style='text-align: center'>".$value->kewarganegaraan."</td>
		</tr>";
	} @endphp
</table>