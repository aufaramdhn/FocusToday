<x-layout-user>
    <x-slot:title>Detail Berita - FokusToday</x-slot:title>
    <div class="max-w-full mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-8">
            <div class="flex flex-col gap-6">
                <div class="border-b border-gray-200 pb-6">
                    <span class="inline-block px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded-full mb-4">
                        {{ $article->category->name }}
                    </span>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $article->title }}
                    </h1>

                    <div class="flex items-center gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <img src="{{ $article->author->avatar_url }}" alt="User Avatar"
                                class="w-10 h-10 rounded-full object-cover" alt="Author">
                            <div>
                                <span class="font-semibold text-gray-900">{{ $article->author->name }}</span>
                                <span class="text-gray-400 mx-2">|</span>
                                <span>{{ $article->author->role }}</span>
                            </div>
                        </div>
                        <span class="text-gray-400">•</span>
                        <span>{{ $article->published_at?->format('d F Y') ?? 'Draft' }}</span>
                    </div>
                </div>

                <div>
                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                        class="w-full h-[400px] object-cover rounded-lg">
                </div>

                <article class="prose prose-lg max-w-none text-gray-800 leading-relaxed">

                    @foreach ($article->blocks as $block)
                        @switch($block->type)
                            @case('text')
                                <div class="mb-4">
                                    {!! $block->content !!}
                                </div>
                            @break

                            @case('heading')
                                <h3 class="text-2xl font-bold text-gray-900 mt-8 mb-4">
                                    {{ $block->content }}
                                </h3>
                            @break

                            @case('image')
                                <figure class="my-8 text-center">
                                    <img src="{{ $block->media_url }}"
                                        class="w-full md:w-[60%] h-auto rounded-lg shadow-sm mx-auto" alt="Article Image" />

                                    @if ($block->content)
                                        <figcaption class="text-sm text-gray-500 mt-2 italic">
                                            {{ $block->content }}
                                        </figcaption>
                                    @endif
                                </figure>
                            @break

                            @case('quote')
                                <blockquote
                                    class="border-l-4 border-blue-500 pl-4 italic text-gray-700 my-6 bg-gray-50 py-2 rounded-r">
                                    "{{ $block->content }}"
                                </blockquote>
                            @break
                        @endswitch
                    @endforeach
                </article>

                <div class="flex flex-wrap gap-2 py-4 mt-6 border-t border-gray-100">
                    <span class="text-sm font-semibold text-gray-700 items-center flex">Tags:</span>

                    @forelse($article->tags as $tag)
                        <a href="#"
                            class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-gray-200 transition">
                            {{ $tag->name }}
                        </a>
                    @empty
                        <span class="text-gray-400 text-sm italic">Tidak ada tags</span>
                    @endforelse
                </div>

                @if ($recommendations->count() > 0)
                    <div class="border-t border-gray-200 pt-8 mt-12">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Rekomendasi untuk Anda</h3>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                            @foreach ($recommendations as $rec)
                                <a href="{{ route('articles.show', $rec->slug) }}" class="group block">

                                    <div class="bg-gray-200 h-[100px] rounded-lg mb-2 overflow-hidden relative">
                                        <img src="{{ $rec->thumbnail_url }}" alt="{{ $rec->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>

                                    <h4
                                        class="text-sm font-semibold text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $rec->title }}
                                    </h4>

                                    <span class="text-xs text-gray-500 mt-1 block">
                                        {{ $rec->category->name ?? '' }}
                                    </span>
                                </a>
                            @endforeach

                        </div>
                    </div>
                @endif

                <div class="border-t border-gray-200 pt-8 mt-4" id="kolom-komentar">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Komentar</h3>

                    <form action="{{ route('artikel.comment.store') }}" method="POST"
                        class="bg-gray-50 p-4 rounded-lg mb-6">
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $article->id }}">

                        <textarea
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                            rows="3" placeholder="Tulis pendapat Anda tentang artikel ini..." name="content" required></textarea>

                        <div class="flex justify-end mt-3">
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors text-sm">
                                Kirim Komentar
                            </button>
                        </div>
                    </form>

                    @if ($article->comments->isEmpty())
                        <div class="text-center py-12">
                            <div
                                class="inline-flex items-center justify-center w-20 h-20 bg-gray-200 rounded-full mb-4">
                                <x-ri-chat-1-line class="w-10 h-10 text-gray-400" />
                            </div>
                            <h4 class="text-lg font-semibold text-gray-700 mb-2">Belum ada komentar</h4>
                            <p class="text-sm text-gray-500">Jadilah yang pertama berkomentar di sini</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Komentar
                                ({{ $article->comments->count() }})
                            </h3>

                            @foreach ($article->comments as $comment)
                                <div class="p-4 bg-white rounded-lg border border-gray-100 shadow-sm"
                                    x-data="{
                                        isEditing: false,
                                        openDropdown: false,
                                        content: '{{ $comment->content }}',
                                        originalContent: '{{ $comment->content }}'
                                    
                                    }">

                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-9 h-9 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold shrink-0 text-sm uppercase">
                                            {{ substr($comment->user->name, 0, 2) }}
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h5 class="text-sm font-bold text-gray-900">
                                                        {{ $comment->user->name }}
                                                    </h5>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </p>
                                                </div>

                                                @if (auth()->check() && (auth()->id() == $comment->user_id || auth()->user()->role == 'admin'))
                                                    <div class="relative" x-data="{ openDropdown: false, isEditing: false }">
                                                        <button @click="openDropdown = !openDropdown"
                                                            class="text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-100 transition">
                                                            <x-ri-more-fill class="w-5 h-5" />
                                                        </button>

                                                        <div x-show="openDropdown" @click.outside="openDropdown = false"
                                                            x-transition:enter="transition ease-out duration-100"
                                                            x-transition:enter-start="transform opacity-0 scale-95"
                                                            x-transition:enter-end="transform opacity-100 scale-100"
                                                            x-transition:leave="transition ease-in duration-75"
                                                            class="absolute right-0 mt-1 w-32 bg-white rounded-md shadow-lg border border-gray-100 z-10 py-1"
                                                            style="display: none;">

                                                            @if (auth()->id() == $comment->user_id)
                                                                <button type="button"
                                                                    @click="isEditing = true; openDropdown = false"
                                                                    class="w-full text-left px-4 py-2 text-xs text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                                                    <x-ri-pencil-line
                                                                        class="w-3.5 h-3.5 text-yellow-500" />
                                                                    Edit
                                                                </button>
                                                            @endif

                                                            <button
                                                                @click="open = false; confirmAction(
                                                            '{{ route('artikel.comment.destroy', $comment->id) }}',
                                                            'DELETE',
                                                            'Delete Comment',
                                                            'Are you sure you want to delete this comment? This action cannot be undone.',
                                                            'danger',
                                                            'Yes, Delete'
                                                        )"
                                                                class="w-full text-left px-4 py-2 text-xs text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                                                <x-ri-delete-bin-6-line
                                                                    class="w-3.5 h-3.5 text-red-500" />
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div x-show="!isEditing" class="mt-2">
                                                <p class="text-sm text-gray-700 leading-relaxed" x-text="content"></p>
                                            </div>

                                            <div x-show="isEditing" style="display: none;" class="mt-3">
                                                <form action="{{ route('artikel.comment.update', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <textarea name="content" x-model="content"
                                                        class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                                                        rows="3"></textarea>

                                                    <div class="flex gap-2 mt-2 justify-end">
                                                        <button type="button"
                                                            @click="isEditing = false; content = originalContent"
                                                            class="px-3 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded hover:bg-gray-200 transition">
                                                            Batal
                                                        </button>
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700 transition shadow-sm">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex flex-col gap-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                        Berita Terkait
                    </h3>
                    <div class="flex flex-col gap-4">
                        @forelse($related_articles as $related)
                            <a href="{{ route('profile.artikel.show', $related->slug) }}" class="group flex gap-3">
                                <img src="{{ $related->thumbnail_url }}"
                                    class="w-24 h-20 object-cover rounded-lg flex-shrink-0 bg-gray-100"
                                    alt="{{ $related->title }}">
                                <div>
                                    <h4
                                        class="font-semibold text-sm text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $related->title }}
                                    </h4>
                                    <span class="text-xs text-gray-500 mt-1 block">
                                        {{ $related->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500 italic">Belum ada berita terkait.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-user>
