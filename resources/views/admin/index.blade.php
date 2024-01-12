<x-user :$jumlahPesan :$files :$pesan>

    <x-slot:title>
        Data user (Admin)
    </x-slot:title>

    <x-partial.flash class="!my-2 shadow-md" :flash="session()->all()" />

    <ul role="list"
        class="grid w-full grid-cols-2 gap-x-6 gap-y-3 text-sm sm:grid-cols-3 md:gap-y-10 lg:grid-cols-4 my-4">
        <li
            class="rounded-2xl md:border border-gray-200 p-4 sm:p-6 border-l border-gray-600 flex flex-col items-start gap-x-1.5">
            <div class="w-8 h-8">
                <h2 class="text-2xl sm:text-3xl font-semibold font-mona"
                    style="font-variation-settings: &quot;wdth&quot; 125;">{{ $countUsers }}
                </h2>
            </div>
            <h3 class="font-mona font-normal text-sm sm:text-base text-gray-900 mt-2">Total User</h3>
        </li>
        <li
            class="rounded-2xl md:border border-gray-200 p-4 sm:p-6 border-l border-gray-600 flex flex-col items-start gap-x-1.5">
            <div class="w-8 h-8">
                <h2 class="text-2xl sm:text-3xl font-semibold font-mona"
                    style="font-variation-settings: &quot;wdth&quot; 125;">{{ count($files) }}
                </h2>
            </div>
            <h3 class="font-mona font-normal text-sm sm:text-base text-gray-900 mt-2">Total file</h3>
        </li>
        <li
            class="rounded-2xl md:border border-gray-200 p-4 sm:p-6 border-l border-gray-600 flex flex-col items-start gap-x-1.5">
            <div class="w-8 h-8">
                <h2 class="text-2xl sm:text-3xl font-semibold font-mona"
                    style="font-variation-settings: &quot;wdth&quot; 125;">{{ $verified }}
                </h2>
            </div>
            <h3 class="font-mona font-normal text-sm sm:text-base text-gray-900 mt-2">Verified users</h3>
        </li>
        <li
            class="rounded-2xl md:border border-gray-200 p-4 sm:p-6 border-l border-gray-600 flex flex-col items-start gap-x-1.5">
            <div class="w-8 h-8">
                <h2 class="text-2xl sm:text-3xl font-semibold font-mona"
                    style="font-variation-settings: &quot;wdth&quot; 125;">{{ $unverified }}
                </h2>
            </div>
            <h3 class="font-mona font-normal text-sm sm:text-base text-gray-900 mt-2">Unverified users</h3>
        </li>
    </ul>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Username
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Created at
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @unless ($countUsers > 0)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" colspan="6">
                            Tidak ada data user
                        </th>
                    </tr>
                @endunless
                @foreach ($dataUsers as $index => $user)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->fullname }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $user->username }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($user->status == 0)
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-sm font-medium px-2.5 py-0.5 rounded">pending</span>
                            @else
                                <span
                                    class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">verified</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button
                                class="font-medium @if ($user->status == 1) text-gray-300 @else text-blue-600
                            hover:underline @endif verifyA"
                                @if ($user->status == 1) disabled @endif data-user="{{ $user->id_user }}"
                                data-acc="{{ $user->fullname }}" data-modal-target="verifyAccountModal"
                                data-modal-show="verifyAccountModal">
                                Verify
                            </button>
                            |
                            <a href="{{ route('editUser', $user->id_user) }}"
                                class="font-medium text-blue-600 hover:underline">Edit</a>
                            |
                            <button class="font-medium text-blue-600 hover:underline deleteA"
                                data-user="{{ $user->id_user }}" data-acc="{{ $user->fullname }}"
                                data-modal-target="deleteAccountModal" data-modal-show="deleteAccountModal">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="ml-3">
            {{ $dataUsers->links('components.pagination') }}
        </div>
    </div>

    <div id="verifyAccountModal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button role="button" type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="verifyAccountModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-600"><span id="target-accv"
                            class="font-medium underline text-black"></span>
                        account's will be verify.</h3>
                    <form action="" method="POST" class="inline-block mr-1" id="form">
                        @csrf
                        <div class="!w-max">
                            <x-partial.primary-button onclick="process('verify')"
                                class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Verify
                            </x-partial.primary-button>
                        </div>
                    </form>
                    <x-partial.secondary-button data-modal-hide="verifyAccountModal">
                        Cancel
                    </x-partial.secondary-button>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteAccountModal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button role="button" type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="deleteAccountModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-600"><span id="target-acc"
                            class="font-medium underline text-black"></span>
                        account's will be remove from database.</h3>
                    <form method="POST" class="inline-block mr-1" id="dxz">
                        @method('DELETE')
                        @csrf
                        <div class="!w-max">
                            <x-partial.primary-button onclick="process('deleteUser')" data-delete=""
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Delete
                            </x-partial.primary-button>
                        </div>
                    </form>
                    <x-partial.secondary-button data-modal-hide="deleteAccountModal">
                        Cancel
                    </x-partial.secondary-button>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('js/form.js') }}"></script>
    @endpush
</x-user>
