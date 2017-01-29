<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller {

    /**
     * Static index page
     * 
     * @return type
     */
    public function index() {
        $data = [];
        return view('pages.index', $data);
    }
    
    /**
     * Static contact us page
     * 
     * @return type
     */
    public function contactUs() {
        $data = [];
        return view('pages.contact-us', $data);
    }

    /**
     * Get a page and its content by the slug
     * 
     * @param Request $request
     * @return type
     */
    public function getPageBySlug(Request $request) {
        $page = Page::where('slug', Page::fixSlug($request->getPathInfo()))
                    ->first();
        
        // could not find page so throw a 404 exception
        if(!$page) {
            abort(404);
        }
        
        $data = [
            'page' => $page 
       ];
       
        return view('pages.dynamic-page', $data);
    }
    
    /**
     * Get a list of all the pages as a menu
     * 
     * @return type
     */
    public function getAllPages() {
        $data = [
            'pages' => Page::getParentPages()
        ];
        
        return view('includes.page-list', $data);
    }
    
    /**
     * List all dynamic pages
     * 
     * @return type
     */
    public function listPages() {
        $data = [];
        return view('pages.list', $data);
    }
    
    /**
     * Create a new page form
     * 
     * @return type
     */
    public function create() {
        $data = [];
        return view('pages.create', $data);
    }
    
    /**
     * create a new page
     * 
     * @param Request $request
     */
    public function store(Request $request) {
        Page::create($request->all());
    }
    
    /**
     * Edit page form
     * 
     * @return type
     */
    public function edit(Page $page) {
        $data = [];
        return view('pages.edit', $data);
    }
}
