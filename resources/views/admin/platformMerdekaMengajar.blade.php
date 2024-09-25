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
                        {{ session('success') }}
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
                        Platform Merdeka Mengajar
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
                            data-bs-target="#modal-report" aria-label="Create new report">
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
                                <th>Tendik</th>
                                <th>Topik</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Hasil</th>
                                <th>Sertifikat</th>
                                <th class="w-8"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($platform as $item)
                                <tr>
                                    <td>
                                        <div>{{ $item->tendik->nama }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $item->topik }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $item->tanggal }}</div>
                                    </td>
                                    <td>
                                        <div>{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($item->jam_berakhir)->format('H:i') }}</div>
                                    </td>
                                    <td>
                                        <div>{!! $item->hasil !!}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <img src="{{ asset('img/foto/' . $item->sertifikat) }}"
                                                class="avatar avatar-lg img-fluid rounded" alt="" srcset=""
                                                style="object-fit:cover;">
                                        </div>
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
                                    <form action="{{ route('platform.delete', $item->id) }}" method="POST">
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
                        Showing {{ $platform->firstItem() }}
                        to {{ $platform->lastItem() }}
                        of {{ $platform->total() }}
                        entries
                    </p>
                    <ul class="pagination m-0 ms-auto">
                        {{ $platform->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Create --}}
    <div class="modal modal-blur fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('platform.perform') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tendik</label>
                            <select class="form-select" name="tendik_id">
                                @foreach ($tendik as $itemT)
                                    <option value="{{ $itemT->id }}">{{ $itemT->nama }}</option>
                                @endforeach
                            </select>
                            @error('tendik')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Topik</label>
                            <input type="text" class="form-control" name="topik" value="{{ old('topik') }}"
                                autocomplete="off">
                            @error('topik')
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
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-6" id="jam_mulai">
                                    <label class="form-label">Jam Mulai</label>
                                    <input type="dateTime" name="jam_mulai" class="form-control" data-mask="00:00"
                                        data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                        fdprocessedid="ms68ld" value="{{ old('jam_mulai') }}">
                                    @error('jam_mulai')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-lg-6" id="jam_berakhir">
                                    <label class="form-label">Jam Berakhir</label>
                                    <input type="text" name="jam_berakhir" class="form-control" data-mask="00:00"
                                        data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                        fdprocessedid="ms68ld" value="{{ old('jam_berakhir') }}">
                                    @error('jam_berakhir')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hasil</label>
                            <textarea name="hasil" id="tinymce-mytextarea">{!! old('hasil') !!}</textarea>
                            @error('hasil')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-label">Sertifikat</div>
                        <input accept="image/*" type="file" class="form-control" name="sertifikat"
                            onchange="previewImage()" value="{{ old('sertifikat') }}">
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
    @foreach ($platform as $item)
        <div class="modal modal-blur fade" id="modal-update-{{ $item->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <form action="{{ route('platform.update', $item->id) }}" method="POST" enctype="multipart/form-data">
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
                            <div class="mb-3">
                                <label class="form-label" for="tendik_id">Tendik</label>
                                <select class="form-select" name="tendik_id">
                                    @foreach ($tendik as $itemT)
                                        <option value="{{ $itemT->id }}"
                                            @if ($item->tendik_id == $itemT->id) selected @endif>{{ $itemT->nama }}</option>
                                    @endforeach
                                </select>
                                @error('tendik')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Topik</label>
                                <input type="text" class="form-control" name="topik" value="{{ $item->topik }}"
                                    autocomplete="off">
                                @error('topik')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
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
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-lg-6" id="jam_mulai">
                                        <label class="form-label">Jam Mulai</label>
                                        <input type="dateTime" name="jam_mulai" class="form-control" data-mask="00:00"
                                            data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                            fdprocessedid="ms68ld" value="{{ $item->jam_mulai }}">
                                        @error('jam_mulai')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6" id="jam_berakhir">
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
                            <div class="mb-3">
                                <label class="form-label">Hasil</label>
                                <textarea name="hasil" id="tinymce-mytextarea">{!! $item->hasil !!}</textarea>
                                @error('hasil')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-label">Sertifikat</div>
                            <input accept="image/*" type="file" class="form-control" name="sertifikat"
                                onchange="previewImage()" value="{{ $item->sertifikat }}">
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

@section('TinyMCE')
    <script src="{{ asset('dist/libs/tinymce/tinymce.min.js') }}" defer=""></script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            let options = {
                selector: '#tinymce-mytextarea',
                height: 300,
                menubar: false,
                statusbar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount',
                    'textcolor'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
            }
            if (localStorage.getItem("tablerTheme") === 'dark') {
                options.skin = 'oxide-dark';
                options.content_css = 'dark';
            }
            tinyMCE.init(options);
        })
        // @formatter:on
    </script>
    <div class="tox tox-silver-sink tox-tinymce-aux" style="position: relative;"></div>
@endsection
