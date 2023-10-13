<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $toTruncate = ['users','roles'];
        public function run(): void
        {
            // \App\Models\User::factory(10)->create();
    
            // \App\Models\User::factory()->create([
            //     'name' => 'Test User',
            //     'email' => 'test@example.com',
            // ]);
            Model::unguard();
    
            Schema::disableForeignKeyConstraints();
    
            foreach ($this->toTruncate as $table) {
                DB::table($table)->truncate();
            }
            Schema::enableForeignKeyConstraints();
    
            // module User
            $this->call(RolesSeeder::class);
            $this->call(UsersSeeder::class);
    
    
    
            Model::reguard();
        }
}