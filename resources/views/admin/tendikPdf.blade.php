<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="row row-cards">
        <div class="col">
            <div class="card">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            @for ($i = $start_date; $i <= $end_date; $i++)
                                <th>{{ \Carbon\Carbon::parse($i)->format('d') }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absensi as $item)
                            <tr>
                                <td>
                                    {{ $item->tendik->nama }}
                                </td>
                                @for ($i = $start_date; $i <= $end_date; $i++)
                                    <?php
                                    $tanggal_masuk = \Carbon\Carbon::parse($item->jam_masuk)->format('Y-m-d');
                                    ?>
                                    <td>
                                        @if ($tanggal_masuk == $i)
                                            <span class="badge bg-green text-green-fg">M</span>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @empty
                        @endforelse
                        @foreach ($izin as $item)
                            <tr>
                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>
                                    <span class="badge bg-green text-green-fg">{{ $item->role }}</span>
                                </td>
                                <td>
                                    {{ $item->keterangan }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
