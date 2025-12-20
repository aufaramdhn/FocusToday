<x-layout-admin>
    <x-slot:title>
        Admin Tambah artikel
    </x-slot:title>

    <div class="">
        <h1 class="text-3xl font-bold mb-3">Tambah Artikel</h1>

        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => '/dashboard'],
            ['label' => 'Artikel', 'url' => '/dashboard/artikel'],
            ['label' => 'Tambah Artikel', 'url' => '/dashboard/artikel/tambah'],
        ]" />

        <div class="bg-white rounded-lg shadow-md w-full p-6 mt-6">
            <form class="flex flex-col gap-4" x-data="articleBlocks()">

                <div class="flex flex-col gap-2">
                    <label class="font-medium">Judul Artikel</label>
                    <input type="text" name="title" class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Masukkan judul artikel">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="font-medium">Kategori</label>
                    <select class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2">
                        <option>Pilih Kategori</option>
                        <option>Teknologi</option>
                        <option>Politik</option>
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="font-medium">Konten Artikel</label>

                    <template x-for="(block, index) in blocks" :key="index">
                        <div class="border rounded-md border-gray-300/90 shadow-xs p-3 bg-white">

                            <div x-show="block.type === 'text'">
                                <div :id="'editor-' + index" class="bg-white"></div>
                            </div>


                            <div x-show="block.type === 'image'" class="flex flex-col gap-2">
                                <input type="file"
                                    class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2 cursor-pointer">
                            </div>

                            <button type="button" class="text-red-500 text-sm mt-2" @click="removeBlock(index)">
                                Hapus
                            </button>
                        </div>
                    </template>

                    <div class="flex gap-2">
                        <button type="button"
                            class="bg-gray-200 rounded-md px-4 py-2 hover:bg-gray-300 text-sm md:text-md cursor-pointer"
                            @click="addText">
                            + Paragraf
                        </button>

                        <button type="button"
                            class="bg-gray-200 rounded-md px-4 py-2 hover:bg-gray-300 text-sm md:text-md cursor-pointer"
                            @click="addImage">
                            + Gambar
                        </button>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <a href="/dashboard/artikel"
                        class="mr-4 bg-red-500 text-white rounded-md px-6 py-2 hover:bg-red-600 transition duration-300 text-sm md:text-lg">Batal</a>
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm md:text-lg cursor-pointer">
                        Simpan Artikel
                    </button>
                </div>
            </form>

        </div>

        <script>
            function articleBlocks() {
                return {
                    blocks: [],
                    editors: [],

                    addText() {
                        const index = this.blocks.length;
                        this.blocks.push({
                            type: 'text',
                            content: ''
                        });

                        this.$nextTick(() => {
                            const quill = new Quill('#editor-' + index, {
                                theme: 'snow',
                                placeholder: 'Tulis paragraf...'
                            });

                            quill.on('text-change', () => {
                                this.blocks[index].content = quill.root.innerHTML;
                            });

                            this.editors.push(quill);
                        });
                    },

                    addImage() {
                        this.blocks.push({
                            type: 'image',
                            file: null
                        });
                    },

                    removeBlock(index) {
                        this.blocks.splice(index, 1);
                    }
                }
            }
        </script>
</x-layout-admin>
