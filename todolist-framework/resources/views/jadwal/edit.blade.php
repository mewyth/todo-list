@extends('front')
@section('title', 'Edit Tugas')
@section('content')
    <div class="container">
        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" class="ms-auto me-auto mt-5" style="width: 500px">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id_user" value="{{ session('user.id') }}">
                <label class="form-label">Judul Tugas</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                    value="{{ old('judul', $jadwal->judul) }}">
                <!-- error message untuk judul -->
                @error('judul')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="deskripsi">{{ old('deskripsi', $jadwal->deskripsi) }}</textarea>
                <!-- error message untuk deskripsi -->
                @error('deskripsi')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control @error('start') is-invalid @enderror" name="start"
                    value="{{ old('start', $jadwal->start) }}">
                <!-- error message untuk deadline -->
                @error('start')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deadline</label>
                <input type="date" class="form-control @error('end') is-invalid @enderror" name="end"
                    value="{{ old('end', $jadwal->end) }}">
                <!-- error message untuk deadline -->
                @error('end')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
