<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SISCM System</title>
    
    {{-- Bootstrap CSS (CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

    {{-- Navigation Bar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">SISCM System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
    
                    @auth
                        {{-- Admin --}}
                        @if(auth()->user()->user_role <= 2)
                            <li class="nav-item"><a class="nav-link" href="{{ route('student.index') }}">Students</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('lecturer.index') }}">Lecturers</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('subject.index') }}">Subjects</a></li>
    
                        {{-- Lecturer --}}
                        @elseif(auth()->user()->user_role === 2)
                            <li class="nav-item"><a class="nav-link" href="{{ route('subject.index') }}">My Subjects</a></li>
                            {{-- Add more links specific to lecturers if needed --}}
    
                        {{-- Student --}}
                        @elseif(auth()->user()->user_role === 3)
                            <li class="nav-item"><a class="nav-link" href="{{ route('student.subjects') }}">My Subjects</a></li>
                        @endif
    
                        {{-- Common Logout Link --}}
                        <li class="nav-item ms-auto">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @endauth
    
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    

    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <span class="text-muted">&copy; {{ date('Y') }} SISCM System. All rights reserved.</span>
        </div>
    </footer>

    {{-- Bootstrap JS (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
