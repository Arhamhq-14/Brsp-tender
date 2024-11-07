<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator', 
            'email' => 'tender.admin@brsp.org.pk',
            'password' => bcrypt('Tender@12233')
        ]);
    
        $role = Role::create(['name' => 'Admin']);
     
        $permissions = Permission::pluck('uuid','uuid')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->uuid]);
    }
}
