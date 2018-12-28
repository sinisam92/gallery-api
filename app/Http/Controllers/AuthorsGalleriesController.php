<?php

namespace App\Http\Controllers;

use App\User;
use App\Gallery;
use Illuminate\Http\Request;

class AuthorsGalleriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    public function index(Request $request, $id) {
        
        $term = $request->input('term');
        
        return Gallery::getGalleries($term, $id);
    }
}
