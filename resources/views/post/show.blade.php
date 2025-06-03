<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vargazs - Show</title>
    {{-- CSS --}}
    <link rel="stylesheet" href="style.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="fixed flex justify-center w-full pb-3 pt-9 gap-7 bg-white z-50">
        <div class="ml-56 w-full max-w-5xl relative flex">
            <span class="absolute left-4 top-3 text-lg text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" class="w-full border border-gray-400 pl-12 py-3 pr-3 rounded focus:outline-none" placeholder="Search">
        </div>

        <div class="flex items-center gap-4">
            {{-- Cek apakah user sudah login --}}
            @auth
                {{-- Nama Pengguna --}}
                <span>{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="w-8 h-8 rounded-full">

                {{-- Dropdown Profile (Opsional, jika ingin lebih kompleks) --}}
            @else
                {{-- Jika tidak login, tampilkan tombol login/register (harusnya tidak terjadi di dashboard) --}}
                <a href="{{ route('login') }}" class="bg-blue-500 px-5 py-3 rounded-md text-white transition-all duration-300 hover:bg-transparent hover:text-blue-500 hover:border-blue-500 border">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-5 py-3 rounded-md text-black transition-all duration-300 hover:bg-gray-200">Sign Up</a>
                @endif
            @endauth
        </div>
    </nav>

    <div class="fixed top-0 left-0 z-50 h-screen border-r border-gray-400 w-1/6 px-6 py-4 bg-white "> <p class="hero-title flex justify-center pt-7 font-bold text-3xl">vargazs</p>

        <div class="mt-16">
            <a href="{{ url('/dashboard') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500 @if(Request::is('dashboard')) @endif">
                <i class="fa-solid fa-house text-xl"></i>
                <p>Home</p>
            </a>
            <a href="{{ route('posts.index') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500 @if(Request::is('explore') || Request::is('posts')) border-b border-black @endif">
                <i class="fa-solid fa-compass text-xl"></i>
                <p>Explore</p>
            </a>
            <a href="#" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-bell text-xl"></i>
                <p>Notification</p>
            </a>
            <a href="{{ route('post.saved') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-bookmark text-xl"></i>
                <p>Saved</p>
            </a>
            <a href="{{ route('posts.create') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500 @if(Request::is('posts/create')) border-b border-black @endif">
                <i class="fa-solid fa-arrow-up-from-bracket text-xl"></i>
                <p>Post</p>
            </a>
        </div>

        <div class="absolute bottom-10 left-6 w-full"> {{-- Sesuaikan posisi ini dengan layout Anda --}}
            <a href="{{ route('my-profile') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500 @if(Request::is('profile')) border-b border-black @endif">
                <i class="fa-solid fa-user-circle text-xl"></i> {{-- Icon untuk Profile, Anda bisa ganti --}}
                <p>Profile</p>
            </a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto py-32 container">
        <h1 class="text-6xl hero-title font-bold mb-4 text-center">{{ $post->title }}</h1>
        <div class="flex items-center gap-2 mt-3 mb-5 justify-center">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="w-8 h-8 rounded-full">
            <span class="font-bold">{{ Auth::user()->name }}</span>
        </div>
        <!-- Tombol Save -->
        <div class="flex ml-auto">
            <form method="POST" action="{{ route('posts.save', $post->id) }}" class="my-5 ml-auto">
                @csrf
                <button class="border border-black hover:border-blue-600 text-black py-2 px-4 rounded-full"><i class="fa-regular fa-bookmark"></i></button>
            </form>
        </div>
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="mb-4 w-full">
        <h2 class="text-3xl font-semibold mb-2 text-gray-900">Description</h2>
        <p class="border-t border-dashed w-full">{{ $post->description }}</p>
    </div>

    <footer class="w-5/6 absolute right-0 bg-white border-t border-dashed border-gray-300 text-sm text-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
            <div>
            <h1 class="text-2xl font-semibold hero-title">vargazs.</h1>
            </div>
            <div>
            <ul class="space-y-1">
                <li>Website</li>
                <li>Inspiration</li>
                <li>Elements</li>
            </ul>
            </div>
            <div>
            <ul class="space-y-1">
                <li>Home</li>
                <li>Explore</li>
                <li>Notification</li>
            </ul>
            </div>
            <div>
            <ul class="space-y-1">
                <li>Saved</li>
                <li>Upload</li>
            </ul>
            </div>
            <div>
            <ul class="space-y-1">
                <li>FAQs</li>
                <li>About Us</li>
                <li>Contact Us</li>
            </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center py-5 border-t border-dashed border-gray-300 text-xs text-gray-600">
            <p>© Copyright 2050</p>
            <div class="flex items-center gap-6 mt-2 md:mt-0">
            <div class="bg-gray-100 px-4 py-2 rounded text-gray-800 text-sm">Jakarta, Indonesia</div>
            <div class="flex items-center gap-2">
                <span class="font-semibold text-black">Connect:</span>
                <a href="#" class="hover:underline">Instagram</a>
                <a href="https://youtu.be/dQw4w9WgXcQ?si=KokLdieVsfaUm4nz" class="hover:underline">Youtube</a>
                <a href="#" class="hover:underline">Linkedin</a>
            </div>
            </div>
        </div>
    </footer>
</body>
</html>
