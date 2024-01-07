<x-user :$jumlahPesan :$pesan :$pesanGrup>
  <x-slot:title>
    Notifications - {{ config('app.name') }}
  </x-slot>

  <div class="max-w-xl 2xl:w-[min(calc(100vw_-_200px_-_17px_-_0px),1478px)] mx-auto my-8 min-h-full">
    <div class="bg-gray-100 highlight-white/5 ring-1 ring-black/5 rounded-md p-2 flex flex-col space-y-2">
      <x-section-heading class="!mb-1">
        <h3 class="text-2xl font-mona font-medium">
          Notifications
        </h3>
      </x-section-heading>
      @unless (count($pesan))
      <div class="px-3 py-4">
        <div class="text-gray-700 text-center">
          <span>You have no recent notifications</span>
        </div>
      </div>
      @endunless
      <div>
        @foreach ($pesan->all() as $p)
        <div class="px-3 py-2.5 flex items-start hover:bg-gray-50/90 rounded-md group">
          <div class="flex flex-col w-full max-w-full">
            <div class="flex items-center space-x-2">
              <img class="w-8 sm:w-14 aspect-square rounded-full object-cover"
                src="{{ $p->user->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . $p->user->pp) }}"
                alt="{{ $p->id_pengirim }}">
              <div class="leading-1 5 flex flex-col basis-full w-full min-w-0">
                <a href=""
                  class="text-[0.85rem] truncate w-full font-normal decoration-2 underline-offset-2 hover:underline hover:decoration-gray-700 duration-150 p-0.5 pb-0">{{
                  $p->user->username }}</a>
                <span title="{{ $p->created_at }}" class="text-xs text-gray-700">
                  {{ $p->created_at->diffForHumans() == '1 month ago' ? $p->created_at->format('d M Y') : $p->created_at->diffForHumans() }}
                </span>
              </div>
            </div>
            <p class="text-sm font-normal my-2.5 text-gray-900 sm:px-2">{{ $p->pesan }}</p>
            <a href="{{ route('file.share.detail',[$p->user->username ,$p->id_file]) }}"
              title="Filename: {{ $p->file->original_filename }}"
              class="flex overflow-hidden items-start relative hover:bg-gray-200/30 before:rounded-xl ring-1 group-hover:ring-gray-900/30 ring-gray-900/10 rounded-xl p-2 duration-150 transition-shadow hover:!ring-gray-900">
              <div class="me-2">
                <span class="flex items-center gap-2 text-sm font-medium text-gray-900 pb-2 font-poppins line-clamp-2">
                  {{ $p->file->original_filename }}
                </span>
                <span class="flex text-xs font-normal uppercase text-gray-500 gap-2">
                  {{ $p->file->file_size }}
                  <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="self-center" width="3" height="4"
                    viewBox="0 0 3 4" fill="none">
                    <circle cx="1.5" cy="2" r="1.5" fill="#6B7280"></circle>
                  </svg>
                  {{ $p->file->ekstensi_file }}
                </span>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</x-user>