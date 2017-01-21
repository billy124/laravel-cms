<?php

namespace App\Models;

class Page extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'subtitle', 'excerpt', 'body', 'slug', 'order'];

    /**
     * Set model validation rules.
     * 
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|max:255',
            'code' => 'required|max:255|unique:' . $this->getTable() . ',code,' . $this->id
        ];
    }
    
    public static function fixSlug($string) {
        return strtolower(
                    rtrim(ltrim($string, '/'), '/')
                );
    }

}
