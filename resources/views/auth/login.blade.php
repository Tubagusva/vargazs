<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vargazs - Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-xl shadow-lg w-full max-w-5xl flex overflow-hidden">
        
        <div class="w-1/2 bg-gray-100 flex flex-col items-center justify-center p-10">
            
            <div class="flex items-center space-x-4 mt-8">
                <span class="text-6xl font-bold hero-title">V<span class="text-4xl align-super"></span></span>
                <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-blue-500 to-purple-500 flex items-center justify-center">
                    <div class="text-4xl">😊</div> </div>
            </div>

            <p class="mt-5 text-sm text-gray-700">
                Not a member yet? <a href="{{ route('register') }}" class="font-semibold underline text-black">Register now</a>
            </p>
        </div>

        <div class="w-1/2 bg-white p-10">
            <h2 class="text-xl text-black font-semibold mb-6">Login</h2>
            
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="font-medium text-red-600">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="E-mail" class="w-full border-b border-gray-300 focus:outline-none py-2 px-3 focus:border-blue-500">
                
                <div class="flex space-x-4">
                    <input type="password" name="password" required autocomplete="current-password" placeholder="Password" class="w-full border-b border-gray-300 focus:outline-none py-2 px-3 focus:border-blue-500">
                </div>

                <div class="text-xs text-gray-500">
                    Awwwards may keep me informed with personalized emails about products and services. See our <a href="#" class="font-medium text-black hover:underline">Privacy Policy</a> for more details.
                </div>

                <div class="space-y-2 text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"> Remember me
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif

                <p class="text-xs text-gray-400">
                    This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
                </p>

                <button type="submit" class="w-full bg-black text-white py-3 rounded-md mt-4 hover:bg-gray-800">Login</button>
            </form>

            <div class="mt-6 text-sm text-center">
                Or login with
                <div class="flex justify-center space-x-4 mt-3">
                    <button class="border px-4 py-2 rounded-md flex items-center space-x-2">
                        <i class="fa-brands fa-google text-gray-600"></i><span>Google</span>
                    </button>
                    <button class="border px-4 py-2 rounded-md flex items-center space-x-2">
                        <i class="fa-brands fa-x-twitter text-gray-600"></i><span>Twitter</span>
                    </button>
                    <button class="border px-4 py-2 rounded-md flex items-center space-x-2">
                        <i class="fa-brands fa-facebook text-gray-600"></i><span>Facebook</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>