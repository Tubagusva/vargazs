<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vargazs - New Post</title>
    <link rel="stylesheet" href="style.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        /* Custom CSS minimal untuk properti yang tidak langsung tersedia di Tailwind atau untuk readability */
        textarea {
            resize: vertical; /* Tailwind tidak memiliki kelas langsung untuk ini */
        }

        /* Kelas untuk highlight area drag-and-drop */
        .drop-area.highlight {
            border-color: #2563eb; /* Biru */
            background-color: #eff6ff; /* Biru muda */
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    {{-- Placeholder untuk Navbar --}}
    <nav class="fixed flex justify-center w-full pb-3 pt-9 gap-7 bg-white z-50">
        <div class="ml-56 w-full max-w-5xl relative flex">
            <span class="absolute left-4 top-3 text-lg text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" class="w-full border border-gray-400 pl-12 py-3 pr-3 rounded focus:outline-none" placeholder="Search">
        </div>
        <div class="flex items-center gap-4">
            @auth
                <span class="font-semibold text-gray-600">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 px-5 py-3 rounded-md text-white transition-all duration-300 hover:bg-transparent hover:text-red-500 hover:border-red-500 border border-red-500">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 px-5 py-3 rounded-md text-white transition-all duration-300 hover:bg-transparent hover:text-blue-500 hover:border-blue-500 border">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-5 py-3 rounded-md text-black transition-all duration-300 hover:bg-gray-200">Sign Up</a>
                @endif
            @endauth
        </div>
    </nav>

    {{-- Left Bar --}}
    <div class="fixed top-0 left-0 z-50 h-screen border-r border-gray-400 w-1/6 px-6 py-4 bg-white "> 
        <p class="hero-title flex justify-center pt-7 font-bold text-3xl">vargazs</p>

        <div class="mt-16">
            <a href="{{ url('/dashboard') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-house text-xl"></i>
                <p>Home</p>
            </a>
            <a href="{{ route('explore') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-compass text-xl"></i>
                <p>Explore</p>
            </a>
            <a href="{{ route('notifications') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-bell text-xl"></i>
                <p>Notification</p>
            </a>
            <a href="{{ route('post.saved') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-bookmark text-xl"></i>
                <p>Saved</p>
            </a>
            <a href="{{ route('posts.create') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500">
                <i class="fa-solid fa-arrow-up-from-bracket text-xl"></i>
                <p class="border-b border-black transition-all duration-300 hover:border-gray-500">Post</p>
            </a>
        </div>

        <div class="absolute bottom-10 left-6 w-full"> {{-- Sesuaikan posisi ini dengan layout Anda --}}
            <a href="{{ route('my-profile') }}" class="flex items-center justify-start gap-3 mb-11 ml-20 text-lg transition-all duration-300 hover:text-gray-500 @if(Request::is('profile')) border-b border-black @endif">
                <i class="fa-solid fa-user-circle text-xl"></i> {{-- Icon untuk Profile, Anda bisa ganti --}}
                <p>Profile</p>
            </a>
        </div>
    </div>


    <div class="flex-grow pt-20 pb-20 ml-64 flex justify-center items-start"> {{-- Sesuaikan padding-top dengan tinggi navbar, dan margin-left dengan lebar left bar --}}
        <div class="w-full max-w-2xl px-6 py-8 bg-white rounded-lg">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">New Post</h1>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md border border-red-400">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Area Drag and Drop --}}
                <div class="w-full h-64 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer bg-gray-50 transition-colors duration-300" id="drop-area">
                    <i class="fa-solid fa-cloud-arrow-up text-5xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500 text-lg">Choose Your Files</p>
                </div>
                <input type="file" id="image" name="image" class="hidden" accept="image/*">
                <div id="file-preview-container" class="mt-4 text-center"></div>
                <p class="text-xs text-gray-500 text-center">Accepted formats: JPG, PNG, GIF, SVG. Max size: 2MB.</p>

                {{-- Judul --}}
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Add New Title" class="w-full px-4 py-3 border border-gray-300 rounded-md bg-gray-50 text-gray-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="5" placeholder="Add Description" class="w-full px-4 py-3 border border-gray-300 rounded-md bg-gray-50 text-gray-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"></textarea>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="window.location.href='{{ route('posts.index') }}'" class="px-6 py-3 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition-colors duration-200">Cancel</button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors duration-200">Post</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="w-5/6 ml-auto bg-white border-t border-dashed border-gray-300 text-sm text-gray-700">
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

    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('image');
        const filePreviewContainer = document.getElementById('file-preview-container');

        // Memicu klik pada input file tersembunyi saat drop area diklik
        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Menangani perubahan pada input file tersembunyi
        fileInput.addEventListener('change', handleFiles);

        // Highlight drop area on drag over/leave
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.add('highlight'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.remove('highlight'), false);
        });

        // Prevent default browser behavior for drag events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles({ target: { files: files } });
        }

        function handleFiles(event) {
            filePreviewContainer.innerHTML = ''; // Clear previous preview
            const files = event.target.files;

            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onloadend = function () {
                        let img = document.createElement('img');
                        img.src = reader.result;
                        img.classList.add('max-w-full', 'max-h-40', 'rounded-md', 'object-contain', 'border', 'border-gray-200', 'mx-auto', 'block'); // Added mx-auto block for centering
                        filePreviewContainer.appendChild(img);
                    }
                    reader.readAsDataURL(file);

                    // Crucial: Set the file to the hidden input's files property
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;

                } else {
                    alert('Please select an image file.');
                    fileInput.value = ''; // Reset file input
                    filePreviewContainer.innerHTML = ''; // Clear preview
                }
            } else {
                fileInput.value = ''; // Clear input if no file
                filePreviewContainer.innerHTML = ''; // Clear preview
            }
        }
    </script>
</body>
</html>