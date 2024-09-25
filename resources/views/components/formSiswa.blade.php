{{-- Modal IMPORT EXCELL --}}
<div class="modal modal-blur fade" id="modal-import" tabindex="-1" aria-modal="false" role="dialog">
    <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-blue"></div>
                <div class="modal-body py-4">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" class="icon icon-lg text-blue my-3" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-import">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" />
                        </svg>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Import From Excel</label>
                        <input type="file" class="form-control" name="excel_file" value="{{ old('excel_file') }}">
                        @error('excel_file')
                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button href="#" type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
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
{{-- Form Create --}}
<div class="modal modal-blur fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="{{ route('siswa.perform') }}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                                    <option value="Laki-Laki" selected>Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <label class="form-label">Kelas</label>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-4">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="kelas" value="Kelas 10" class="form-selectgroup-input"
                                    @if (old('kelas') == 'Kelas 10') checked @endif>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Kelas 10</span>
                                        <span class="d-block text-secondary">Pengem Perangkat Lunak & Game</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="kelas" value="Kelas 11" class="form-selectgroup-input"
                                    @if (old('kelas') == 'Kelas 11') checked @endif>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Kelas 11</span>
                                        <span class="d-block text-secondary">Sistem Infomasi Jaringan & Aplikasi</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="kelas" value="Kelas 12" class="form-selectgroup-input"
                                    @if (old('kelas') == 'Kelas 12') checked @endif>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Kelas 12</span>
                                        <span class="d-block text-secondary">Sistem Infomasi Jaringan & Aplikasi</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        @error('kelas')
                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NISN</label>
                        <input type="number" class="form-control" name="nisn" value="{{ old('nisn') }}">
                        @error('nisn')
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
                            <input type="radio" name="role" value="Siswa" class="form-selectgroup-input"
                                checked>
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">Siswa</span>
                                </span>
                            </span>
                        </label>
                        @error('role')
                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                        @enderror
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
</div>

{{-- Form Edit & delete --}}
@foreach ($siswa as $item)
    <div class="modal modal-blur fade" id="modal-update-{{ $item->id }}" tabindex="-1" role="dialog"
        aria-hidden="true">
        <form action="{{ route('siswa.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data</h5>
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
                        <label class="form-label">Kelas</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-4">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="kelas" value="Kelas 10"
                                        class="form-selectgroup-input"
                                        @if ($item->kelas == 'Kelas 10') checked @endif>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Kelas 10</span>
                                            <span class="d-block text-secondary">Pengem Perangkat Lunak & Game</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="kelas" value="Kelas 11"
                                        class="form-selectgroup-input"
                                        @if ($item->kelas == 'Kelas 11') checked @endif>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Kelas 11</span>
                                            <span class="d-block text-secondary">Sistem Infomasi Jaringan &
                                                Aplikasi</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="kelas" value="Kelas 12"
                                        class="form-selectgroup-input"
                                        @if ($item->kelas == 'Kelas 12') checked @endif>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Kelas 12</span>
                                            <span class="d-block text-secondary">Sistem Infomasi Jaringan &
                                                Aplikasi</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            @error('kelas')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NISN</label>
                            <input type="number" class="form-control" name="nisn" value="{{ $item->nisn }}">
                            @error('nisn')
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
                                    <div class="input-icon">
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
                                <input type="radio" name="role" value="Siswa" class="form-selectgroup-input"
                                    checked>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Siswa</span>
                                    </span>
                                </span>
                            </label>
                            @error('role')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
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
    {{-- Form Delete --}}
    <div class="modal modal-blur fade" id="modal-delete-{{ $item->id }}" tabindex="-1" role="dialog"
        aria-hidden="true">
        <form action="{{ route('siswa.delete', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                    <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        TIDAK
                                    </a>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger w-100" data-bs-dismiss="modal" type="submit">
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
@endforeach
