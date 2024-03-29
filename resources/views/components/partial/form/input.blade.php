@props(['error'])

<input {!! $attributes->class(['animate-shake' => $error,' ring-red-600' => $error,' ring-2' =>$error,' block','
w-full',' rounded-md',' border-0','
px-2','py-2.5','sm:py-1.5',' text-gray-900', ' bg-gray-100/50', ' shadow-sm',' ring-1',' ring-inset',' ring-gray-300',' placeholder:text-gray-400','
focus:ring-2',' focus:ring-inset',' focus:ring-gray-600',' sm:text-sm',' sm:leading-6' ,'outline-none text-sm md:text-base']) !!}>

@if($error)
<ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
  @foreach ((array) $error as $err)
  <li>
    {{ $err }}
  </li>
  </span>
  @endforeach
</ul>
@endif