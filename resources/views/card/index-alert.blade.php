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
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Card ID</th>
                                <th>Jenis Kelamin</th>
                                <th>NISN</th>
                                <th>Tempat/Tanggal Lahir</th>
                                <th>Whatsapp</th>
                                <th>Role</th>
                                <th class="w-8"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
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
                                        <div>{{ $item->card_id }}</div>
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
                                        {{ $item->status }}
                                    </td>
                                    <td class="text-end">

                                        <div class="row g-0">
                                            <div class="col">
                                                <button class="btn btn-success btn-icon">
                                                    <a href="{{ route('card.alert.add', $item->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                            <path d="M16 5l3 3" />
                                                        </svg>
                                                    </a>
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
                            {{-- @include('components.formSiswa') --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
