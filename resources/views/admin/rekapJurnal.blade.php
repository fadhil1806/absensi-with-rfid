@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        @if (strpos(url()->current(), 'filter') == false)
            <div class="page-header d-print-none mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Rekap Data
                        </div>
                        <h2 class="page-title">
                            Jurnal Agenda Kelas
                        </h2>
                    </div>
                </div>
            </div>
            <form action="/filter-jak" id="filter" method="GET">
                <div class="row g-2">
                    <div class="col-4">
                        <div class="input-icon mb-3">
                            <input class="form-control" name="start_date" placeholder="{{ request('start_date') }}"
                                id="datepicker-icon-1" value="" fdprocessedid="m75zlq" autocomplete="off">
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
                    </div>
                    <div class="col-4">
                        <div class="input-icon mb-3">
                            <input class="form-control" name="end_date" placeholder="{{ request('end_date') }}"
                                id="datepicker-icon-2" value="" fdprocessedid="m75zlq" autocomplete="off">
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
                    </div>
                    <div class="col-2">
                        <div class="mb-3">
                            <select class="form-select" name="kelas">
                                <option value="Kelas 10">Kelas 10</option>
                                <option value="Kelas 11">Kelas 11</option>
                                <option value="Kelas 12">Kelas 12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary w-100" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                <path d="M17 18h2" />
                                <path d="M20 15h-3v6" />
                                <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                            </svg>
                            Export PDF
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>
    @if (strpos(url()->current(), 'filter') == true)
        <div style="min-height: 80vh">
            <h1>Data Jurnal Agenda Kelas</h1>
            <p><b>Tanggal : </b>{{ now()->format('d F Y') }}</p>
            <div class="row row-cards mb-3">
                <div class="col">
                    <div class="card">
                        <table class="table table-vcenter table-bordered table-striped card-table">
                            <thead class="border-1">
                                <tr>
                                    <th>Tendik</th>
                                    <th>Mapel</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Kelas</th>
                                    <th>Materi</th>
                                    <th>Absensi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="border-1">
                                @forelse ($jurnal as $item)
                                    <tr>
                                        <td>
                                            <div>{{ $item->tendik->nama }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->mapel }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->tanggal }}</div>
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($item->jam_berakhir)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>{{ $item->kelas }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->materi }}</div>
                                        </td>
                                        <td>
                                            <div>
                                                <button class="btn">Masuk
                                                    <span class="badge bg-green text-green-fg ms-2">
                                                        {{ $item->hadir }}
                                                    </span>
                                                </button>
                                                <button class="btn">Sakit
                                                    <span class="badge bg-orange text-orange-fg ms-2">
                                                        {{ $item->sakit }}
                                                    </span>
                                                </button>
                                                <button class="btn">Izin
                                                    <span class="badge bg-azure text-azure-fg ms-2">
                                                        {{ $item->izin }}
                                                    </span>
                                                </button>
                                                <button class="btn">Alpa
                                                    <span class="badge bg-red text-red-fg ms-2">
                                                        {{ $item->alpa }}
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div>{{ $item->keterangan }}</div>
                                        </td>
                                    </tr>
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
                </div>
            </div>
        </div>
        <p>SMK TI BAZMA Islamic Boarding School</p>
        <p>Bogor, {{ now()->format('d F Y') }}</p>
        <b>Kepala Sekolah</b>
        <p class="fw-bold">Ahmad Dahlan, S.Ag.</p>
        <script>
            window.onload = function() {
                window.print();
            }
        </script>
    @endif
@endsection
