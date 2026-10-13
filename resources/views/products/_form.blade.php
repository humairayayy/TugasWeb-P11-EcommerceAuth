@csrf

<div class="mb-4">
    <x-input-label for="category_id" value="Kategori" />
    <select name="category_id" id="category_id" class="block mt-1 w-full border-gray-300 rounded-md">
        @foreach ($categories as $c)
            <option value="{{ $c->id }}" @selected(old('category_id', $product->category_id ?? '') == $c->id)>{{ $c->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="name" value="Nama" />
    <x-text-input id="name" name="name" class="block mt-1 w-full" :value="old('name', $product->name ?? '')" required />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="description" value="Deskripsi" />
    <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 rounded-md">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <x-input-label for="price" value="Harga" />
    <x-text-input id="price" name="price" type="number" class="block mt-1 w-full" :value="old('price', $product->price ?? '')" required />
    <x-input-error :messages="$errors->get('price')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="stock" value="Stok" />
    <x-text-input id="stock" name="stock" type="number" class="block mt-1 w-full" :value="old('stock', $product->stock ?? 0)" required />
    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
</div>

<x-primary-button>Simpan</x-primary-button>