@push('style')
<style>
    .thumbnailCard {
        background: #ddd;
        min-height: 200px;
    }

    .dropArea {
        max-width: 100%;
        height: 200px;
        padding: 25px;
        display: grid;
        background-color: #f7f9fe;
        place-items: center;
        text-align: center;
        font-family: sans-serif;
        font-weight: 500;
        font-size: 1.2rem;
        cursor: pointer;
        color: #ccc;
        border: 4px dashed #000;
        border-radius: 10px;
    }

    .dropArea.error {
        border: 2px solid red
    }

    .dropArea-over {
        border-style: solid;
    }

    .dropFile {
        display: none;
    }

    .dropArea-thumb {
        width: 100%;
        height: 100%;
        border-radius: 10px;
        overflow: hidden;
        background: #ccc;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
    }

    .dropArea-thumb::after {
        content: attr(data-label);
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 5px 0;
        color: white;
        background: rgba(0, 0, 0, .75);
        font-size: .9rem;
        text-align: center;
    }

    .thumb-card {
        display: grid;
        place-items: center;
        background: #ddd;
        height: 200px;
    }

    .thumb-card img {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        object-position: top;
    }
</style>
@endpush

<x-user :$jumlahPesan :$pesan :$pesanGrup>

    <x-slot:title>
        New file
    </x-slot>

    <div class="max-w-2xl py-5 lg:mx-auto">
        <form method="POST" action="/file" enctype="multipart/form-data" id="form">
            @csrf
            <div class="border-b border-gray-900/20 pb-2 mb-5">
                <h2 class="text-2xl font-medium leading-7 text-gray-900">Add a new file</h2>
            </div>

            <div class="dropArea @error('files') error animate-shake @enderror mb-4">
                <div class="dropText">
                    <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag
                        and drop the file</p>
                    @error('files')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <input type="file" name="files" id="files" class="dropFile">
            </div>

            <input type="hidden" name="return" value="{{ $return }}">

            <div class="mt-6">
                <x-partial.form.label for="judul_file" :value="__('Judul File')"></x-partial.form.label>

                <x-partial.form.input id="judul_file" type="text" name="judul_file" :error="$errors->get('judul_file')"
                    :value="old('judul_file')" autofocus></x-partial.form.input>
            </div>

            <div class="my-4">
                <p class="mb-2 block text-sm font-medium text-gray-900">Status File</p>
                <ul class="mb-4 grid grid-cols-1 gap-x-2 sm:grid-cols-2">
                    <li>
                        <input type="radio" id="status-1" name="status" value="private" class="peer hidden">
                        <label for="status-1"
                            class="@error('status') animate-shake @enderror inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-3 text-gray-900 hover:bg-gray-100 hover:text-gray-900 peer-checked:border-gray-600 peer-checked:text-gray-600">
                            <div class="block">
                                <div class="w-full text-base font-medium">Private</div>
                                <div class="mt-1 w-full text-xs text-gray-500">You're file is set to private in your
                                    personal account</div>
                            </div>
                            <svg class="ms-3 h-4 w-4 text-gray-500 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M1.933 10.909A4.357 4.357 0 0 1 1 9c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 19 9c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M2 17 18 1m-5 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="status-2" name="status" value="public" class="peer hidden" checked>
                        <label for="status-2"
                            class="@error('status') animate-shake @enderror inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-3 text-gray-900 hover:bg-gray-100 hover:text-gray-900 peer-checked:border-gray-600 peer-checked:text-gray-600">
                            <div class="block">
                                <div class="w-full text-base font-medium">Publlic</div>
                                <div class="mt-1 w-full text-xs text-gray-500">You're file is set to public in your
                                    personal account</div>
                            </div>
                            <svg class="ms-3 h-4 w-4 text-gray-500 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                </g>
                            </svg>
                        </label>
                    </li>
                </ul>
            </div>

            <x-partial.textarea name="deskripsi"></x-partial.textarea>

            <div class="mt-6 flex items-center justify-start gap-x-4">
                <div class="!w-max -mt-6">
                    <x-partial.primary-button onclick="process('add')">
                        add
                    </x-partial.primary-button>
                </div>
                <x-partial.secondary-button onclick="history.back()">
                    Cancel
                </x-partial.secondary-button>
            </div>
        </form>
    </div>

    @push('script')
<script src="{{ asset('js/filedrop.js') }}"></script>
    <script src="{{ asset('js/form.js') }}"></script>
    @endpush

</x-user>