<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Produk</h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('products.store') }}" class="bg-white p-6 shadow sm:rounded-lg">
            @include('products._form')
        </form>
    </div>
</x-app-layout>