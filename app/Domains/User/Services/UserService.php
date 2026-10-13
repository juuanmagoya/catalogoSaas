<?php

namespace App\Domains\User\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Obtener todos los usuarios
     */
    public function getAll()
    {
        return User::query()
            ->with('tenant')
            ->latest()
            ->paginate(15);
    }

    /**
     * Crear un usuario owner asociado a un tenant
     */
    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'owner';

        return User::create($data);
    }

    /**
     * Actualizar un usuario
     */
    public function update(User $user, array $data): User
    {
        if (isset($data['password']) && $data['password'] !== '') {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // El rol se mantiene como owner.
        $data['role'] = 'owner';

        $user->update($data);

        return $user->fresh()->load('tenant');
    }

    /**
     * Eliminar un usuario
     */
    public function delete(User $user): void
    {
        $user->delete();
    }
}