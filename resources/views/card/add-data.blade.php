@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form method="post" action="{{route('card.add')}}" enctype="multipart/form-data">
            @csrf
            <div class="row border p-3 rounded-3">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Id Card</label>
                        <textarea class="form-control" name="id" rows="4">{{old('id')}}</textarea>
                        @error('id')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success " id="submitButton">Submit</button>
            </div>
        </form>
    </div>

@endsection
