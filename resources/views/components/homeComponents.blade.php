{{-- edit jam --}}
<div class="modal modal-blur fade" id="modal-edit-jam" tabindex="-1" aria-modal="false" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Jam Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('waktu.update', $waktu->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="jam_masuk">Jam Masuk</label>
                                <input autocomplete="off" type="text" name="jam_masuk" class="form-control"
                                    data-mask="00:00" data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                    value="{{ $waktu->jam_masuk }}">
                            </div>
                            @error('jam_masuk')
                                <p class="text-red">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="jam_Pulang">Jam Pulang</label>
                                <input autocomplete="off" type="text" name="jam_pulang" class="form-control"
                                    data-mask="00:00" data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                    value="{{ $waktu->jam_pulang }}">
                            </div>
                            @error('jam_pulang')
                                <p class="text-red">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@foreach ($absensi as $item)
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAbsensi-{{ $item->id }}"
        aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasEndLabel">Data Peserta Absensi</h2>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                @if ($item->tendik_id == null)
                    <div class="page-header m-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="page-pretitle">
                                    Role
                                </div>
                                <h2 class="page-title">
                                    {{ $item->siswa->role }}
                                </h2>
                            </div>
                            <div class="col-auto ms-auto">
                                <h3 class="m-0">Tanggal Masuk:</h3>
                                <p>
                                    {{ \Carbon\Carbon::parse($item->jam_masuk)->isoFormat('dddd, D MMMM Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-5">
                            <div
                                class="card rounded-4 @if ($item->status == 'Terlambat') bg-red text-red-fg @else bg-green text-green-fg @endif text-center w-full p-2">
                                <img src="{{ $item->siswa->foto ? asset('img/foto/' . $item->siswa->foto) : asset('img/bahan/1.png') }}"
                                    style="max-height: 250px;object-fit:cover;min-height:250px;"
                                    class="rounded-4 w-full" alt="">
                                <div class="mt-2">
                                    <h2 class="mb-2">
                                        {{ $item->status }}
                                    </h2>
                                </div>
                            </div>
                            <h3 class="mt-1 mb-0">
                                <span class="badge bg-yellow text-dark w-full">
                                    {{ \Carbon\Carbon::parse($item->jam_masuk)->isoFormat('dddd, D MMMM Y') }}
                                </span>
                            </h3>
                            <table class="w-full mt-2 py-2">
                                <tr>
                                    <td class="align-top text-start"><strong>Masuk</strong></td>
                                    <td class="text-start">:</td>
                                    <td class="align-top text-end">
                                        {{ \Carbon\Carbon::parse($item->jam_masuk)->format('H : i') }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <div class="ms-lg-5">
                                <h2>Data : </h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody class="table-body">
                                            <tr>
                                                <td class="align-top"><strong>Nama</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->siswa->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>Kelas</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->siswa->kelas }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>NISN</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->siswa->nisn }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>Jenis Kelamin</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->siswa->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>TTL</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->siswa->tempat_lahir }},
                                                    {{ \Carbon\Carbon::parse($item->siswa->tanggal_lahir)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>No. WA</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->siswa->nomor_whatsapp }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                @elseif ($item->siswa_id == null)
                    <div class="page-header m-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="page-pretitle">
                                    Role
                                </div>
                                <h2 class="page-title">
                                    {{ $item->tendik->role }}
                                </h2>
                            </div>
                            <div class="col-auto ms-auto">
                                <h3 class="m-0">Tanggal Masuk:</h3>
                                <p>
                                    {{ \Carbon\Carbon::parse($item->jam_masuk)->isoFormat('dddd, D MMMM Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-5">
                            <div
                                class="card rounded-4 @if ($item->status == 'Terlambat') bg-red text-red-fg @else bg-green text-green-fg @endif text-center w-full p-2">
                                <img src="{{ asset('img/foto/' . $item->tendik->foto) ?? asset('static/avatars/000f.jpg') }}"
                                    style="max-height: 250px;object-fit:cover;min-height:250px;"
                                    class="rounded-4 w-full" alt="">
                                <div class="mt-2">
                                    <h2 class="mb-2">
                                        {{ $item->status }}
                                    </h2>
                                </div>
                            </div>
                            <h3 class="mt-1 mb-0">
                                <span class="badge bg-yellow text-dark w-full">
                                    {{ \Carbon\Carbon::parse($item->jam_masuk)->isoFormat('dddd, D MMMM Y') }}
                                </span>
                            </h3>
                            <table class="w-full mt-2 py-2">
                                <tr>
                                    <td class="align-top text-start"><strong>Masuk</strong></td>
                                    <td class="text-start">:</td>
                                    <td class="align-top text-end">
                                        {{ \Carbon\Carbon::parse($item->jam_masuk)->format('H : i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-top text-start"><strong>Pulang</strong></td>
                                    <td class="text-start">:</td>
                                    <td class="align-top text-end">
                                        {{ $item->jam_pulang ? date('H : i', strtotime($item->jam_pulang)) : '?' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <div class="ms-lg-5">
                                <h2>Data : </h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody class="table-body">
                                            <tr>
                                                <td class="align-top"><strong>Nama</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->tendik->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>NIK</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->tendik->nik }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>Jenis Kelamin</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->tendik->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>TTL</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->tendik->tempat_lahir }},
                                                    {{ \Carbon\Carbon::parse($item->tendik->tanggal_lahir)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>No. WA</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">{{ $item->tendik->nomor_whatsapp }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>Jam Masuk</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">
                                                    {{ \Carbon\Carbon::parse($item->tendik->jam_masuk)->format('H:i') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-top"><strong>Jam Pulang</strong> </td>
                                                <td>:</td>
                                                <td class="align-top">
                                                    {{ \Carbon\Carbon::parse($item->tendik->jam_pulang)->format('H:i') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif
                <div class="card mt-5">
                    <div class="card-body">
                        <div id="chart-absensi-{{ $item->id }}" class="chart-lg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
