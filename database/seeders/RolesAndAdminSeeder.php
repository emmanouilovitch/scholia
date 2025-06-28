<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions if needed
        // Exemple de permission, vous pouvez en ajouter d'autres plus tard
        Permission::findOrCreate('manage establishments');
        Permission::findOrCreate('view establishments');
        Permission::findOrCreate('create users');
        // ... etc.

        // Create roles
        $superAdminRole = Role::findOrCreate('super_admin');
        $establishmentAdminRole = Role::findOrCreate('establishment_admin');
        $teacherRole = Role::findOrCreate('teacher');
        $studentRole = Role::findOrCreate('student');
        $parentRole = Role::findOrCreate('parent');

        // Assign permissions to roles
        // Le super_admin a toutes les permissions existantes
        $superAdminRole->givePermissionTo(Permission::all());

        // Crée un utilisateur super_admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@scholia.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(), 
            ]
        );
        $superAdmin->assignRole('super_admin');

        // Par défaut, Jetstream crée une "Personal Team" pour chaque nouvel utilisateur.
        // Cette équipe personnelle peut être notre premier "Établissement" si nécessaire.
        // Le super_admin, étant le premier, aura sa propre "équipe" associée par Jetstream.
    }
}