<a href="{{ route('new',['return'=>$attributes->get('url')]) }}" {{ $attributes->merge(['class' => 'p-2 rounded-xl shadow-md text-base max-md:w-full bg-white pe-4 flex items-center gap-3 px-3 w-max transition-all hover:bg-gray-900 hover:text-white']) }}>{{ $slot }}</a>