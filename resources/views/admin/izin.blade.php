@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
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
                        Izin Peserta
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
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
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
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
                                <th>role</th>
                                <th>Jenis Izin</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Validasi</th>
                                <th class="w-8"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($izin as $item)
                                @if ($item->tendik_id == null)
                                    <tr>
                                        <td>
                                            <div>{{ $item->siswa->nama }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->siswa->role }} <span
                                                    class="text-muted">({{ $item->siswa->kelas }})</span></div>
                                        </td>
                                        <td>
                                            @if ($item->jenis_izin === 'Izin')
                                                <span class="badge bg-azure text-azure-fg">Izin</span>
                                            @elseif ($item->jenis_izin === 'Sakit')
                                                <span class="badge bg-orange text-orange-fg">Sakit</span>
                                            @elseif ($item->jenis_izin === 'Alpa')
                                                <span class="badge bg-red text-red-fg">Alpa</span>
                                            @elseif ($item->jenis_izin === 'Lembur')
                                                <span class="badge bg-blue text-blue-fg">Lembur</span>
                                            @else
                                                <span class="badge bg-indigo text-indigo-fg">Perjalanan Dinas</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-y') }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->keterangan }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <img src="{{ asset('img/foto/' . $item->foto) }}"
                                                    class="avatar avatar-lg img-fluid rounded" alt=""
                                                    srcset="" style="object-fit:cover;">
                                            </div>
                                        </td>
                                        <td class="mx-auto">
                                            <input class="form-check-input" type="checkbox"
                                                id="checkbox-{{ $item->id }}">
                                        </td>
                                        <td class="text-end">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <button href="#" class="btn btn-success btn-icon"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-update-{{ $item->id }}">
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
                                                    </button>
                                                </div>
                                                <div class="col">
                                                    <button href="#" class="btn btn-danger btn-icon"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete-{{ $item->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
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
                                @else
                                    <tr>
                                        <td>
                                            <div>{{ $item->tendik->nama }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->tendik->role }}</div>
                                        </td>
                                        <td>
                                            @if ($item->jenis_izin === 'Izin')
                                                <span class="badge bg-azure text-azure-fg">Izin</span>
                                            @elseif ($item->jenis_izin === 'Sakit')
                                                <span class="badge bg-orange text-orange-fg">Sakit</span>
                                            @elseif ($item->jenis_izin === 'Alpa')
                                                <span class="badge bg-red text-red-fg">Alpa</span>
                                            @elseif ($item->jenis_izin === 'Lembur')
                                                <span class="badge bg-blue text-blue-fg">Lembur</span>
                                            @else
                                                <span class="badge bg-indigo text-indigo-fg">Perjalanan Dinas</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-y') }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->keterangan }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <img src="{{ asset('img/foto/' . $item->foto) }}"
                                                    class="avatar avatar-lg img-fluid rounded" alt=""
                                                    srcset="" style="object-fit:cover;">
                                            </div>
                                        </td>
                                        <td class="mx-auto">
                                            <input class="form-check-input" type="checkbox"
                                                id="checkbox-{{ $item->id }}">
                                        </td>
                                        <td class="text-end">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <button href="#" class="btn btn-success btn-icon"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-update-{{ $item->id }}">
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
                                                    </button>
                                                </div>
                                                <div class="col">
                                                    <button href="#" class="btn btn-danger btn-icon"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete-{{ $item->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
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
                                @endif
                                {{-- Form Delete --}}
                                <div class="modal modal-blur fade" id="modal-delete-{{ $item->id }}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <form action="{{ route('izin.delete', $item->id) }}" method="POST">
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
                                                            <div class="col"><a href="#" class="btn w-100"
                                                                    data-bs-dismiss="modal">
                                                                    TIDAK
                                                                </a></div>
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
                                    <td colspan="8" class="text-center pt-4">
                                        <p>Tidak Ada Data</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-secondary">
                        Showing {{ $izin->firstItem() }}
                        to {{ $izin->lastItem() }}
                        of {{ $izin->total() }}
                        entries
                    </p>
                    <ul class="pagination m-0 ms-auto">
                        {{ $izin->links() }}
                    </ul>
                </div>
            </div>
        </div>

    </div>

    {{-- Form Create --}}
    <div class="modal modal-blur fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('izin.perform') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label required">Nama</label>
                        <div class="mb-3">
                            <select class="form-select" name="nama">
                                <optgroup label="Tendik">
                                    @foreach ($tendik as $itemT)
                                        <option value="{{ $itemT->nik }}">{{ $itemT->nama }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Siswa">
                                    @foreach ($siswa as $itemS)
                                        <option value="{{ $itemS->nisn }}">{{ $itemS->nama }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('nama')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <label class="form-label required">Jenis Izin</label>
                        <div class="mb-3">
                            <select class="form-select" name="jenis_izin">
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Alpa">Alpa</option>
                                <option value="Lembur">Lembur</option>
                                <option value="Perjalanan Dinas">Perjalanan Dinas</option>
                            </select>
                            @error('jenis_izin')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <div class="input-icon" autocomplete="off">
                                <input class="form-control" placeholder="" id="datepicker-icon" name="tanggal"
                                    autocomplete="off" value="{{ old('tanggal') }}">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
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
                            @error('tanggal')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jam Mulai</label>
                                        <input type="dateTime" name="jam_mulai" class="form-control" data-mask="00:00"
                                            data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                            fdprocessedid="ms68ld" value="00:00">
                                        @error('jam_mulai')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Jam Berakhir</label>
                                    <input type="text" name="jam_berakhir" class="form-control" data-mask="00:00"
                                        data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                        fdprocessedid="ms68ld" value="00:00">
                                    @error('jam_berakhir')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <label class="form-label required">Keterangan</label>
                        <div class="mb-3">
                            <textarea rows="5" class="form-control" name="keterangan"></textarea>
                            @error('keterangan')
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
    </div>

    {{-- Form Edit --}}
    @foreach ($izin as $item)
        <div class="modal modal-blur fade" id="modal-update-{{ $item->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <form action="{{ route('izin.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label required">Nama</label>
                            <div class="mb-3">
                                <select class="form-select" name="nama"
                                    value="@if ($item->tendik_id == null) {{ $item->siswa->nisn }} @else {{ $item->tendik->nik }} @endif">
                                    <option
                                        value="@if ($item->tendik_id == null) {{ $item->siswa->nisn }} @else {{ $item->tendik->nik }} @endif"
                                        selected>
                                        @if ($item->tendik_id == null)
                                            {{ $item->siswa->nama }}
                                        @else
                                            {{ $item->tendik->nama }}
                                        @endif
                                    </option>
                                    <optgroup label="Tendik">
                                        @foreach ($tendik as $itemT)
                                            <option value="{{ $itemT->nik }}">
                                                {{ $itemT->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Siswa">
                                        @foreach ($siswa as $itemS)
                                            <option value="{{ $itemS->nisn }}">
                                                {{ $itemS->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('nama')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <label class="form-label required">Jenis Izin</label>
                            <div class="mb-3">
                                <select class="form-select" name="jenis_izin" id="jenis_izin_{{ $item->id }}">
                                    <option value="Izin" @if ($item->jenis_izin == 'Izin') selected @endif>Izin
                                    </option>
                                    <option value="Sakit" @if ($item->jenis_izin == 'Sakit') selected @endif>Sakit
                                    </option>
                                    <option value="Alpa" @if ($item->jenis_izin == 'Alpa') selected @endif>Alpa
                                    </option>
                                    <option value="Lembur" @if ($item->jenis_izin == 'Lembur') selected @endif>Lembur
                                    </option>
                                    <option value="Perjalanan Dinas" @if ($item->jenis_izin == 'Perjalanan Dinas') selected @endif>
                                        Perjalanan Dinas
                                    </option>
                                </select>
                                @error('jenis_izin')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <div class="input-icon" autocomplete="off">
                                    <input class="form-control" placeholder="" id="datepicker-icon" name="tanggal"
                                        value="{{ $item->tanggal }}">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                @error('tanggal')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6" id="jam_mulai_{{ $item->id }}">
                                        <div class="mb-3">
                                            <label class="form-label">Jam Mulai</label>
                                            <input type="dateTime" name="jam_mulai" class="form-control"
                                                data-mask="00:00" data-mask-visible="true" placeholder="00:00"
                                                autocomplete="off" fdprocessedid="ms68ld"
                                                value="{{ $item->jam_mulai }}">
                                            @error('jam_mulai')
                                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id="jam_berakhir_{{ $item->id }}">
                                        <label class="form-label">Jam Berakhir</label>
                                        <input type="text" name="jam_berakhir" class="form-control" data-mask="00:00"
                                            data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                            fdprocessedid="ms68ld" value="{{ $item->jam_berakhir }}">
                                        @error('jam_berakhir')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <label class="form-label required">Keterangan</label>
                            <div class="mb-3">
                                <textarea rows="5" class="form-control" name="keterangan">{{ $item->keterangan }}</textarea>
                                @error('keterangan')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-label">Foto</div>
                            <input accept="image/*" type="file" class="form-control" name="foto"
                                onchange="previewImage()">
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
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                    </path>
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

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jenisIzinInput = document.querySelector('select[name="jenis_izin"]');
            const jamMulaiInput = document.querySelector('input[name="jam_mulai"]').closest('.col-lg-6');
            const jamBerakhirInput = document.querySelector('input[name="jam_berakhir"]').closest('.col-lg-6');

            function toggleJamInputs() {
                const jenisIzinValue = jenisIzinInput.value;
                if (jenisIzinValue === 'Lembur' || jenisIzinValue === 'Perjalanan Dinas') {
                    jamMulaiInput.style.display = 'block';
                    jamBerakhirInput.style.display = 'block';
                } else {
                    jamMulaiInput.style.display = 'none';
                    jamBerakhirInput.style.display = 'none';
                }
            }

            toggleJamInputs();

            jenisIzinInput.addEventListener('change', function() {
                toggleJamInputs();
            });
        });
    </script>
    @foreach ($izin as $item)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const jenisIzinInput_{{ $item->id }} = document.getElementById(
                    'jenis_izin_' + {{ $item->id }});
                const jamMulaiInput_{{ $item->id }} = document.getElementById(
                    'jam_mulai_' + {{ $item->id }});
                const jamBerakhirInput_{{ $item->id }} = document.getElementById(
                    'jam_berakhir_' + {{ $item->id }});

                function toggleJamInputs_{{ $item->id }}() {
                    const jenisIzinValue_{{ $item->id }} = jenisIzinInput_{{ $item->id }}.value;
                    if (jenisIzinValue_{{ $item->id }} === 'Lembur' || jenisIzinValue_{{ $item->id }} ===
                        'Perjalanan Dinas') {
                        jamMulaiInput_{{ $item->id }}.style.display = 'block';
                        jamBerakhirInput_{{ $item->id }}.style.display = 'block';
                    } else {
                        jamMulaiInput_{{ $item->id }}.style.display = 'none';
                        jamBerakhirInput_{{ $item->id }}.style.display = 'none';
                    }
                }

                toggleJamInputs_{{ $item->id }}();

                jenisIzinInput_{{ $item->id }}.addEventListener('change', function() {
                    toggleJamInputs_{{ $item->id }}();
                });
            });
        </script>
    @endforeach
    {{-- Place this at the end of your HTML body or use DOMContentLoaded event --}}
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const checkboxes = document.querySelectorAll('.form-check-input');

            checkboxes.forEach(checkbox => {
                // Set the checkbox state from localStorage
                const checkboxId = checkbox.id;
                const savedState = localStorage.getItem(checkboxId);
                if (savedState === 'true') {
                    checkbox.checked = true;
                } else if (savedState === 'false') {
                    checkbox.checked = false;
                }

                // Add event listener to save state on change
                checkbox.addEventListener('change', () => {
                    localStorage.setItem(checkboxId, checkbox.checked);
                });
            });
        });
    </script>
@endsection
