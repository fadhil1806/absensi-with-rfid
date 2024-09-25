@extends('layouts.app')

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-lock-square-rounded">
                    <path stroke="none" d="M0 0h24V24H0z" fill="none"></path>
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9-9 9-9-1.8-9-9 1.8-9 9-9z"></path>
                    <path d="M8 11m0 1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1z"></path>
                    <path d="M10 11v-2a2 2 0 1 1 4 0v2"></path>
                </svg>
            </div>
            <form class="card card-md" action="{{ route('check.pin') }}" method="post" autocomplete="off" id="pin-form">
                @csrf
                <div class="card-body">
                    <h2 class="card-title card-title-lg text-center mb-4">Terkunci</h2>
                    <p class="my-4 text-center">Masukan <b>PIN</b> untuk membuka rekap absen tendik.</p>
                    <div class="my-5">
                        <div class="row g-4">
                            <div class="col">
                                <div class="row g-2">
                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="col">
                                            <input type="password" class="form-control form-control-lg text-center py-3"
                                                maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col">
                                <div class="row g-2">
                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="col">
                                            <input type="password" class="form-control form-control-lg text-center py-3"
                                                maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="pin" id="pin">
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            Buka
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inputs = document.querySelectorAll('[data-code-input]');
            var pinForm = document.getElementById('pin-form');
            var pinInput = document.getElementById('pin');

            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    if (e.target.value.length === e.target.maxLength && index + 1 < inputs.length) {
                        inputs[index + 1].focus();
                    }
                });
                input.addEventListener('keydown', function(e) {
                    if (e.target.value.length === 0 && e.keyCode === 8 && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });

            pinForm.addEventListener('submit', function(e) {
                var pin = '';
                inputs.forEach(input => {
                    pin += input.value;
                });
                pinInput.value = pin;
            });
        });
    </script>
@endsection
