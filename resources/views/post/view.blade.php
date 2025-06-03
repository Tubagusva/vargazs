<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <img src="{{ asset('storage/' . $post->image) }}" class="rounded-xl w-full mb-4">

        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
        <p class="text-gray-700 mt-2">{{ $post->description }}</p>

        <div class="mt-6">
            @if(!$saved)
                <form action="{{ route('post.save', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        💾 Simpan
                    </button>
                </form>
            @else
                <span class="text-green-600 font-semibold">✔️ Sudah Disimpan</span>
            @endif
        </div>
    </div>
</x-app-layout>