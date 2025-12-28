<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
</head>

<body class="bg-gray-100 admin" x-data="{
    sidebarOpen: false,
    isDesktop: window.innerWidth >= 768,
    showModal: false,
    showModal: false,
    modalUrl: '',
    modalMethod: 'POST',
    modalTitle: '',
    modalMessage: '',
    modalType: '',
    modalButtonText: '',
    confirmAction(url, method, title, message, type, btnText) {
        this.modalUrl = url;
        this.modalMethod = method;
        this.modalTitle = title;
        this.modalMessage = message;
        this.modalType = type;
        this.modalButtonText = btnText;
        this.showModal = true;
    }
}" @resize.window="isDesktop = window.innerWidth >= 768">

    {{ $slot }}

    <x-confirm-modal />

    <script>
        window.thumbnailPreview = function(existingUrl = '') {
            return {
                previewUrl: existingUrl,

                updatePreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran file terlalu besar! Maksimal 2MB.');
                            event.target.value = '';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.previewUrl = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                removePreview() {
                    this.previewUrl = '';
                    const input = document.getElementById('thumbnail-input');
                    if (input) input.value = '';
                }
            }
        }

        window.avatarPreview = function(existingUrl = '') {
            return {
                previewUrl: existingUrl,

                updatePreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran foto profil terlalu besar! Maksimal 2MB.');
                            event.target.value = '';
                            return;
                        }
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.previewUrl = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                removePreview() {
                    this.previewUrl = '';
                    const input = document.getElementById('avatar-input');
                    if (input) input.value = '';
                }
            }
        }

        window.articleBlocks = function(initialBlocks = []) {
            return {
                blocks: Array.isArray(initialBlocks) ? initialBlocks : [],

                getImageUrl(path) {
                    if (!path) return '';
                    if (path.startsWith('http') || path.startsWith('data:')) {
                        return path;
                    }
                    return '/storage/' + path;
                },

                addText() {
                    this.blocks.push({
                        type: 'text',
                        content: ''
                    });
                },

                addImage() {
                    this.blocks.push({
                        type: 'image',
                        content: '',
                        media_path: null,
                        previewUrl: null
                    });
                },

                removeBlock(index) {
                    this.blocks.splice(index, 1);
                },

                initEditor(index) {
                    if (typeof Quill === 'undefined') {
                        console.error('Quill JS belum di-load!');
                        return;
                    }

                    this.$nextTick(() => {
                        const id = `editor-${index}`;
                        const element = document.getElementById(id);

                        if (!element || element.classList.contains('ql-container')) return;

                        var quill = new Quill(`#${id}`, {
                            theme: 'snow',
                            placeholder: 'Tulis konten artikel di sini...',
                            modules: {
                                toolbar: [
                                    ['bold', 'italic', 'underline'],
                                    [{
                                        'list': 'ordered'
                                    }, {
                                        'list': 'bullet'
                                    }],
                                    ['link', 'clean']
                                ]
                            }
                        });

                        if (this.blocks[index] && this.blocks[index].content) {
                            quill.root.innerHTML = this.blocks[index].content;
                        }

                        quill.on('text-change', () => {
                            if (this.blocks[index]) {
                                this.blocks[index].content = quill.root.innerHTML;
                            }
                        });
                    });
                },

                handleImageUpload(event, index) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.size > 5 * 1024 * 1024) {
                            alert('Gambar terlalu besar (Max 5MB)');
                            event.target.value = '';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.blocks[index].previewUrl = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                removeImage(index) {
                    this.blocks[index].previewUrl = null;
                    this.blocks[index].media_path = null;
                    setTimeout(() => {
                        const inputs = document.querySelectorAll(`input[name="blocks[${index}][image]"]`);
                        if (inputs.length > 0) inputs[0].value = '';
                    }, 50);
                }
            }
        }
    </script>
</body>

</html>
