<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
	
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<!-- Vendor CSS Files -->
    <!-- <link href="{{asset('/utama/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> -->

	<title>Hi</title>
</head>
<body>
	
	<div class="header">
		<!-- <img src="{{asset('storage/garuda.jpg')}}" class="" alt=""> -->
		<img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/storage/garuda.png'))) }}" alt="" style="width: 90px; height: 90px">
		<h1>BADAN KEPEGAWAIAN NEGARA</h1>
		<h1>KANTOR REGIONAL VIII</h1>
		<p class="m-0 p-0">
			Jalan Bhayangkara Nomor 1 Banjarbaru Selatan, Banjarbaru, Kalimantan Selatan 70714
		</p>
		<p class="m-0 p-0">
			Telepon (0511) 4781552; Faksimile (0511) 4782314
		</p>
		<p class="m-0 p-0">
			Laman: banjarmasin.bkn.go.id; Pos-el: kanreg8.banjarmasin@bkn.go.id
		</p>
	</div>
	<hr>

	<div class="keterangan">
		<div class="line2">
			<div class="justify-start">
				<p class="konten">Tgl Pengajuan</p>
				<p>: {{$tgl_pengajuan}}</p>
			</div>
			<div class="justify-end">
				<p class="konten">Tgl Efektif</p>
				<p>: 02 September 2013</p>
			</div>
		</div>
		<div class="line3">
			<div class="justify-start">
				<p class="konten">No. Agenda</p>
				<p>: {{$dokumenPenyerahan->no_agenda}}</p>
			</div>
			<div class="justify-end">
				<p class="konten">No. Revisi</p>
				<p>: 00</p>
			</div>
		</div>
		<div class="line4">
			<div class="justify-start">
				<p class="konten">Tgl Penyerahan</p>
				<p>:</p>
			</div>
		</div>
	</div>

	<div class="list-barang">
		<div class="judul-list-barang mb-4">
			<h2>PENYERAHAN BARANG PERSEDIAAN</h2>
		</div>
		<div class="konten-list-barang">
			<table class='table table-bordered' id=laporan_pengajuan>
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Barang</th>
						<th>Satuan</th>
						<th>Jumlah Diminta</th>
						<th>Jumlah Diberikan</th>
					</tr>
				</thead>
				<tbody>
					@php
						$rowid = 0
					@endphp
					@foreach($laporanPengajuan as $item)
						<tr>
							<td>{{$rowid +=1}}</td>
							<td>{{$item->barang->nama_barang}}</td>
							<td>{{$item->barang->satuan->nama_satuan}}</td>
							<td>{{$item->jumlah_barang}}</td>
							@if($item->revisi_jumlah_barang == "")
							<td>{{$item->jumlah_barang}}</td>
							@else
							<td>{{$item->revisi_jumlah_barang}}</td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="tanda-tangan">
		<div class="mengetahui">
			<p>Mengetahui,</p>
		</div>
		<table class='table' id="tanda_tangan">
			<tbody >
				<tr>
					<td width="25%">
						KEPALA SUB BAGIAN UMUM
					</td>

					<td width="25%">
						{{strtoupper($dokumenPenyerahan->administratorUser->jabatan->jabatan)}}
					</td>
					<td width="25%">
						YANG MENERIMA
					</td>
					<td width="25%">
						YANG MENYERAHKAN
					</td>
				</tr>
				<tr>
					<td>
						@if(isset($dokumenPenyerahan->ttdKasubUmum->ttdUser))
						<img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/storage/'.$dokumenPenyerahan->ttdKasubUmum->ttdUser->ttd))) }}" alt="" style="width: 150px; height: 150px;">
						@else
						XXXXXXX
						@endif
					</td>
					<td>
						@if(isset($dokumenPenyerahan->ttdAdministrator->ttdUser))
						<img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/storage/'.$dokumenPenyerahan->ttdAdministrator->ttdUser->ttd))) }}" alt="" style="width: 150px; height: 150px">
						@else
						XXXXXXX
						@endif
					</td>
					<td>
						@if(isset($dokumenPenyerahan->ttdPenerima->ttdUser))
						<img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/storage/'.$dokumenPenyerahan->ttdPenerima->ttdUser->ttd))) }}" alt="" style="width: 150px; height: 150px">
						@else
						XXXXXXX
						@endif
					</td>
					<td>
						@if(isset($dokumenPenyerahan->ttdPenyerah->ttdUser))
						<img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/storage/'.$dokumenPenyerahan->ttdPenyerah->ttdUser->ttd))) }}" alt="" style="width: 150px; height: 150px">
						@else
						XXXXXXX
						@endif
					</td>
				</tr>
				<tr>
					<td>
					{{strtoupper ($dokumenPenyerahan->kasubumumUser->name)}}
					</td>
					<td>
					{{strtoupper($dokumenPenyerahan->administratorUser->name)}}
					</td>
					<td>
					{{strtoupper($dokumenPenyerahan->penerimaUser->name)}}
					</td>
					<td>
					@if($dokumenPenyerahan->penyerahUser =="")
					-
					@else
					{{strtoupper($dokumenPenyerahan->penyerahUser->name)}}
					@endif
					</td>
				</tr>
				<tr>
					<td>
					NIP. {{$dokumenPenyerahan->kasubumumUser->nip}}	
					</td>
					<td>
					NIP. {{$dokumenPenyerahan->administratorUser->nip}}	
					</td>
					<td>
					NIP. {{$dokumenPenyerahan->penerimaUser->nip}}
					</td>
					<td>
					@if($dokumenPenyerahan->penyerahUser == "")
					-
					@else
					{{strtoupper($dokumenPenyerahan->penyerahUser->nip)}}
					@endif
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>

<style>

	.tanda-tangan td{
		font-size: 12px;
	}

	.mengetahui{
		margin-left: 120px;
		margin-bottom: 5px;
		/* border: 1px solid; */
	}
	.peran{
		display: inline-flex;
		/* border: 1px solid; */
		text-align: center;
		margin-top: 30px;
		width: 150px;
	}

	.peran p{
		/* display: inline-flex; */
		padding: 0px;
		margin-bottom: 0px ;
	}

	.peran .jabatan{
		height: 80px;
		/* border: 1px solid; */
	}

	.peran .ttd{
		height: 5rem;
	}

	body{
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		margin-left: 1cm;
		margin-right: 1cm;
	}
	.header{
		margin: auto;
		padding: 0px;
		text-align: center;
		width: 100%;
	}
	p{
		font-size: 14px;
	}
	h1{
		font-size: 16px;
	}

	h2{
		font-size: 14px;
		text-align: center;
	}

	hr{
		border: 1.5px solid black;
		
	}

	.keterangan p{
		padding: 0;
		margin: 2px;
	}
	.keterangan {
		margin-bottom: 25px;
	}
	
	.row{
		margin-bottom: 1px;
	}

	.justify-start{
		display: inline-flex; 
		width: 23rem;
	}

	.justify-end{
		display: inline-flex;
	}

	.justify-start  p {
		display: inline-flex ;
	}

	.justify-end  p {
		display: inline-flex ;
	}

	.justify-start .konten{
		width: 100px;
	}

	.justify-end .konten{
		width: 100px;
	}

	table {
		/* border: 1px solid; */
		font-size: 14px;
		text-align: center;
	}
	
	#laporan_pengajuan td, #laporan_pengajuan th {
		border: 1px solid black;
	}

	.tanda-tangan{
		page-break-inside: avoid;
	}
</style>
</html>