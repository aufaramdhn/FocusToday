<x-layout-admin>
    <x-slot:title>
        Admin Tambah artikel
    </x-slot:title>

    <div class="">
        <h1 class="text-3xl font-bold mb-3">Add Article</h1>

        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => '/dashboard'],
            ['label' => 'Articles', 'url' => '/dashboard/artikel'],
            ['label' => 'Detail Article', 'url' => '/dashboard/artikel/' . $article->slug],
        ]" />

        <div class="bg-white rounded-lg shadow-md w-full p-6 mt-6">
            <h2 class="text-2xl font-semibold mb-2">{{ $article->title }}</h2>
            <span class="text-md text-gray-600 italic mb-2">Category: {{ $article->category->name }}</span>
            <p class="text-gray-600 mb-2">By: {{ $article->author->name }} | Category: {{ $article->category->name }} |
                Published at: {{ $article->created_at->format('d M Y - H:i') }}</p>
            @foreach ($article->tags as $tag)
                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-md inline-block mb-4">
                    {{ $tag->name }}</span>
            @endforeach
            <img class="rounded-md shadow-xs w-[65%] object-cover mx-auto mb-4" src="{{ $article->thumbnail_url }}"
                alt="{{ $article->title }}" />
            <div class="prose max-w-none text-gray-800 leading-relaxed">
                @foreach ($article->blocks as $block)
                    @if ($block->type === 'text')
                        <div class="mb-4">
                            {!! $block->content !!}
                        </div>
                    @elseif ($block->type === 'image' && $block->media_path)
                        <figure class="my-8">
                            <img src="{{ $block->media_url }}" class="w-[40%] h-auto rounded-lg shadow-sm mx-auto"
                                alt="Article Image" />
                        </figure>
                    @endif
                @endforeach
            </div>
            <div class="border-t border-gray-200 pt-8 mt-4">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Komentar</h3>

                <form action="{{ route('admin.comments.store') }}" method="POST"
                    class="bg-gray-50 p-4 rounded-lg mb-6">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <textarea
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                        rows="3" placeholder="Tulis Komentar" name="content"></textarea>
                    <div class="flex justify-end mt-3">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Kirim
                        </button>
                    </div>
                </form>

                @if ($article->comments->isEmpty())
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-200 rounded-full mb-4">
                            <x-ri-chat-1-line class="w-10 h-10 text-gray-400" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-700 mb-2">Belum ada komentar</h4>
                        <p class="text-sm text-gray-500">Jadilah yang pertama berkomentar di sini</p>
                    </div>
                @else
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Komentar ({{ $article->comments->count() }})
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
                                                <h5 class="text-sm font-bold text-gray-900">{{ $comment->user->name }}
                                                </h5>
                                                <p class="text-xs text-gray-500">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </p>
                                            </div>

                                            {{-- @if (auth()->id() === $comment->user_id || auth()->user()->role === 'admin') --}}
                                            <div class="relative">
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

                                                    {{-- @if (auth()->id() === $comment->user_id) --}}
                                                    <button type="button"
                                                        @click="isEditing = true; openDropdown = false"
                                                        class="w-full text-left px-4 py-2 text-xs text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                                        <x-ri-pencil-line class="w-3.5 h-3.5 text-yellow-500" />
                                                        Edit
                                                    </button>
                                                    {{-- @endif --}}

                                                    <button
                                                        @click="open = false; confirmAction(
                                                            '{{ route('admin.comments.destroy', $comment->id) }}',
                                                            'DELETE',
                                                            'Delete Comment',
                                                            'Are you sure you want to delete this comment? This action cannot be undone.',
                                                            'danger',
                                                            'Yes, Delete'
                                                        )"
                                                        class="w-full text-left px-4 py-2 text-xs text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                                        <x-ri-delete-bin-6-line class="w-3.5 h-3.5 text-red-500" />
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                            {{-- @endif --}}
                                        </div>

                                        <div x-show="!isEditing" class="mt-2">
                                            <p class="text-sm text-gray-700 leading-relaxed" x-text="content"></p>
                                        </div>

                                        <div x-show="isEditing" style="display: none;" class="mt-3">
                                            <form action="{{ route('admin.comments.update', $comment->id) }}"
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
</x-layout-admin>
