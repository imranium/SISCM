<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title') - SCM Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex">
    {{-- Sidebar Navigation (Left Navbar) --}}
    <aside class="w-1/4 h-screen bg-blue-800 text-white p-5">
        <h2 class="text-xl font-bold mb-5">SCM Dashboard</h2>
        <ul>
            <li><a href="{{ route('students.index') }}" class="block py-2">Students</a></li>
            <li><a href="{{ route('lecturers.index') }}" class="block py-2">Lecturers</a></li>
            <li><a href="{{ route('subjects.index') }}" class="block py-2">Subjects</a></li>
        </ul>
    </aside>

    {{-- Main Content Area --}}
    <main class="w-3/4 p-8">
        <h1 class="text-2xl font-bold">@yield('title')</h1>
        @yield('content')
    </main>
</body>
</html>

