@extends('layouts.app')

@section('title', 'EduQuiz - Platform Pembelajaran Online Malware')

{{-- Panggil CSS khusus User / Dashboard --}}
@push('page-css')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush

@section('content')
<!-- Panggil Navbar Partial -->
@include('partials.navbar')

<!-- HERO BANNER DIPINDAH KELUAR: Sekarang nempel rapat ke navbar -->
<div class="hero-banner">
    <h1>EduQuiz</h1>
    <p>Platform Pembelajaran Online Malware</p>
    <div class="hero-buttons">
        <a href="#materi-section" id="btnMateri" class="btn-hero materi">Materi</a>
        <a href="#" id="btnKuis" class="btn-hero kuis">Kuis</a>
    </div>
</div>

<!-- WRAPPER UTAMA KONTEN DI BAWAH BANNER -->
<div class="home-wrapper">
    <!-- Section Daftar Materi -->
    <div class="section-title" id="materi-section">
        <h2>Materi</h2>
        <p>Tentang bahayanya sebuah malware</p>
    </div>

    <div class="materi-grid">
        <!-- Card 1 -->
        <div class="materi-card">
            <h3>Pengenalan Malware</h3>
            <p class="sub">Apa itu Malware?</p>
            <p class="desc">Malware merupakan perangkat lunak berbahaya yang dirancang untuk merusak atau menyusup ke dalam sistem komputer...</p>
        </div>

        <!-- Card 2 -->
        <div class="materi-card">
            <h3>Jenis-Jenis Malware</h3>
            <p class="sub">Apa saja jenis Malware?</p>
            <p class="desc">Malware memiliki berbagai jenis karakteristik seperti Virus, Worm, Trojan, Ransomware, dan Spyware...</p>
        </div>

        <!-- Card 3 -->
        <div class="materi-card">
            <h3>Cara Mengatasi Malware</h3>
            <p class="sub">Bagaimana cara mengatasinya?</p>
            <p class="desc">Malware bisa diatasi dengan menggunakan antivirus terpercaya, memindai sistem, serta membersihkan file terinfeksi...</p>
        </div>

        <!-- Card 4 -->
        <div class="materi-card">
            <h3>Upaya Pencegahan</h3>
            <p class="sub">Bagaimana upaya pencegahannya?</p>
            <p class="desc">Malware dapat dicegah dengan tidak mengklik tautan sembarangan dan selalu memperbarui sistem operasi...</p>
        </div>

        <!-- Card 5 -->
        <div class="materi-card">
            <h3>Sejarah Malware</h3>
            <p class="sub">Kapan Malware pertama kali ada?</p>
            <p class="desc">Malware ada sejak awal perkembangan dunia komputasi modern dengan eksperimen awal program reproduksi mandiri...</p>
        </div>

        <!-- Card 6 -->
        <div class="materi-card">
            <h3>Cara Kerja Malware</h3>
            <p class="sub">Bagaimana cara kerjanya?</p>
            <p class="desc">Malware memiliki mekanisme infeksi yang unik untuk menyebar dari satu perangkat ke perangkat lainnya secara senyap...</p>
        </div>
    </div>
</div>

<!-- Panggil Footer Partial -->
@include('partials.footer')
@endsection