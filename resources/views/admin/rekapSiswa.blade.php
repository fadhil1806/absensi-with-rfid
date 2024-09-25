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
                            Absen Siswa
                        </h2>
                    </div>
                </div>
            </div>
            <form action="/filter-siswa" method="GET">
                <div class="row g-2">
                    <div class="col-4">
                        <div class="input-icon mb-3">
                            <input class="form-control" name="start_date"
                                placeholder="{{ str_contains(request()->url(), 'filter-siswa') == true ? $start_date : '' }}"
                                id="datepicker-icon-1" value="" fdprocessedid="m75zlq" autocomplete="off">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
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
                            <input class="form-control" name="end_date"
                                placeholder="{{ str_contains(request()->url(), 'filter-siswa') == true ? Str::limit($end_date, 10, '') : '' }}"
                                id="datepicker-icon-2" value="" fdprocessedid="m75zlq" autocomplete="off">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
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
            <div class="row row-cards mb-3">
                <div class="col">
                    <h1>Data Absensi Siswa</h1>
                    <p><b>Tanggal : </b>{{ now()->format('d F Y') }}</p>
                    <p><b>Kelas : </b>{{ $kelas }}</p>
                    <div class="card">
                        <table class="table table-vcenter table-bordered table-striped card-table">
                            <thead class="border-1">
                                <tr>
                                    <th>Nama</th>
                                    @foreach ($loopTanggal as $tanggal)
                                        <th class="text-center">{{ htmlspecialchars($tanggal['day']) }}</th>
                                    @endforeach
                                    <th class="text-center"><span class="badge bg-green text-green-fg">M</span></th>
                                    <th class="text-center"><span class="badge bg-red text-red-fg">T</span></th>
                                    <th class="text-center"><span class="badge bg-blue text-blue-fg">I</span></th>
                                    <th class="text-center"><span class="badge bg-orange text-orange-fg">S</span></th>
                                    <th class="text-center"><span class="badge bg-red text-red-fg">A</span></th>
                                </tr>
                            </thead>
                            <tbody class="border-1">
                                @php
                                    $totalM = 0;
                                    $totalT = 0;
                                    $totalI = 0;
                                    $totalS = 0;
                                    $totalA = 0;
                                @endphp
                                @forelse ($rowTableAbsensi as $item)
                                    <tr>
                                        <td>
                                            {{ $item->siswa->nama }}
                                        </td>
                                        @php
                                            $absensiDates = [];
                                            $izinDates = [];
                                            $lastIzin = [];
                                            $terlambatDates = [];
                                        @endphp
                                        @foreach ($absensi as $itemA)
                                            @if ($itemA->siswa_id == $item->siswa_id)
                                                @php
                                                    $absensiDates[] = \Carbon\Carbon::parse($itemA->jam_masuk)->format(
                                                        'Y-m-d',
                                                    );
                                                    if ($itemA->status == 'Terlambat') {
                                                        $terlambatDates[] = \Carbon\Carbon::parse(
                                                            $itemA->jam_masuk,
                                                        )->format('Y-m-d');
                                                    }
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach ($izin as $itemI)
                                            @if ($itemI->siswa->nama == $item->siswa->nama)
                                                @php
                                                    $izinDates[] = \Carbon\Carbon::parse($itemI->created_at)->format(
                                                        'Y-m-d',
                                                    );
                                                    $lastIzin[$itemI->created_at->format('Y-m-d')] = $itemI->jenis_izin;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @php
                                            $absensiDates = array_unique($absensiDates);
                                            $terlambatDates = array_unique($terlambatDates);
                                        @endphp
                                        @foreach ($loopTanggal as $tanggal)
                                            <td class="text-center">
                                                @if (in_array($tanggal['date'], $izinDates))
                                                    @php
                                                        $jenisIzin = $lastIzin[$tanggal['date']] ?? null;
                                                    @endphp
                                                    @if ($jenisIzin === 'Izin')
                                                        <span class="badge bg-azure text-azure-fg">I</span>
                                                        @php $totalI++; @endphp
                                                    @elseif ($jenisIzin === 'Sakit')
                                                        <span class="badge bg-orange text-orange-fg">S</span>
                                                        @php $totalS++; @endphp
                                                    @else
                                                        <span class="badge bg-red text-red-fg">A</span>
                                                        @php $totalA++; @endphp
                                                    @endif
                                                @else
                                                    @if (in_array($tanggal['date'], $terlambatDates))
                                                        <span class="badge bg-red text-red-fg">T</span>
                                                        @php $totalT++; @endphp
                                                    @elseif (in_array($tanggal['date'], $absensiDates))
                                                        <span class="badge bg-green text-green-fg">M</span>
                                                        @php $totalM++; @endphp
                                                    @endif
                                                @endif
                                        @endforeach
                                        <td class="text-center">{{ count($absensiDates) }}</td>
                                        <td class="text-center">{{ count($terlambatDates) }}</td>
                                        <td class="text-center">{{ $totalI }}</td>
                                        <td class="text-center">{{ $totalS }}</td>
                                        <td class="text-center">{{ $totalA }}</td>
                                    </tr>
                                    @php
                                        $totalM = 0;
                                        $totalT = 0;
                                        $totalI = 0;
                                        $totalS = 0;
                                        $totalA = 0;
                                    @endphp
                                @empty
                                    <tr>
                                        @php
                                            $n = 1;
                                        @endphp
                                        <td @foreach ($loopTanggal as $tanggal) {{ $n++ }} @endforeach
                                            colspan="{{ $n += 6 }}" class="text-center">
                                            Tidak Ada Data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row row-cards mb-3">
                <div class="col-10">
                    <div class="card">
                        <table class="table table-vcenter table-bordered table-striped card-table">
                            <thead class="border-1">
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis Izin</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">Validasi</th>
                                </tr>
                            </thead>
                            <tbody class="border-1">
                                @foreach ($izin as $item)
                                    @if ($item->tendik_id == null)
                                        <tr>
                                            <td>
                                                {{ $item->siswa->nama }}
                                            </td>
                                            @if ($item->jenis_izin == 'Izin')
                                                <td><span
                                                        class="badge bg-azure text-azure-fg">{{ $item->jenis_izin }}</span>
                                                </td>
                                            @elseif ($item->jenis_izin == 'Sakit')
                                                <td><span
                                                        class="badge bg-orange text-orange-fg">{{ $item->jenis_izin }}</span>
                                                </td>
                                            @else
                                                <td><span class="badge bg-red text-red-fg">{{ $item->jenis_izin }}</span>
                                                </td>
                                            @endif
                                            <td>{{ $item->created_at->format('d F') }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td class="text-center">
                                                {{-- Badge jika checkbox ter-check --}}
                                                <span class="badge bg-green text-green-fg badge-checked"
                                                    id="badge-checked-{{ $item->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                        <path d="M9 12l2 2l4 -4" />
                                                    </svg>
                                                </span>
                                                {{-- Badge jika checkbox tidak ter-check --}}
                                                <span class="badge bg-danger text-danger-fg badge-unchecked"
                                                    id="badge-unchecked-{{ $item->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-circle-x">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                        <path d="M10 10l4 4m0 -4l-4 4" />
                                                    </svg>
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card">
                        <table class="table table-vcenter table-bordered table-striped card-table">
                            <thead class="border-1">
                                <tr>
                                    <th>Icon</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="border-1">
                                <tr>
                                    <td>
                                        <span class="badge bg-green text-green-fg">M</span>
                                    </td>
                                    <td>
                                        Masuk
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge bg-azure text-azure-fg">I</span>
                                    </td>
                                    <td>
                                        Izin
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge bg-orange text-orange-fg">S</span>
                                    </td>
                                    <td>
                                        Sakit
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge bg-red text-red-fg">A</span>
                                    </td>
                                    <td>
                                        Alpa
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <p>SMK TI BAZMA Islamic Boarding School</p>
        <p>Bogor, {{ now()->format('d F Y') }}</p>
        <b>Kepala Sekolah</b>
        <p>Ahmad Dahlan, S.Ag.</p>
        <script>
            window.onload = function() {
                window.print();
            }
        </script>
    @endif
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const items = @json($izin); // Pastikan variabel items tersedia di Blade

            items.forEach(item => {
                const checkboxId = 'checkbox-' + item.id;
                const badgeChecked = document.getElementById('badge-checked-' + item.id);
                const badgeUnchecked = document.getElementById('badge-unchecked-' + item.id);
                const savedState = localStorage.getItem(checkboxId);

                if (savedState === 'true') {
                    badgeChecked.style.display = 'inline';
                    badgeUnchecked.style.display = 'none';
                } else {
                    badgeChecked.style.display = 'none';
                    badgeUnchecked.style.display = 'inline';
                }
            });
        });
    </script>
@endsection
