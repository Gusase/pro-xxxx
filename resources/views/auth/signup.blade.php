<x-auth>
    <x-slot:title>
        New User Registration
    </x-slot>

    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:my-7 2xl:my-0 lg:py-0">
        <div class="w-96">
            <div>
                <h2 class="mb-8 text-center text-2xl font-bold leading-9 font-semibold tracking-tight text-gray-900">
                    {{ config('app.name') }} User Registration
                </h2>
            </div>

            <x-partial.flash :flash="session()->all()" class="!mt-1 mb-4" />
                
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8 bg-white rounded-lg shadow-xl">
                <form action="signup" method="post" id="form">
                    @csrf
                    <div class="mt-2.5">
                        <x-partial.form.label for="fullname" :value="__('name')" />

                        <x-partial.form.input id="fullname" type="text" :value="old('fullname')" name="fullname"
                            :error="$errors->get('fullname')" />
                    </div>

                    <div class="mt-6">
                        <x-partial.form.label for="username" :value="__('username')" />

                        <x-partial.form.input id="username" type="text" :value="old('username')" name="username"
                            :error="$errors->get('username')" />
                    </div>

                    <div class="mt-6">
                        <x-partial.form.label for="email" :value="__('email')" />

                        <x-partial.form.input id="email" type="email" :value="old('email')" name="email"
                            :error="$errors->get('email')" />
                    </div>

                    <div class="mt-6">
                        <x-partial.form.label for="password" :value="__('create a password')" />

                        <x-partial.form.input id="password" type="password" name="password"
                            :error="$errors->get('password')" />
                    </div>

                    <div class="mt-6">
                        <x-partial.form.label for="password_confirmation" :value="__('confirm password')" />

                        <x-partial.form.input id="password_confirmation" type="password" name="password_confirmation"
                            :error="$errors->get('password_confirmation')" />
                    </div>

                    <x-partial.primary-button onclick="process(event)">
                        Register account
                    </x-partial.primary-button>

                </form>
            </div>
            
            <div class="sm:mx-auto sm:w-full sm:max-w-sm bg-white rounded-lg shadow-xl p-6 sm:p-5 mt-4">
            <p class="text-sm font-light text-gray-500">
                Sudah punya akun? <a href="signin"
                    class="font-semibold leading-6 text-gray-600 decoration-2 underline-offset-2 hover:underline hover:decoration-gray-700">Login
                    here</a>
            </p>
            </div>
        </div>
    </section>
</x-auth>