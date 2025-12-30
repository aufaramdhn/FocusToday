<x-sidebar-profile>
    <x-slot:title>
        Profil - FocusToday
    </x-slot:title>
    <x-slot:headerProfile>
        Edit Artikel
    </x-slot:headerProfile>

    <div class="w-full mt-6">
        <form class="flex flex-col gap-4" method="POST" action="{{ route('profile.artikel.update', $article->id) }}"
            enctype="multipart/form-data" x-data="articleBlocks({{ $article->blocks->map(function ($block) {
                return [
                    'type' => $block->type,
                    'content' => $block->content,
                    'media_path' => $block->media_path,
                    'previewUrl' => null,
                ];
            }) }})">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-2">
                <label class="font-medium">Article Title</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}"
                    class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2" placeholder="Enter article title">
            </div>
            @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div class="flex flex-col gap-2">
                <label class="font-medium">Categories</label>
                <select class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2" name="category_id">
                    <option disabled>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <div class="">
                <label class="font-medium block mb-2">Tags</label>
                <div class="flex gap-4 mt-2 flex-wrap p-3 border rounded-md bg-gray-50 border-gray-200">
                    @foreach ($tags as $tag)
                        <div class="flex items-center mr-4 mb-2">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                id="tag-{{ $tag->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                                {{ in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label for="tag-{{ $tag->id }}"
                                class="ml-2 text-sm font-medium text-gray-900 cursor-pointer">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('tags')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <input type="hidden" name="status" value="{{ $article->status }}">
            <div class="flex flex-col gap-2" x-data="thumbnailPreview('{{ $article->thumbnail_url }}')">
                <label class="font-medium">Cover Image (Thumbnail)</label>
                <div x-show="previewUrl" class="relative w-fit group">
                    <img :src="previewUrl"
                        class="h-48 w-auto object-cover rounded-md border border-gray-300 shadow-sm"
                        alt="Thumbnail Preview">
                    <button type="button" @click="removePreview()"
                        class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition shadow-md hover:bg-red-600"
                        title="Hapus Thumbnail">
                        <x-ri-close-line class="w-4 h-4" />
                    </button>
                </div>
                <input type="file" name="thumbnail" accept="image/*" id="thumbnail-input"
                    @change="updatePreview($event)"
                    class="file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100 cursor-pointer border rounded-md border-gray-300 w-full text-sm text-gray-500">
            </div>
            @error('thumbnail')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <div class="flex flex-col gap-2">
                <label class="font-medium">Article Content</label>
                <template x-for="(block, index) in blocks" :key="index">
                    <div class="border rounded-md border-gray-300/90 shadow-xs p-3 bg-white mb-4">
                        <input type="hidden" x-bind:name="'blocks[' + index + '][type]'" x-bind:value="block.type">

                        <div x-show="block.type === 'text'">
                            <input type="hidden" x-bind:name="'blocks[' + index + '][content]'"
                                x-bind:value="block.content">
                            <div :id="'editor-' + index" class="bg-white h-40" x-init="initEditor(index)"></div>
                        </div>

                        <div x-show="block.type === 'image'" class="flex flex-col gap-2">
                            <div x-show="!block.previewUrl && !block.media_path">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Upload Gambar</label>
                                <input type="file" x-bind:name="'blocks[' + index + '][image]'" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border rounded-md border-gray-300"
                                    @change="handleImageUpload($event, index)">
                            </div>

                            <div x-show="block.previewUrl || block.media_path" class="relative group w-fit">
                                <img :src="block.previewUrl || getImageUrl(block.media_path)"
                                    class="h-48 w-auto object-cover rounded-md border shadow-sm">

                                <button type="button" @click="removeImage(index)"
                                    class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition">
                                    <x-ri-close-line class="w-4 h-4" />
                                </button>
                            </div>

                            <input type="hidden" x-bind:name="'blocks[' + index + '][existing_media_path]'"
                                :value="block.media_path">
                        </div>

                        <button type="button" class="text-red-500 text-sm mt-2" @click="removeBlock(index)">
                            Delete Block
                        </button>
                    </div>
                </template>
                @error('blocks')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <div class="flex gap-2">
                    <button type="button"
                        class="bg-gray-200 rounded-md px-4 py-2 hover:bg-gray-300 text-sm md:text-md cursor-pointer"
                        @click="addText">
                        + Paragraph
                    </button>
                    <button type="button"
                        class="bg-gray-200 rounded-md px-4 py-2 hover:bg-gray-300 text-sm md:text-md cursor-pointer"
                        @click="addImage">
                        + Image
                    </button>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <a href="/profile/artikel"
                    class="mr-4 bg-red-500 text-white rounded-md px-6 py-2 hover:bg-red-600 transition duration-300 text-sm">Cancel</a>
                <button type="submit"
                    class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm cursor-pointer">
                    Update Article
                </button>
            </div>
        </form>
    </div>
</x-sidebar-profile>
