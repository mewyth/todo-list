<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ToDo List')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <link rel="stylesheet" href="{{asset('assets/datepicker/css/bootstrap-datepicker.min.css')}}"> --}}
</head>

<body>
    {{-- Navbar --}}
    @include('include.header')
    {{-- Content --}}
    @yield('content')

    {{-- Bootstrap --}}
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    {{-- toaster warning --}}
    <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @elseif(session()->has('warning'))

            toastr.warning('{{ session('warning') }}', 'PERHATIAN!'); 
            
        @endif
        //deadline terdekat
        @if(session()->has('user') && isset($nearestDeadline))
            toastr.warning('Deadline tugas terdekat: {{ $nearestDeadline->judul }}. Tanggal: {{ date('d M Y', strtotime($nearestDeadline->end)) }}', 'Tugas Terdekat');
        @endif
    </script>
    {{-- DataTable --}}
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script>
        new DataTable('#tabeljadwal');
    </script>
</body>
</html>
