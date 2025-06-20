@props(['galleries'])
<h1 class="text-2xl font-bold sm:text-3xl lg:text-4xl text-center mb-9">Gallery Donasi</h1>

@if ($galleries->isEmpty())
    <p class="text-center text-gray-500">Belum ada dokumentasi galeri.</p>
@else
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        {{-- Membagi galeri menjadi 4 kolom --}}
        @foreach ($galleries->chunk(ceil($galleries->count() / 4)) as $chunk)
            <div class="grid gap-4">
                @foreach ($chunk as $gallery)
                    <div>
                        <a href="{{ asset('storage/' . $gallery->image) }}" data-fancybox="gallery"
                            data-caption="{{ $gallery->title }}">
                            <img class="h-auto max-w-full rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300"
                                src="{{ asset('storage/' . $gallery->image) }}"
                                alt="{{ $gallery->title ?? 'Gambar Galeri' }}">
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endif
