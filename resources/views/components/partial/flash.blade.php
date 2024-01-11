@php
    if ($attributes->get('flash') != null) {
        if (isset($attributes->get('flash')['fail']) || isset($attributes->get('flash')['success']) || isset($attributes->get('flash')['info']) || isset($attributes->get('flash')['warn'])) {
            $msg = null;
            $alert = null;
            $messages = [
                'fail' => $attributes->get('flash')['fail'] ?? null,
                'success' => $attributes->get('flash')['success'] ?? null,
                'info' => $attributes->get('flash')['info'] ?? null,
                'warn' => $attributes->get('flash')['warn'] ?? null,
            ];

            foreach ($messages as $a => $m) {
                if ($m != null) {
                    $msg = $m;
                    $alert = $a;
                }
            }

            $alertType = match ($alert) {
                'fail' => 'border-red-600',
                'success' => 'border-green-300',
                'info' => 'border-blue-300',
                'warn' => 'border-yellow-300',
                default => 'border-gray-300',
            };
        }
    }
@endphp

@if (isset($messages))
        <div id="atomic-alert-1"
            class="{{ $attributes->merge(['class' => 'absolute bottom-[2vh] left-[4vh] z-20 !mb-5 flex max-w-xl items-center space-x-2 rounded-lg bg-gray-700 p-3 text-white ' . $alertType])['class'] }}"
            role="alert">
            <div class="w-full pe-2 text-sm font-medium">
                {!! $msg !!}
            </div>
            <button type="button" autofocus class="inline-flex aspect-square h-8 w-8 items-center justify-center rounded-md text-white outline-none ring-1 ring-gray-300 duration-150 focus-within:ring-2 hover:ring-2 focus:ring-2" data-dismiss-target="#atomic-alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
                </svg>
            </button>
        </div>
        {{-- <div id="atomic-alert-1"
        class="{{ $attributes->merge(['class' => 'flex w-16 h-16 items-center p-4 text-black border text-black rounded-lg absolute bottom-[2vh] left-[4vh] z-20 ' . $alertType])['class'] }}"
        role="alert">
        <span class="sr-only">{{ $alert }}</span>
        <div class="ms-2 text-sm font-medium">
            {!! $msg !!}
        </div>
        <button type="button" autofocus=""
            class="-my-1 ml-2 inline-flex h-9 w-9 items-center justify-center rounded-md p-1.5 text-black outline-none ring-inset backdrop-blur-lg duration-150 focus-within:bg-gray-100/80 focus-within:ring-2 hover:ring-2 focus-within:ring-gray-900/80 hover:bg-gray-100/80 hover:ring-slate-600 focus:ring-2 focus:ring-gray-900/80"
            data-dismiss-target="#atomic-alert-1" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
            </svg>
        </button>
    </div> --}}
@endif
