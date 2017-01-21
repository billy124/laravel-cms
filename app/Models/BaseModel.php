<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * The scenario of the model.
     *
     * @var string
     */
    protected $scenario = 'insert';
    
    /**
     * Returns model default conditions.
     * 
     * @return array
     */
    public function defaultConditions() {
        return [];
    }

    /**
     * Set model validation rules.
     * 
     * @return array
     */
    public function rules() {
        return [];
    }

    /**
     * Set model validation messages.
     * 
     * @return array
     */
    public function messages() {
        return [];
    }
    
    /**
     * Sets the model scenario.
     * 
     * @param string $scenario
     */
    public function setScenario($scenario) {
        $this->scenario = $scenario;
    }
    
    /**
     * Returns the model scenario.
     * 
     * @return string
     */
    public function getScenario() {
        return $this->scenario;
    }
    
    /**
     * Checks the model scenario.
     * 
     * @param string $scenario
     * 
     * @return boolean
     */
    public function isScenario($scenario) {
        return $this->scenario === $scenario;
    }

}
