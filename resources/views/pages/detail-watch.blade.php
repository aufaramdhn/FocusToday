<x-layout-user title="{{ $currentVideo['snippet']['title'] }}">

    <div class="max-w-full mx-auto pb-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">
                <div class="aspect-w-16 aspect-h-9 w-full bg-black rounded-lg overflow-hidden shadow-lg mb-6">
                    <iframe src="https://www.youtube.com/embed/{{ $currentVideo['id'] }}?autoplay=1&rel=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen class="w-full h-[400px] md:h-[500px]">
                    </iframe>
                </div>

                <h1 class="text-2xl font-bold text-gray-900 mb-2">
                    {{ $currentVideo['snippet']['title'] }}
                </h1>

                <div class="flex items-center gap-4 text-sm text-gray-500 mb-6 border-b border-gray-200 pb-4">
                    <span>
                        <x-ri-calendar-line class="inline w-4 h-4 mr-1" />
                        {{ \Carbon\Carbon::parse($currentVideo['snippet']['publishedAt'])->format('d M Y') }}
                    </span>
                    <span>
                        <x-ri-eye-line class="inline w-4 h-4 mr-1" />
                        {{ number_format($currentVideo['statistics']['viewCount']) }} Views
                    </span>
                </div>

                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                    {{ $currentVideo['snippet']['description'] }}
                </div>
            </div>

            <div class="lg:col-span-1">
                <h3 class="font-bold text-xl mb-4 text-gray-900">Video Terbaru Lainnya</h3>

                <div class="flex flex-col gap-4">
                    @foreach ($relatedVideos as $video)
                        @php
                            $sideId = data_get($video, 'id.videoId');
                            $sideTitle = data_get($video, 'snippet.title');
                            $sideThumb = data_get($video, 'snippet.thumbnails.medium.url');
                            $date = \Carbon\Carbon::parse(data_get($video, 'snippet.publishedAt'))->diffForHumans();
                        @endphp

                        {{-- Perhatikan href-nya mengarah ke route lokal, bukan youtube.com --}}
                        <a href="{{ route('video.show', $sideId) }}"
                            class="flex gap-3 group hover:bg-gray-50 p-2 rounded transition">

                            <div class="w-40 flex-shrink-0 relative">
                                <img src="{{ $sideThumb }}"
                                    class="w-full h-24 object-cover rounded shadow-sm group-hover:opacity-90">
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                    <x-ri-play-circle-fill class="w-8 h-8 text-white/80" />
                                </div>
                            </div>

                            <div class="flex-1">
                                <h4
                                    class="text-sm font-semibold text-gray-900 line-clamp-2 group-hover:text-blue-600 transition leading-snug">
                                    {!! $sideTitle !!}
                                </h4>
                                <p class="text-xs text-gray-500 mt-1">{{ $date }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</x-layout-user>
