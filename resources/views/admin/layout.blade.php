<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Sufian Mahbub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
            padding-top: 0; /* Override hero padding */
        }
        .sidebar {
            width: 250px;
            background: var(--bg-light);
            border-right: 1px solid rgba(255,255,255,0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .admin-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }
        .sidebar-logo {
            font-family: var(--font-code);
            font-size: 1.2rem;
            color: var(--text-primary);
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: var(--transition);
        }
        .nav-item:hover, .nav-item.active {
            background: rgba(0, 255, 245, 0.1);
            color: var(--primary-color);
        }
        .nav-item i {
            width: 25px;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .btn-sm {
            padding: 8px 16px;
            font-size: 0.85rem;
        }
        
        /* Tables */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--card-bg);
            border-radius: 10px;
            overflow: hidden;
            border: var(--glass-border);
        }
        .admin-table th, .admin-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .admin-table th {
            background: rgba(0,0,0,0.2);
            color: var(--secondary-color);
            font-weight: 600;
        }
        .action-btn {
            color: var(--text-secondary);
            margin-right: 10px;
            transition: 0.3s;
        }
        .action-btn:hover {
            color: var(--primary-color);
        }
        .delete-btn:hover {
            color: var(--accent-pink);
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-logo">
                <span class="logo-bracket">&lt;</span>Admin<span class="logo-bracket">/&gt;</span>
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.projects') }}" class="nav-item {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
                <i class="fas fa-code"></i> Projects
            </a>
            <a href="{{ route('admin.articles') }}" class="nav-item {{ request()->routeIs('admin.articles*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Articles
            </a>
            <a href="{{ route('admin.testimonials') }}" class="nav-item {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                <i class="fas fa-star"></i> Testimonials
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="nav-item {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="{{ route('admin.chat') }}" class="nav-item {{ request()->routeIs('admin.chat') ? 'active' : '' }}">
                <i class="fas fa-comments"></i> Messages
            </a>
            
            <div style="margin-top: auto;">
                <a href="/" class="nav-item" target="_blank">
                    <i class="fas fa-external-link-alt"></i> View Site
                </a>
            </div>
        </div>
        
        <main class="admin-content">
            @if(session('success'))
                <div style="background: rgba(0,255,245,0.1); color: var(--primary-color); padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid var(--primary-color);">
                    {{ session('success') }}
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>
    
    @yield('scripts')
</body>
</html>
