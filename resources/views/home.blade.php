@extends('layouts.app')
@section('styles')
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.17);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .radius {
            border-radius: 16px;
        }

        .bg-gradient-orange {
            background: rgb(255, 114, 0);
            background: linear-gradient(335deg, rgba(255, 114, 0, 1) 0%, rgba(255, 172, 4, 1) 90%, rgba(252, 179, 88, 1) 100%);
        }

        .bg-transparent {
            background-color: transparent !important;
        }

        .clickable-row {
            cursor: pointer;
        }

        .clickable-row:hover {
            background-color: #f5f5f5;
            color: #182433;
            /* Ubah warna saat dihover sesuai tema */
        }
    </style>
@endsection
@section('content')
    @php
        date_default_timezone_set('Asia/jakarta');
    @endphp
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card rounded-4 mt-4 mb-3">
                        <div class="card-body">
                            <div class="page-header d-print-none mt-0">
                                <div class="row g-2 align-items-center">
                                    <div class="col">
                                        <div class="page-pretitle">
                                            Sistem Absensi Sekolah
                                        </div>
                                        <h2 class="page-title">
                                            SMK TI Bazma
                                        </h2>
                                    </div>
                                    <div class="col-auto ms-auto d-print-none" style="text-align: end">
                                        <h2 class="page-title">
                                            <div id="jam"></div>
                                        </h2>
                                        <p class="mb-0 page-pretitle" style="font-size: 12px;">
                                            {{ $time = now()->isoFormat('dddd, D MMMM Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('components.alerts')
                    {{-- HOME --}}
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="row gy-2 align-items-center mb-3" data-masonry='{"percentPosition": true }'>
                                <div class="col-6">
                                    <div class="card bg-twitter rounded-4 p-2">
                                        <div class="card glass radius" style="min-height: 230px">
                                            <div class="card-header bg-transparent">
                                                <ul class="nav nav-tabs card-header-tabs nav-fill bg-transparent text-white glass"
                                                    style="border-top-left-radius: 13px; border-top-right-radius: 13px;"
                                                    data-bs-toggle="tabs" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a href="#tabs-ontime" class="nav-link page-pretitle active"
                                                            data-bs-toggle="tab" aria-selected="false" role="tab"
                                                            tabindex="-1">Tepat Waktu</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a href="#tabs-terlambat" class="nav-link page-pretitle"
                                                            data-bs-toggle="tab" aria-selected="false" role="tab"
                                                            tabindex="-1">Terlambat</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body py-5">
                                                <div class="tab-content">
                                                    <div class="tab-pane active show" id="tabs-ontime" role="tabpanel">
                                                        <div class="row row-cols-lg-2 align-items-center">
                                                            <img src="{{ asset('img/bahan/ontime.png') }}"
                                                                style="width: 85px;" class="img-fluid mx-3" alt="">
                                                            <div class="p-2 text-white ms-auto">
                                                                <strong>Tepat Waktu</strong>
                                                                <p style="font-size: 40px; font-weight:600" class="mb-0">
                                                                    {{ $totalOntime }}<span
                                                                        class="page-pretitle text-white">
                                                                        siswa</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tabs-terlambat" role="tabpanel">
                                                        <div class="row row-cols-lg-2 align-items-center">
                                                            <img src="{{ asset('img/bahan/terlambat.png') }}"
                                                                style="width: 85px;" class="img-fluid mx-3" alt="">
                                                            <div class="p-2 text-white ms-auto">
                                                                <strong>Terlambat</strong>
                                                                <p style="font-size: 40px; font-weight:600" class="mb-0">
                                                                    {{ $totalTerlambat }}<span
                                                                        class="page-pretitle text-white">
                                                                        siswa</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card bg-orange rounded-4 p-2">
                                        <div class="card glass radius" style="min-height: 230px">
                                            <div class="card-header glass pb-2"
                                                style="border-top-left-radius: 13px; border-top-right-radius: 13px;">
                                                <div class="h3 m-0 text-white">Siswa Sakit</div>
                                            </div>
                                            <div class="card-body py-5">
                                                <div class="row row-cols-lg-2 align-items-center">
                                                    <img src="{{ asset('img/bahan/sakit.png') }}" style="width: 85px;"
                                                        class="img-fluid mx-3" alt="">
                                                    <div class="p-2 text-white ms-auto">
                                                        <p style="font-size: 40px; font-weight:600" class="mb-0">
                                                            {{ $totalSakit }}<span class="page-pretitle text-white">
                                                                siswa</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card bg-azure rounded-4 p-2">
                                        <div class="card glass radius" style="min-height: 230px">
                                            <div class="card-header glass pb-2"
                                                style="border-top-left-radius: 13px; border-top-right-radius: 13px;">
                                                <div class="h3 m-0 text-white">Siswa Izin</div>
                                            </div>
                                            <div class="card-body py-5">
                                                <div class="row row-cols-lg-2 align-items-center">
                                                    <img src="{{ asset('img/bahan/izin.png') }}" style="width: 85px;"
                                                        class="img-fluid mx-3" alt="">
                                                    <div class="p-2 text-white ms-auto">
                                                        <p style="font-size: 40px; font-weight:600" class="mb-0">
                                                            {{ $totalIzin }}<span class="page-pretitle text-white">
                                                                siswa</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card bg-red rounded-4 p-2">
                                        <div class="card glass radius" style="min-height: 230px">
                                            <div class="card-header glass pb-2"
                                                style="border-top-left-radius: 13px; border-top-right-radius: 13px;">
                                                <div class="h3 m-0 text-white">Siswa Alpa</div>
                                            </div>
                                            <div class="card-body py-5">
                                                <div class="row row-cols-lg-2 align-items-center">
                                                    <img src="{{ asset('img/bahan/alpa.png') }}" style="width: 85px;"
                                                        class="img-fluid mx-3" alt="">
                                                    <div class="p-2 text-white ms-auto">
                                                        <p style="font-size: 40px; font-weight:600" class="mb-0">
                                                            {{ $totalAlpa }}<span class="page-pretitle text-white">
                                                                siswa</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card rounded-3  ">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs nav-fill"
                                        style="border-top-left-radius: 13px;border-top-right-radius:13px;"
                                        data-bs-toggle="tabs">
                                        <li class="nav-item">
                                            <a href="#tabs-masuk-form"
                                                class="nav-link {{ session('error') ? '' : 'active' }}"
                                                data-bs-toggle="tab">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-login-2">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                                    <path d="M3 12h13l-3 -3" />
                                                    <path d="M13 15l3 -3" />
                                                </svg>
                                                <span class="ms-1"></span>Masuk
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#tabs-pulang-form"
                                                class="nav-link {{ session('error') ? 'active' : '' }}"
                                                data-bs-toggle="tab">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                                    <path d="M15 12h-12l3 -3" />
                                                    <path d="M6 15l-3 -3" />
                                                </svg>
                                                <span class="ms-1"></span>Pulang
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane {{ session('error') ? '' : 'active show' }}"
                                            id="tabs-masuk-form">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <img src="{{ asset('img/gif/6.gif') }}" alt=""
                                                        style="max-height: 250px;">
                                                </div>
                                            </div>
                                            <form action="{{ route('home.masuk') }}" method="POST">
                                                @csrf
                                                <div class="py-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nomor Induk</label>
                                                        <input autocomplete="off" type="text"
                                                            class="form-control rounded-4" name="noid"
                                                            placeholder="Masukan NISN/NUPTK"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                                            value="{{ old('noid') }}" />
                                                    </div>
                                                    @if ($errors->any())
                                                        <div class="text-danger mb-3">
                                                            {{ $errors->first() }}
                                                        </div>
                                                    @endif
                                                    @if (session('message'))
                                                        <div class="text-danger mb-3" role="alert">
                                                            {{ session('message') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <button type="submit" id="masukButton"
                                                    class="btn btn-primary rounded-4 w-100">Masuk</button>
                                            </form>

                                        </div>
                                        <div class="tab-pane {{ session('error') ? 'active show' : '' }}"
                                            id="tabs-pulang-form">
                                            <div class="align-items-center">
                                                <div class="text-center">
                                                    <img src="{{ asset('img/gif/pulang-2.gif') }}" alt=""
                                                        style="max-height: 250px;">
                                                </div>
                                            </div>
                                            <form action="{{ route('home.pulang') }}" method="POST">
                                                @csrf
                                                <div class="py-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nomor Induk</label>
                                                        <input autocomplete="off" type="text"
                                                            class="form-control rounded-4" name="noid"
                                                            placeholder="Masukan NISN/NUPTK"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                                            value="{{ old('noid') }}" />
                                                    </div>
                                                    @if (session('error'))
                                                        <div class="text-danger mb-3">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->any())
                                                        <div class="text-danger mb-3">
                                                            {{ $errors->first() }}
                                                        </div>
                                                    @endif
                                                    @if (session('message'))
                                                        <div class="text-danger mb-3" role="alert">
                                                            {{ session('message') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <button type="submit" id="pulangButton"
                                                    class="btn btn-primary rounded-4 w-100">Pulang</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 mt-4">
                    <div class="card rounded-4 p-2 mb-3">
                        <div class="row gx-2">
                            <div class="col-4">
                                <div class="card rounded-3 border border-primary">
                                    <div class="card-body p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-blue text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="page-pretitle">Total Siswa</div>
                                                <div class="page-title">{{ $siswaCount }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card rounded-3 border border-orange">
                                    <div class="card-body p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-orange text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-school">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                                                        <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="page-pretitle">Total Tendik</div>
                                                <div class="page-title">{{ $tendikCount }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card rounded-3 border border-purple">
                                    <div class="card-body p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-purple text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-door">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M14 12v.01" />
                                                        <path d="M3 21h18" />
                                                        <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="page-pretitle">Total Kelas</div>
                                                <div class="page-title">2 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-4 mb-3">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs nav-fill"
                                style="border-top-left-radius: 13px;border-top-right-radius:13px;" data-bs-toggle="tabs"
                                role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-jam-siswa" class="nav-link active" data-bs-toggle="tab"
                                        aria-selected="true" role="tab">Jam Siswa</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-jam-guru" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                        role="tab" tabindex="-1">Jam Guru</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-jam-siswa" role="tabpanel">
                                    <div class="row mb-3 gx-2">
                                        <div class="col-6">
                                            <div class="card rounded-4 p-2">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="page-pretitle">Jam Masuk</div>
                                                            <div class="page-title">
                                                                {{ $waktu->jam_masuk ? date('H : i', strtotime($waktu->jam_masuk)) : null }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <span class="bg-twitter text-white avatar">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clock-hour-7">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                                    <path d="M12 12l-2 3" />
                                                                    <path d="M12 7v5" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card rounded-4 p-2">
                                                <div class="p-2">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="page-pretitle">Jam Pulang</div>
                                                            <div class="page-title">
                                                                {{ $waktu->jam_pulang ? date('H : i', strtotime($waktu->jam_pulang)) : '' }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <span class="bg-twitter text-white avatar">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clock-hour-4">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                                    <path d="M12 12l3 2" />
                                                                    <path d="M12 7v5" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end page-pretitle mb-2 me-2">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-jam">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                            Edit jam Sekolah
                                        </a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-jam-guru" role="tabpanel">
                                    <a href="/tendik" class="btn btn-blue w-100 my-5 rounded-4">Edit Jam Guru</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-4 mb-3" style="min-height: 20rem; max-height:20rem;">
                        <div class="table-responsive rounded-4">
                            <table class="table card-table rounded-4 table-vcenter text-nowrap datatable">
                                <thead class="sticky-top">
                                    <tr>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">No. Induk</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Jam Masuk</th>
                                        <th class="text-center">Jam Pulang</th>
                                    </tr>
                                </thead>
                                <tbody style="min-height: 16.5rem; max-heigth:16.5rem;overflow-y: auto;">
                                    @foreach ($absensi as $itemA)
                                        @if ($itemA->tendik_id == null)
                                            <tr id="offcanvasTrigger-{{ $itemA->id }}" class="clickable-row">
                                                <td class="text-center">
                                                    <a data-bs-toggle="offcanvas"
                                                        class="text-decoration-none text-default"
                                                        href="#offcanvasAbsensi-{{ $itemA->id }}" role="button"
                                                        aria-controls="offcanvasAbsensi-{{ $itemA->id }}">
                                                    </a>
                                                    @if ($itemA->status == 'Terlambat')
                                                        <span class="badge bg-red text-red-fg">{{ $itemA->status }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-green text-green-fg">{{ $itemA->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $itemA->siswa->nisn }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $itemA->siswa->nama }}
                                                </td>
                                                <td class="text-center">{{ $itemA->siswa->kelas }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($itemA->jam_masuk)->format('H : i') ?? null }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $itemA->jam_pulang ? date('H : i', strtotime($itemA->jam_pulang)) : null }}
                                                </td>
                                            </tr>
                                        @elseif ($itemA->siswa_id == null)
                                            <tr id="offcanvasTrigger-{{ $itemA->id }}" class="clickable-row">
                                                <td class="text-center">
                                                    <a data-bs-toggle="offcanvas"
                                                        class="text-decoration-none text-default"
                                                        href="#offcanvasAbsensi-{{ $itemA->id }}" role="button"
                                                        aria-controls="offcanvasAbsensi-{{ $itemA->id }}">
                                                    </a>
                                                    @if ($itemA->status == 'Terlambat')
                                                        <span class="badge bg-red text-red-fg">{{ $itemA->status }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-green text-green-fg">{{ $itemA->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $itemA->tendik->nik }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $itemA->tendik->nama }}
                                                </td>
                                                <td class="text-center">{{ $itemA->tendik->role }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($itemA->jam_masuk)->format('H : i') ?? null }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $itemA->jam_pulang ? date('H : i', strtotime($itemA->jam_pulang)) : null }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card bg-gradient-orange border-0 rounded-4" style="min-height: 188px">
                        <div class="p-2">
                            <div class="card glass radius">
                                <div class="card-header bg-transparent">
                                    <ul class="nav nav-tabs card-header-tabs nav-fill bg-transparent text-white glass"
                                        style="border-top-left-radius: 13px; border-top-right-radius: 13px;"
                                        data-bs-toggle="tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-kelas10" class="nav-link page-pretitle" data-bs-toggle="tab"
                                                aria-selected="false" role="tab" tabindex="-1">Kelas 10</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-kelas11" class="nav-link page-pretitle" data-bs-toggle="tab"
                                                aria-selected="false" role="tab" tabindex="-1">Kelas 11</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-kelas12" class="nav-link page-pretitle" data-bs-toggle="tab"
                                                aria-selected="false" role="tab" tabindex="-1">Kelas 12</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-semuaKelas" class="nav-link page-pretitle active"
                                                data-bs-toggle="tab" aria-selected="true" role="tab">Semua
                                                Kelas</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tabs-kelas10" role="tabpanel">
                                            <div class="row row-cols-lg-2 align-items-center">
                                                <img src="{{ asset('img/bahan/belum.png') }}" style="width: 85px;"
                                                    class="img-fluid mx-3" alt="">
                                                <div class="p-2 text-white ms-auto">
                                                    <strong>Belum Masuk</strong>
                                                    <p style="font-size: 40px; font-weight:600" class="mb-0">
                                                        {{ $belumMasuk10 }}<span class="page-pretitle text-white">
                                                            siswa</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-kelas11" role="tabpanel">
                                            <div class="row row-cols-lg-2 align-items-center">
                                                <img src="{{ asset('img/bahan/belum.png') }}" style="width: 85px;"
                                                    class="img-fluid mx-3" alt="">
                                                <div class="p-2 text-white ms-auto">
                                                    <strong>Belum Masuk</strong>
                                                    <p style="font-size: 40px; font-weight:600" class="mb-0">
                                                        {{ $belumMasuk11 }}<span class="page-pretitle text-white">
                                                            siswa</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-kelas12" role="tabpanel">
                                            <div class="row row-cols-lg-2 align-items-center">
                                                <img src="{{ asset('img/bahan/belum.png') }}" style="width: 85px;"
                                                    class="img-fluid mx-3" alt="">
                                                <div class="p-2 text-white ms-auto">
                                                    <strong>Belum Masuk</strong>
                                                    <p style="font-size: 40px; font-weight:600" class="mb-0">
                                                        {{ $belumMasuk12 }}<span class="page-pretitle text-white">
                                                            siswa</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane active show" id="tabs-semuaKelas" role="tabpanel">
                                            <div class="row row-cols-lg-2 align-items-center">
                                                <img src="{{ asset('img/bahan/belum.png') }}" style="width: 85px;"
                                                    class="img-fluid mx-3" alt="">
                                                <div class="p-2 text-white ms-auto">
                                                    <strong>Belum Masuk</strong>
                                                    <p style="font-size: 40px; font-weight:600" class="mb-0">
                                                        {{ $belumMasuk }}<span class="page-pretitle text-white">
                                                            siswa</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.homeComponents')
@endsection
@section('scripts')
    <script type="text/javascript">
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h + ' : ' + m + ' : ' + s + ' WIB';

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }

        document.addEventListener("DOMContentLoaded", function() {
            var rows = document.querySelectorAll(".clickable-row");
            rows.forEach(function(row) {
                row.addEventListener("click", function() {
                    var offcanvasId = this.querySelector("a[data-bs-toggle='offcanvas']")
                        .getAttribute("href");
                    var offcanvas = new bootstrap.Offcanvas(document.querySelector(offcanvasId));
                    offcanvas.show();
                });
            });
        });
    </script>
    <script src="{{ asset('./dist/js/apexcharts.min.js') }}" defer></script>
    @php
        $jsonDates = json_encode($dates, JSON_PRETTY_PRINT);
    @endphp

    @foreach ($absensi as $item)
        @php
            $siswaId = $item->siswa_id;
            $tendikId = $item->tendik_id;
            $tepatWaktu = [];
            $terlambat = [];

            if (isset($punctualityData[$siswaId])) {
                foreach ($dates as $date) {
                    $tepatWaktu[] = $punctualityData[$siswaId]['ontime'][$date];
                    $terlambat[] = $punctualityData[$siswaId]['late'][$date];
                }
            } elseif (isset($punctualityData[$tendikId])) {
                foreach ($dates as $date) {
                    $tepatWaktu[] = $punctualityData[$tendikId]['ontime'][$date];
                    $terlambat[] = $punctualityData[$tendikId]['late'][$date];
                }
            }

            $jsonTepatWaktu = json_encode($tepatWaktu);
            $jsonTerlambat = json_encode($terlambat);
        @endphp 
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-absensi-{{ $item->id }}'), {
                    chart: {
                        type: "area",
                        fontFamily: 'inherit',
                        height: 330,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: true, // Show the toolbar
                            tools: {
                                zoom: true, // Enable zooming
                                zoomin: true, // Enable zoom-in button
                                zoomout: true, // Enable zoom-out button
                                pan: true, // Enable panning
                                reset: true // Enable reset button
                            },
                        },
                        animations: {
                            enabled: true
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: .16,
                        type: 'solid'
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                        name: "Tepat Waktu",
                        data: {!! $jsonTepatWaktu !!}
                    }, {
                        name: "Terlambat",
                        data: {!! $jsonTerlambat !!}
                    }],
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            padding: 5
                        },
                        max: 100, // Set maximum value of y-axis to 100
                    },
                    labels: {!! $jsonDates !!},
                    colors: [tabler.getColor("success"), tabler.getColor("red")],
                    legend: {
                        show: true,
                        position: 'bottom',
                        offsetY: 12,
                        markers: {
                            width: 10,
                            height: 10,
                            radius: 100,
                        },
                        itemMargin: {
                            horizontal: 8,
                            vertical: 8
                        },
                    },
                })).render();
            });
        </script>
    @endforeach
@endsection
