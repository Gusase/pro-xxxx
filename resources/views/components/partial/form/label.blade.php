@props(['value'])

<label class="text-gray-900 mb-1.5 block md:text-base text-sm">{{ Str::ucfirst($value) ?? Str::ucfirst($slot) }}</label>