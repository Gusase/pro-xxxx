<x-user :$jumlahPesan :$pesan :$pesanGrup>

    <x-slot:title>
        Account Settings - {{ config('app.name') }}
    </x-slot>

    <div class="max-w-4xl py-5 xl:mx-auto mt-4">

        <x-partial.flash class="!mb-5 !-ml-3" :flash="session()->all()" />

        <form action="{{ route('user.update', $user->id_user) }}" method="POST" enctype="multipart/form-data" id="form">
            @method('put')
            @csrf
            <div class="flex flex-col sm:flex-row -mx-2">
                <div class="space-y-12 w-2/3 -mx-1.5">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="border-b border-gray-900/20 pb-2">
                            <h2 class="text-2xl font-medium leading-7 text-gray-900">Public profile</h2>
                        </div>
                        <div class="mt-1.5 grid grid-cols-1 gap-x-6 sm:grid-cols-6">
                            <div class="mt-6 col-span-5">
                                <x-partial.form.label for="name" :value="__('Name')" />

                                <x-partial.form.input id="name" type="text" name="fullname" :value="$user->fullname"
                                    :error="$errors->get('fullname')" />
                            </div>

                            <div class="mt-6 col-span-5">
                                <x-partial.form.label for="username" :value="__('Username')" />

                                <x-partial.form.input id="username" type="text" name="username" :value="$user->username"
                                    :error="$errors->get('username')" />
                            </div>

                            <div class="mt-6 col-span-5">
                                <x-partial.form.label for="email" :value="__('Email')" />

                                <x-partial.form.input id="email" type="text" name="email" :value="$user->email"
                                    :error="$errors->get('email')" />
                            </div>

                            <div class="mt-6 col-span-5">
                                <x-partial.form.label for="password" :value="__('Password')" />

                                <x-partial.form.input id="password" type="password" name="password"
                                    :error="$errors->get('password')" />
                                
                                <p class="text-sm text-gray-600 mt-1.5">Leave blank if you do not provide a new password</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="w-1/3 -mx-1.5">
                    <div class="flex flex-col items-center sm:mt-5">
                        <button
                        class="w-48 h-48 focus:outline-none focus:ring-1 focus:ring-gray-400 ring-offset-4 rounded-full duration-100 group relative"
                        type="button" onclick="openFile()">
                            <img class="w-full h-full object-cover rounded-full shadow-lg hover:brightness-95 duration-150"
                                src="{{ Auth::user()->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . Auth::user()->pp) }}"
                                id="imgPreview" />
                            <span class="absolute inset-0 bg-white/70 rounded-full backdrop-blur-md flex justify-center items-center text-xl capitalize text-gray-800 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-300">change image</span>
                        </button>
                        <div class="mt-3">
                            <x-partial.form.input id="pp" type="file" name="pp" :error="$errors->get('pp')"
                                class="!hidden !invisible !p-1.5" :value="$user->pp" accept="image/gif,image/png,image/jpg,image/jpeg"
                                onchange="showPreview(event);" />
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-6 flex items-center justify-start gap-x-4">
                <div class="!w-max -mt-6">
                    <x-partial.primary-button onclick="process(event)">
                        Save
                    </x-partial.primary-button>
                </div>
                <x-partial.secondary-button onclick="history.back()">
                    Cancel
                </x-partial.secondary-button>
            </div>
        </form>
    </div>

    @push('script')
    <script>
        function openFile() {
                document.getElementById('pp').click();
            }
    </script>
    @endpush
</x-user>