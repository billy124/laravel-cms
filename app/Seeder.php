<?php

namespace App;

use DB;
use Illuminate\Database\Seeder as BaseSeeder;

abstract class Seeder extends BaseSeeder {
    
    /**
     * The data to be inserted by default.
     *
     * @var array
     */
    protected $data = [];
    
    /**
     * Model class to be used by methods.
     *
     * @var Class
     */
    private $model;

    /**
     * Sets model.
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function setModel($model) {
        $this->model = $model;
    }

    /**
     * Returns model.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel() {
        return $this->model;
    }
    
    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct() {
        $this->alterData();
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        foreach ($this->data as $row) {
            $model = $this->getModel();
            $row[$model::CREATED_AT] = $row[$model::UPDATED_AT] = date('Y-m-d H:i:s');
            DB::table($model->getTable())->insert($row);
        }
    }
    
    /**
     * Modify data before inserting into database table.
     */
    abstract protected function alterData();
    
}
