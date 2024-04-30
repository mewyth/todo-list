@extends('front')
@section('title', 'Halaman Utama')
@section('content')
    <h2 class="text-center mt-4 mb-5">Tabel Admin</h2>
    <div class="app-container d-flex align-items-center justify-content-center flex-column">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-1 shadow-sm rounded">
                    <div class="card-body">
                        <div class="table-wrapper">
                            <table id="tabeljadwal" class="display">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No.</th>
                                        <th scope="col" class="text-center">Judul</th>
                                        <th scope="col" class="text-center">Deskripsi</th>
                                        <th scope="col" class="text-center">Tanggal Mulai</th>
                                        <th scope="col" class="text-center">Deadline</th>
                                        <th scope="col" class="text-center">Nama User</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (session('user.role') == 1)
                                        <?php $index = 0; ?>
                                        @forelse ($jadwals as $jadwal)
                                            <tr>
                                                <?php $index += 1; ?>
                                                <td class="text-center"><?php echo $index; ?></td>
                                                <td class="text-center">{{ $jadwal->judul }}</td>
                                                <td class="text-center">{{ $jadwal->deskripsi }}</td>
                                                <td class="text-center">{{ date('D, d-M-Y', strtotime($jadwal->start)) }}</td>
                                                <td class="text-center">{{ date('D, d-M-Y', strtotime($jadwal->end)) }}</td>
                                                <td class="text-center">{{ $jadwal->nama_user }}</td>
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
                                                <td>Dahulu</td>
                                                <td>Dari</td>
                                                <td>User</td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <td>Silahkan</td>
                                        <td>Masuk Dengan</td>
                                        <td>Akun Admin</td>
                                        <td>Untuk Mengakses</td>
                                        <td>Data</td>
                                        <td>-Data</td>
                                        <td>Ini</td>
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
