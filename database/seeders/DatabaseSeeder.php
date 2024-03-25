<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Expedition;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $toTruncate = ['users','roles','product_categories','expeditions','order_status','provinces','cities','districts','villages','address','products','carousel'];
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
            // $this->call(RolesSeeder::class);
            $adminRole = Role::create(['name' => 'admin']);
            $rekruitmentRole = Role::create(['name' => 'rekruitment']);
            $payroll1Role = Role::create(['name' => 'payrol1']);
            $payroll2Role = Role::create(['name' => 'payroll2']);
            $developmentRole = Role::create(['name' => 'development']);
        
            // Membuat izin
            Permission::create(['name' => 'manage posts']);
            Permission::create(['name' => 'manage comments']);
        
            // Assign izin kepada peran
            $adminRole->givePermissionTo('manage posts');
            $adminRole->givePermissionTo('manage comments');
            $this->call(UsersSeeder::class);
            // $this->call(ProductCategoriesSeeder::class);
            // $this->call(OrderStatusSeeder::class);
            // $this->call(ExpeditionSeeder::class);
            // // $this->call(ProvincesSeeder::class);
            // // $this->call(CitiesSeeder::class);
            // // $this->call(DistrictsSeeder::class);
            // // $this->call(VillagesSeeder::class);
            // $this->call(AdressSeeder::class);
            // $this->call(ProductSeeder::class);
            // $this->call(CarouselSeeder::class);
    
    
    
            Model::reguard();
        }
}