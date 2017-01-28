<?php

use App\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder {

    /**
     * The data to be inserted by default.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->setModel(new Role);

        $this->data[] = [
            'name' => User::ROLE_ADMIN,
            'display_name' => 'Administrator of the site',
            'description' => 'Admin user, has access to backend of the site'
        ];
        
        $this->data[]  = [
            'name' => User::ROLE_USER,
            'display_name' => 'Generic user',
            'description' => 'Generic user who only has access to frontend section'
        ];
    }

    /**
     * Modify data before inserting into database table.
     */
    protected function alterData() {
        
    }

}
