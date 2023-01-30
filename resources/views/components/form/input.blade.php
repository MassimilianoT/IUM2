@props(['label', 'name'])

<x-form.field>
    <x-form.label name="{{ $label }}" label="{{ $label }}"/>

    <input class="border border-gray-200 p-2 w-full rounded"
           name="{{ $name }}"
           id="{{ $name }}"
           {{ $attributes(['value' => old($name)]) }}
    >

    <x-form.error name="{{ $label }}"/>
</x-form.field>