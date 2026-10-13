<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class PostPolicy
{
    // Admin boleh semua aksi
    public function before(User $user, string $ability): ?bool
    {
        return $user->role === 'admin' ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'editor';
    }

    // Editor hanya boleh edit produk miliknya sendiri
    public function update(User $user, Product $product): bool
    {
        return $user->role === 'editor' && $product->user_id === $user->id;
    }

    // Editor hanya boleh hapus produk miliknya sendiri
    public function delete(User $user, Product $product): bool
    {
        return $user->role === 'editor' && $product->user_id === $user->id;
    }
}