<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Produk</h2>
            @can('create', App\Models\Product::class)
                <a href="{{ route('products.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded text-sm">+ Tambah Produk</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        <div class="bg-white shadow sm:rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Stok</th>
                        <th class="p-3">Pemilik</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr class="border-t">
                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->category->name }}</td>
                        <td class="p-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $product->stock }}</td>
                        <td class="p-3">{{ $product->user?->name ?? '-' }}</td>
                        <td class="p-3">
                            <div class="flex gap-3">
                                @can('update', $product)
                                    <a href="{{ route('products.edit', $product) }}" class="text-blue-600">Edit</a>
                                @endcan
                                @can('delete', $product)
                                    <form method="POST" action="{{ route('products.destroy', $product) }}"
                                          onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">Hapus</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</x-app-layout>