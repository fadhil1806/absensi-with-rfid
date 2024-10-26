@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form method="post" action="{{ route('card.add', $id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row border p-3 rounded-3">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Id Card</label>
                        <input type="text" class="form-control" name="card_id" value={{ old('id', $data->card_id) }}>
                        @error('id')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" id="statusSelect" onchange="fetchData()">
                            <option value="">Pilih Status</option>
                            <option value="siswa">Siswa</option>
                            <option value="tendik">Tendik</option>
                        </select>
                        @error('status')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12" id="dataContainer" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Data</label>
                        <select class="form-select" name="data_id" id="dataSelect">
                        </select>
                        @error('data')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                </div>
                @if (session('message'))
                    <div class="text-danger mb-3 mt-4" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </form>
    </div>

    <script>
        function fetchData() {
            const statusSelect = document.getElementById('statusSelect');
            const dataContainer = document.getElementById('dataContainer');
            const dataSelect = document.getElementById('dataSelect');

            dataContainer.style.display = statusSelect.value ? 'block' : 'none';
            dataSelect.innerHTML = ''; // Kosongkan opsi sebelumnya

            if (statusSelect.value === 'siswa') {
                // Lakukan AJAX untuk mengambil data siswa
                fetch('/api/siswa') // Endpoint untuk mengambil data siswa
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id; // Sesuaikan dengan ID siswa
                            option.textContent = item.nama; // Sesuaikan dengan nama siswa
                            dataSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching siswa:', error));
            } else if (statusSelect.value === 'tendik') {
                // Lakukan AJAX untuk mengambil data tendik
                fetch('/api/tendik') // Endpoint untuk mengambil data tendik
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id; // Sesuaikan dengan ID tendik
                            option.textContent = item.nama; // Sesuaikan dengan nama tendik
                            dataSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching tendik:', error));
            }
        }
    </script>
@endsection
