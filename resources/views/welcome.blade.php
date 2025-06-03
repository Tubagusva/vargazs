<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vargazs</title>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navbar -->
    <nav class="fixed flex justify-between xl:justify-center w-full pb-3 pt-6 px-4 xl:px-0 gap-4 bg-white flex-wrap xl:flex-nowrap z-40">
        <a href="" class="mt-2 ml-5 block xl:hidden" id="menu-toggle">
            <i class="fa-solid fa-bars text-2xl"></i>
        </a>
        <!-- Search Bar -->
        <div class="hidden xl:flex xl:ml-56 xl:w-full xl:max-w-5xl xl:relative">
            <span class="absolute left-4 top-3 text-lg text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" class="w-full border border-gray-400 pl-12 py-3 pr-3 rounded focus:outline-none" placeholder="Search">
        </div>

        <!-- Login & Sign Up -->
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ url('dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 px-5 py-3 rounded-md text-white transition-all duration-300 hover:bg-transparent hover:text-blue-500 hover:border-blue-500 border">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-5 py-3 rounded-md text-black transition-all duration-300 hover:bg-gray-200">Sign Up</a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Left Bar -->
    <div class="xl:block hidden xl:fixed xl:top-0 xl:left-0 xl:z-50 xl:h-screen xl:border-r xl:border-gray-400 xl:w-1/6 xl:px-6 xl:py-4 xl:bg-white">
        <!-- Website Icon -->
        <p class="hero-title flex justify-center pt-7 font-bold text-3xl">vargazs</p>

        <!-- Bar -->
        <div class="mt-16">
            <a href="#" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-house text-xl"></i>
                <p class="border-b border-black transition-all duration-300 hover:border-gray-500">Home</p>
            </a>
            <a href="#" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-compass text-xl"></i>
                <p>Explore</p>
            </a>
            <a href="#" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-bell text-xl"></i>
                <p>Notification</p>
            </a>
            <a href="#" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-bookmark text-xl"></i>
                <p>Saved</p>
            </a>
            <a href="#" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-arrow-up-from-bracket text-xl"></i>
                <p>Post</p>
            </a>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-white pt-96 xl:pt-96 pl-6 xl:pl-32">
        <div class="container mx-auto text-center">
            <p class="text-sm text-black font-semibold tracking-wider mb-2">Find Your <span class="bg-blue-500 text-white rounded-full px-2 py-1">Inspiration</span></p>
            <h1 class="hero-title text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold text-gray-800 mb-8">
                Welcome <br> to <span class="italic">Vargazs.</span>
            </h1>
            <a href="{{ route('login') }}" class="border border-black rounded-full py-3 px-8 font-semibold hover:bg-black hover:text-white transition-colors duration-300">
                Get Started
                <i class="fa-solid fa-arrow-right ml-2 bg-blue-500 text-white rounded-full p-2 align-middle"></i>
            </a>
        </div>
    </section>
</body>
</html>
