<?php

use App\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder {

    /**
     * The data to be inserted by default.
     *
     * @var array
     */
    protected $admins = [];
    protected $users = [];

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->setModel(new User);

        $this->admins[] = [
            'first_name' => 'Billy',
            'last_name' => 'Mahmood',
            'email' => 'billy@e3creative.co.uk',
            'password' => 'testtest'
        ];
        
        $this->users[]  = [
            'first_name' => 'Omar',
            'last_name' => 'Ahmed',
            'email' => 'omar@e3creative.co.uk',
            'password' => 'testtest'
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $role = Role::getByName(User::ROLE_USER);
        
        foreach ($this->users as $row) {
            $user = User::create($row);
            $user->roles()->attach($role->id); // id only
        }
        
        $role = Role::getByName(User::ROLE_ADMIN);
        
        foreach ($this->admins as $row) {
            $user = User::create($row);
            $user->roles()->attach($role->id); // id only
        }
    }
    
    /**
     * Modify data before inserting into database table.
     */
    protected function alterData() {
        
    }

}
