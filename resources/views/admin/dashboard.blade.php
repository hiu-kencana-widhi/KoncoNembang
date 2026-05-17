@extends('layouts.admin')
@section('content')
    <h2>Dashboard Utama</h2>
    <p class="page-subtitle">Selamat datang di Pusat Manajemen Konten KoncoNembang.</p>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">Total User</div>
            <div class="stat-value">{{ $stats['users'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Total Lagu</div>
            <div class="stat-value">{{ $stats['tracks'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Total Kategori</div>
            <div class="stat-value">{{ $stats['categories'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Total Album</div>
            <div class="stat-value">{{ $stats['albums'] }}</div>
        </div>
    </div>
@endsection
