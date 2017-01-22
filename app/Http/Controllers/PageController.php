<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller {

    /**
     * 
     * @return type
     */
    public function index() {
        $data = [];
        return view('pages.index', $data);
    }
    
    /**
     * 
     * @return type
     */
    public function contactUs() {
        $data = [];
        return view('pages.contact-us', $data);
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function getPageBySlug(Request $request) {
        $page = Page::where('slug', Page::fixSlug($request->getPathInfo()))
                    ->first();
        
        $data = [
            'page' => $page 
       ];
       
        return view('pages.dynamic-page', $data);
    }
    
    /**
     * 
     * @return type
     */
    public function getAllPages() {
        $data = [
            'pages' => Page::get()
        ];
        
        return view('includes.page-list', $data);
    }
}
