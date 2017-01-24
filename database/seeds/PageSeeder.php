<?php

use App\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder {

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
        $this->setModel(new Page);

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 11; $i++) {
            $this->data[] = [
                'parent_id' => null,
                'title' => $faker->text(20),
                'subtitle' => $faker->text(20),
                'excerpt' => $faker->text(100),
                'body' => "<p>" . $faker->text(rand(200,400)) . "</p><p>" . $faker->text(rand(150,400)) . "</p><p>" . $faker->text(rand(300,400)) . "</p>",
                'slug' => $faker->slug(),
                'order' => 1
            ];
        }
    }

    /**
     * Modify data before inserting into database table.
     */
    protected function alterData() {
        
    }

}
