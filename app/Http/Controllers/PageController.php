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

    }

    public function getPageBySlug(Request $request) {
        $page = Page::where('slug', Page::fixSlug($request->getPathInfo()))
                    ->first();
        
        $data = [
            'page' => $page 
       ];
       
        return view('pages.index', $data);
    }
}
