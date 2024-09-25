@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        @if (session('success'))
            <div class="alert alert-important alert-success alert-dismissible mt-3" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>
                        {{ session('create') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        @if (session('create'))
            <div class="alert alert-important alert-success alert-dismissible mt-3" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>
                        {{ session('create') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        @if (session('update'))
            <div class="alert alert-important alert-info alert-dismissible mt-3" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>
                        {{ session('update') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-important alert-danger alert-dismissible mt-3" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>
                        {{ session('delete') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        <div class="page-header d-print-none mb-3">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Data
                    </div>
                    <h2 class="page-title">
                        Tenaga Pendidik
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
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>NIK</th>
                                <th>Tempat/Tanggal Lahir</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Whatsapp</th>
                                <th>Role</th>
                                <th class="w-8"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tendik as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <img src="{{ asset('img/foto/' . $item->foto) }}"
                                                class="avatar me-2 img-fluid" alt="" srcset=""
                                                style="object-fit:cover;">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $item->nama }}</div>
                                                <div class="text-secondary"><a href="#"
                                                        class="text-reset">mail@gmail.com</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>{{ $item->jenis_kelamin }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $item->nik }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}</div>
                                    </td>
                                    <td>
                                        <div>{{ \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') }}</div>
                                    </td>
                                    <td>
                                        <div>{{ \Carbon\Carbon::parse($item->jam_pulang)->format('H:i') }}</div>
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
                                {{-- Form Delete --}}
                                <div class="modal modal-blur fade" id="modal-delete-{{ $item->id }}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <form action="{{ route('tendik.delete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="modal-status bg-danger"></div>
                                                <div class="modal-body text-center py-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon mb-2 text-danger icon-lg" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 9v4"></path>
                                                        <path
                                                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                                                        </path>
                                                        <path d="M12 16h.01"></path>
                                                    </svg>
                                                    <h3>Apakah Anda Yakin?</h3>
                                                    <div class="text-secondary">Apakah Anda benar-benar ingin menghapus
                                                        data ini? Apa yang telah Anda
                                                        lakukan tidak dapat dibatalkan.</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="w-100">
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href="#" class="btn w-100"
                                                                    data-bs-dismiss="modal">
                                                                    TIDAK
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                <button class="btn btn-danger w-100"
                                                                    data-bs-dismiss="modal" type="submit">
                                                                    YA
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center pt-4">
                                        <p>Tidak Ada Data</p>
                                    </td>
                                </tr>
                            @endforelse
                            {{-- modal IMPORT EXCELL --}}
                            <div class="modal modal-blur fade" id="modal-import" tabindex="-1" aria-modal="false"
                                role="dialog">
                                <form action="{{ route('tendik.import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <div class="modal-status bg-blue"></div>
                                            <div class="modal-body py-4">
                                                <div class="text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        class="icon icon-lg text-blue my-3" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-file-import">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                        <path
                                                            d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" />
                                                    </svg>
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label">Import From Excel</label>
                                                    <input type="file" class="form-control" name="excel_file"
                                                        value="{{ old('excel_file') }}">
                                                    @error('excel_file')
                                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">

                                                <button type="button" class="btn me-auto"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button href="#" type="submit" class="btn btn-primary ms-auto"
                                                    data-bs-dismiss="modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 5l0 14"></path>
                                                        <path d="M5 12l14 0"></path>
                                                    </svg>
                                                    Import
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-secondary">
                        Showing {{ $tendik->firstItem() }}
                        to {{ $tendik->lastItem() }}
                        of {{ $tendik->total() }}
                        entries
                    </p>
                    <ul class="pagination m-0 ms-auto">
                        {{ $tendik->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Create  {{ session('create_errors') ? 'show' : '' }}  style="{{ session('create_errors') ? 'display: block;' : 'display: none;' }}" --}}
    {{-- <div class="modal modal-blur fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('tendik.perform') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ old('nama') }}">
                                    @error('nama')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                class="form-control" name="nik" value="{{ old('nik') }}">
                            @error('nik')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir"
                                            value="{{ old('tempat_lahir') }}">
                                        @error('tempat_lahir')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <div class="input-icon">
                                        <input class="form-control" placeholder="" id="datepicker-icon"
                                            name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                                </path>
                                                <path d="M16 3v4"></path>
                                                <path d="M8 3v4"></path>
                                                <path d="M4 11h16"></path>
                                                <path d="M11 15h1"></path>
                                                <path d="M12 15v3"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    @error('tanggal_lahir')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <label class="form-label">Role</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="role" value="Tendik" class="form-selectgroup-input"
                                    checked>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Tendik</span>
                                    </span>
                                </span>
                            </label>
                            @error('role')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jam Masuk</label>
                                        <input type="text" name="jam_masuk" class="form-control" data-mask="00:00"
                                            data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                            fdprocessedid="ms68ld" value="{{ old('jam_masuk') }}">
                                        @error('jam_masuk')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Jam Pulang</label>
                                    <input type="text" name="jam_pulang" class="form-control" data-mask="00:00"
                                        data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                        fdprocessedid="ms68ld" value="{{ old('jam_pulang') }}">
                                    @error('jam_pulang')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Whastapp</label>
                            <input type="number" class="form-control" name="nomor_whatsapp"
                                value="{{ old('nomor_whatsapp') }}">
                            @error('nomor_whatsapp')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-label">Foto</div>
                        <input accept="image/*" type="file" class="form-control" name="foto"
                            onchange="previewImage()" value="{{ old('foto') }}">
                        @error('foto')
                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button href="#" type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div> --}}

    {{-- Form Create --}}
    <div class="modal modal-blur fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('tendik.perform') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ old('nama') }}">
                                    @error('nama')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="Laki-Laki"
                                            {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="form-control" name="nik" value="{{ old('nik') }}">
                            @error('nik')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        value="{{ old('tempat_lahir') }}">
                                    @error('tempat_lahir')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <div class="input-icon">
                                        <input class="form-control" placeholder="Tanggal Lahir" id="datepicker-icon"
                                            name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                                </path>
                                                <path d="M16 3v4"></path>
                                                <path d="M8 3v4"></path>
                                                <path d="M4 11h16"></path>
                                                <path d="M11 15h1"></path>
                                                <path d="M12 15v3"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    @error('tanggal_lahir')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <label class="form-label">Role</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="role" value="Tendik" class="form-selectgroup-input"
                                    {{ old('role') == 'Tendik' ? 'checked' : '' }}>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Tendik</span>
                                    </span>
                                </span>
                            </label>
                            @error('role')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Masuk</label>
                                    <input type="text" name="jam_masuk" class="form-control" data-mask="00:00"
                                        data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                        value="{{ old('jam_masuk') }}">
                                    @error('jam_masuk')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Pulang</label>
                                    <input type="text" name="jam_pulang" class="form-control" data-mask="00:00"
                                        data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                        value="{{ old('jam_pulang') }}">
                                    @error('jam_pulang')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Whatsapp</label>
                            <input type="number" class="form-control" name="nomor_whatsapp"
                                value="{{ old('nomor_whatsapp') }}">
                            @error('nomor_whatsapp')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-label">Foto</div>
                        <input accept="image/*" type="file" class="form-control" name="foto"
                            onchange="previewImage()" value="{{ old('foto') }}">
                        @error('foto')
                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Form Edit --}}
    @foreach ($tendik as $item)
        <div class="modal modal-blur fade" id="modal-update-{{ $item->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <form action="{{ route('tendik.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ $item->nama }}">
                                        @error('nama')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="jenis_kelamin">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                    class="form-control" name="nik" value="{{ $item->nik }}">
                                @error('nik')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir"
                                                value="{{ $item->tempat_lahir }}">
                                            @error('tempat_lahir')
                                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="input-icon mb-3">
                                            <input class="form-control" placeholder="" id="datepicker-icon"
                                                name="tanggal_lahir" value="{{ $item->tanggal_lahir }}">
                                            <span class="input-icon-addon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                                    </path>
                                                    <path d="M16 3v4"></path>
                                                    <path d="M8 3v4"></path>
                                                    <path d="M4 11h16"></path>
                                                    <path d="M11 15h1"></path>
                                                    <path d="M12 15v3"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        @error('tanggal_lahir')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <label class="form-label">Role</label>
                            <div class="form-selectgroup-boxes row mb-3">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="role" value="Tendik" class="form-selectgroup-input"
                                        checked>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Tendik</span>
                                        </span>
                                    </span>
                                </label>
                                @error('role')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jam Masuk</label>
                                            <input type="text" name="jam_masuk" class="form-control"
                                                data-mask="00:00" data-mask-visible="true" placeholder="00:00"
                                                autocomplete="off" fdprocessedid="ms68ld"
                                                value="{{ $item->jam_masuk }}">
                                            @error('jam_masuk')
                                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Jam Pulang</label>
                                        <input type="text" name="jam_pulang" class="form-control" data-mask="00:00"
                                            data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                            fdprocessedid="ms68ld" value="{{ $item->jam_pulang }}">
                                        @error('jam_pulang')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Whastapp</label>
                                <input type="number" class="form-control" name="nomor_whatsapp"
                                    value="{{ $item->nomor_whatsapp }}">
                                @error('nomor_whatsapp')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-label">Foto</div>
                            <input accept="image/*" type="file" class="form-control" name="foto"
                                onchange="previewImage()" value="{{ $item->foto }}">
                            @error('foto')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                Cancel
                            </a>
                            <button href="#" type="submit" class="btn btn-primary ms-auto"
                                data-bs-dismiss="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
@endsection
