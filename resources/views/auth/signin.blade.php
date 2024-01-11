<x-auth>

  <x-slot:title>
    Login
  </x-slot>

  <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-96">
      <div>
        <h2 class="mb-8 text-center text-2xl font-bold leading-9 font-semibold tracking-tight text-gray-900">
          Login
          to {{ config('app.name') }}
        </h2>
      </div>

      <x-partial.flash :flash="session()->all()" class="!mt-1 mb-4" />

      <div class="bg-white rounded-lg shadow-xl">
        <div class="p-6 sm:p-8">
          <form action="signin" method="post" id="form">
            @csrf
            <div class="mt-2.5">
              <x-partial.form.label for="usermail" :value="__('Username / Email')" />

              <x-partial.form.input id="usermail" type="text" name="usermail" :error="$errors->get('usermail')"
                :value="old('usermail')" autofocus/>
            </div>
            <div class="mt-6">
              <x-partial.form.label for="password" :value="__('Password')" />

              <x-partial.form.input id="password" type="password" name="password" :error="$errors->get('password')" />
            </div>

            <x-partial.primary-button onclick="process(event)">
              Login
            </x-partial.primary-button>
          </form>
        </div>
      </div>

      <div class="sm:mx-auto sm:w-full sm:max-w-sm bg-white rounded-lg shadow-xl p-6 sm:p-5 mt-4">
        <p class="text-sm font-light text-gray-500">
          Belum punya akun? <a href="signup"
            class="font-semibold leading-6 text-gray-600 decoration-2 underline-offset-2 hover:underline hover:decoration-gray-700">Register
            here</a>
        </p>
      </div>
    </div>
  </section>
</x-auth>