<x-user :$title :$user :$jumlahPesan :$pesan>
    @error('fullname')
    <div class="alert alert-danger mt-3 mx-2" role="alert" style="position: absolute; z-index: 1; top: 0; right: 0;">
        {{ $message }}
    </div>
    @enderror
    @error('username')
    <div class="alert alert-danger mt-3 mx-2" role="alert" style="position: absolute; z-index: 1; top: 0; right: 0;">
        {{ $message }}
    </div>
    @enderror
    @error('email')
    <div class="alert alert-danger mt-3 mx-2" role="alert" style="position: absolute; z-index: 1; top: 0; right: 0;">
        {{ $message }}
    </div>
    @enderror
    @error('password')
    <div class="alert alert-danger mt-3 mx-2" role="alert" style="position: absolute; z-index: 1; top: 0; right: 0;">
        {{ $message }}
    </div>
    @enderror
    <div class="max-w-2xl py-5 xl:mx-auto">
        <div class="border-b border-gray-900/20 pb-2">
            <h2 class="text-2xl font-medium leading-7 text-gray-900">Edit User</h2>
        </div>
        <form method="post" action="{{ route('editAction', $user->id_user) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mt-6">
                <x-partial.form.label for="fullname" :value="__('Nama Lengkap')" />

                <x-partial.form.input id="fullname" type="text" name="fullname" :error="$errors->get('fullname')"
                    :value="old('fullname', $user->fullname)" autofocus />
            </div>
            <div class="mt-6">
                <x-partial.form.label for="username" :value="__('Username')" />

                <x-partial.form.input id="username" type="text" name="username" :error="$errors->get('username')"
                    :value="old('username', $user->username)" />
            </div>
            <div class="mt-6">
                <x-partial.form.label for="email" :value="__('Email')" />

                <x-partial.form.input id="email" type="email" name="email" :error="$errors->get('email')"
                    :value="old('email', $user->email)" />
            </div>
            <div class="mt-6">
                <x-partial.form.label for="password" :value="__('Password')" />

                <x-partial.form.input id="password" type="text" name="password" :error="$errors->get('password')" />
                <p class="text-sm text-gray-600 mt-1.5">Leave blank if you do not provide a new password for <span
                        class="font-semibold">{{ $user->fullname }}</span></p>
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
</x-user>