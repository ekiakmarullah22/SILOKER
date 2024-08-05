@extends('master.masterHome')

@push('css')
    <style>

@import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap');
.container{
	max-width: 1230px;
	width: 100%;
}

h1{
	font-weight: 700;
	font-size: 45px;
	font-family: 'Roboto', sans-serif;
}

.header{
	margin-bottom: 80px;
}
#description{
	font-size: 24px;
}

.form-wrap{
	background: rgba(255,255,255,1);
	width: 100%;
	max-width: 850px;
	padding: 50px;
	margin: 0 auto;
	position: relative;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	-webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
	-moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
	box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
}
.form-wrap:before{
	content: "";
	width: 90%;
	height: calc(100% + 60px);
	left: 0;
	right: 0;
	margin: 0 auto;
	position: absolute;
	top: -30px;
	background: #00bcd9;
	z-index: -1;
	opacity: 0.8;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	-webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
	-moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
	box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
}
.form-group{
	margin-bottom: 25px;
}
.form-group > label{
	display: block;
	font-size: 18px;	
	color: #000;
}
.custom-control-label{
	color: #000;
	font-size: 16px;
}
.form-control{
	height: 50px;
	background: #ecf0f4;
	border-color: transparent;
	padding: 0 15px;
	font-size: 16px;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}
.form-control:focus{
	border-color: #00bcd9;
	-webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	-moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
	box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}
textarea.form-control{
	height: 160px;
	padding-top: 15px;
	resize: none;
}

.page-header {
    background: linear-gradient(rgba(43, 57, 64, .5), rgba(43, 57, 64, .5)), url({{ asset('lowongan_pekerjaan/'.$pekerjaan->gambar) }}) center center no-repeat;
    background-size: cover;
}
        
    </style>
@endpush

@section('content')

<!-- Category Start -->
<!-- Header End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Lamar Pekerjaan: {{ $pekerjaan->nama }}</h1>
        
    </div>
</div>
<!-- Header End -->


<div class="container">
	<header class="header">
		<h1 id="title" class="text-center">Form Lamar Pekerjaan</h1>
		<p id="description" class="text-center">
			Silahkan mengisi form di bawah ini untuk melamar pekerjaan
		</p>
	</header>
	<div class="form-wrap">	
		<form id="survey-form" method="post" enctype="multipart/form-data" action="{{ route('home.kirimLamaran') }}">
            @csrf
            <input type="hidden" name="id_lamaran_pekerjaan" value="{{ $pekerjaan->id }}">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label id="name" for="name">Nama Lengkap</label>
						<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="email" for="email">Alamat Email</label>
						<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
					</div>
				</div>
			</div>

            <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label id="domisili" for="name">Alamat Domisili</label>
						<input type="text" name="domisili" id="domisili" class="form-control @error('domisili') is-invalid @enderror" value="{{ old('domisili') }}">

                        @error('domisili')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="umur" for="email">Umur</label>
						<input type="number" name="umur" id="umur" class="form-control @error('umur') is-invalid @enderror" value="{{ old('umur') }}">

                        @error('umur')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
					</div>
				</div>
			</div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cv" id="cv">Upload CV Terbaru</label>
                        <input type="file" name="cv" id="cv" class="form-control @error('cv') is-invalid @enderror" aria-describedby="cvHelp">
                        <div id="cvHelp" class="form-text">Hanya bisa upload file pdf dengan ukuran maksimal 2MB.</div>

                        @error('cv')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
			
			<div class="row">
				<div class="col-md-4">
					<button type="submit" id="submit" class="btn btn-primary btn-block">Kirim Lamaran</button>
				</div>
			</div>

		</form>
	</div>	
</div>

@endsection