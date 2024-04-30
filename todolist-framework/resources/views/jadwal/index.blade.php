@extends('front')
@section('title', 'Halaman Utama')
@section('content')
    <h2 class="text-center mt-4 mb-5">Jangan Lupa Kegiatan Hari ini</h2>
    <div class="app-container d-flex align-items-center justify-content-center flex-column">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-1 shadow-sm rounded">
                    <div class="card-body">
                        @if (session()->has('user'))
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Tambah Tugas
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Tugas Disini</h1>
                                        </div>
                                        <form action="{{ route('jadwal.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="hidden" class="form-control" name="id_user"
                                                        value="{{ session('user.id') }}">
                                                    <label class="form-label">Judul Tugas</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Judul Tugas Anda" name="judul">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea class="form-control" rows="3" name="deskripsi"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Mulai</label>
                                                    <input type="date" class="form-control" placeholder="Klik Disini"
                                                        name="start">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deadline</label>
                                                    <input type="date" class="form-control" placeholder="Klik Disini"
                                                        name="end">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="table-wrapper">
                            <table id="tabeljadwal" class="display">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No.</th>
                                        <th scope="col" class="text-center">Judul</th>
                                        <th scope="col" class="text-center">Deskripsi</th>
                                        <th scope="col" class="text-center">Tanggal Mulai</th>
                                        <th scope="col" class="text-center">Deadline</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (session()->has('user'))
                                        <?php $index = 0; ?>
                                        @forelse ($jadwals as $jadwal)
                                            <tr>
                                                <?php $index += 1; ?>
                                                <td class="text-center"><?php echo $index; ?></td>
                                                <td class="text-center">{{ $jadwal->judul }}</td>
                                                <td class="text-center">{{ $jadwal->deskripsi }}</td>
                                                <td class="text-center">{{ date('D, d-M-Y', strtotime($jadwal->start)) }}
                                                </td>
                                                <td class="text-center">{{ date('D, d-M-Y', strtotime($jadwal->end)) }}</td>
                                                <td class="text-center">
                                                    <form onsubmit="return confirm('Apakah anda yakin?');"
                                                        action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST">
                                                        <a href="{{ route('jadwal.edit', $jadwal->id) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                        {{-- <a href="" class="btn btn-sm btn-success">Selesai</a> --}}
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </td>

                                            @empty
                                                <td>Data</td>
                                                <td>Tidak Ada</td>
                                                <td>Silahkan</td>
                                                <td>Tambah Tugas</td>
                                                <td>Terlebih</td>
                                                <td>Dahulu</td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <td>Data</td>
                                        <td>Tidak Ada</td>
                                        <td>Silahkan</td>
                                        <td>Login</td>
                                        <td>Terlebih</td>
                                        <td>Dahulu</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
