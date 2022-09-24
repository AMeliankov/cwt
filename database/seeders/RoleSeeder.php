<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private array $properties = [
        [
            'name' => 'Администратор',
            'slug' => 'admin'
        ],
        [
            'name' => 'Работник',
            'slug' => 'worker'
        ],
        [
            'name' => 'Охрана',
            'slug' => 'security'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->properties as $property) {
            Role::query()->updateOrCreate($property);
        }
    }
}
