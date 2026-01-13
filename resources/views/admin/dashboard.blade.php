@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>Dashboard Overview</h2>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Messages</h3>
            <p class="stat-number">{{ $messagesCount }}</p>
        </div>
        <div class="stat-card">
            <h3>Projects</h3>
            <p class="stat-number">{{ $projectsCount }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Page Views</h3>
            <p class="stat-number">{{ $totalVisits }}</p>
        </div>
        <div class="stat-card">
            <h3>Unique Visitors</h3>
            <p class="stat-number">{{ $uniqueVisitors }}</p>
        </div>
    </div>
@endsection
