@props(['value'])

<label class="text-[#004269] mb-1.5 block md:text-base text-sm">{{ Str::ucfirst($value) ?? Str::ucfirst($slot) }}</label>