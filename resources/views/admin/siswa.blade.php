@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        @include('components.alerts')
        <div class="page-header d-print-none mb-3">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Data
                    </div>
                    <h2 class="page-title">
                        Siswa
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-import">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-import">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" />
                            </svg>
                            Import Excel
                        </a>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-create">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Tambah Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header d-block">
                    <form action="{{ route('siswa.filter') }}" class="row align-items-center" method="GET">
                        @csrf
                        <div class="col-8">
                            <input class="form-control" name="cari" type="text" placeholder="Cari..."
                                autocomplete="off"
                                @if (strpos(url()->current(), 'cari') == true) value="{{ $cari }}" autofocus @endif>
                        </div>
                        <div class="col-2">
                            <select class="form-select" name="kelas">
                                <option value="Semua" @if (strpos(url()->current(), 'cari') == true && $kelas == 'semua') selected @endif>Semua Kelas
                                </option>
                                <option value="Kelas 10" @if (strpos(url()->current(), 'cari') == true && $kelas == 'Kelas 10') selected @endif>Kelas 10</option>
                                <option value="Kelas 11" @if (strpos(url()->current(), 'cari') == true && $kelas == 'Kelas 11') selected @endif>Kelas 11</option>
                                <option value="Kelas 12" @if (strpos(url()->current(), 'cari') == true && $kelas == 'Kelas 12') selected @endif>Kelas 12</option>
                            </select>
                            @error('kelas')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col">
                            <button class="btn btn-primary w-100" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-filter">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
                                </svg>
                                filter
                            </button>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>NISN</th>
                                <th>Tempat/Tanggal Lahir</th>
                                <th>Whatsapp</th>
                                <th>Role</th>
                                <th class="w-8"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <img src="{{ $item->foto ? asset('img/foto/' . $item->foto) : asset('img/bahan/1.png') }}"
                                                class="avatar me-2" alt="" srcset="">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $item->nama }}</div>
                                                <div class="text-secondary"><a href="#"
                                                        class="text-reset">mail@gmail.com</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>{{ $item->kelas }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $item->jenis_kelamin }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $item->nisn }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $item->nomor_whatsapp }}</div>
                                    </td>
                                    <td class="text-secondary">
                                        {{ $item->role }}
                                    </td>
                                    <td class="text-end">
                                        <div class="row g-0">
                                            <div class="col">
                                                <button href="#" class="btn btn-success btn-icon"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-update-{{ $item->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="col">
                                                <button href="#" class="btn btn-danger btn-icon"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-delete-{{ $item->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center pt-4">
                                        <p>Tidak Ada Data</p>
                                    </td>
                                </tr>
                            @endforelse
                            @include('components.formSiswa')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-secondary">
                        Showing {{ $siswa->firstItem() }}
                        to {{ $siswa->lastItem() }}
                        of {{ $siswa->total() }}
                        entries
                    </p>
                    <ul class="pagination m-0 ms-auto">
                        {{ $siswa->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
