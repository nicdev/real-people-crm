<div class="my-4">
    <button wire:click="$dispatch('openModal', {component: '{{ Str::plural($model) }}.modal' })" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">New {{ Str::ucfirst($model) }}</button>
</div>