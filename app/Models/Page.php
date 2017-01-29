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
    protected $fillable = ['parent_id', 'title', 'subtitle', 'excerpt', 'body', 'slug', 'order', 'is_active', 'publish_date'];

    /**
     * Set model validation rules.
     * 
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|max:255',
            'body' => 'required',
            'slug' => 'required'
        ];
    }
    
    public function parent(){
        return $this->belongsTo('App\Models\Page', 'parent_id');
    }
    
    /**
     * Get the children pages of current page
     * 
     * @return type
     */
    public function children() {
        return $this->hasMany('App\Models\Page', 'parent_id');
    }

    /**
     * Remove any starting or ending slashes from a string
     * 
     * @param type $string
     * @return type
     */
    public static function fixSlug($string) {
        return strtolower(
                rtrim(ltrim($string, '/'), '/')
        );
    }
    
    /**
     * Get all top level pages, that have no children
     * 
     * @return type
     */
    public static function getParentPages() {
        return Page::where('parent_id', null)
                ->where('is_active', 1)
                ->get();
    }

    /**
     * Get parent pages with children lazy loaded
     * 
     * @return type
     */
    public static function getPageTree() {
        return Page::whereNull('parent_id')
                ->where('is_active', 1)
                ->with('children')->get();
    }

}
