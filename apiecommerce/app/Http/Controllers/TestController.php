<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function methode1 ($userName) {
        echo "Bonjour . $userName";
    }

    public function methode2 () {
        return "Ceci est la methode 2";
    }

    // On affiche une view a partir du Controller
    public function login () {
       $userName = "JOhn";
       return view ('acceuil', [
        "name" => $userName
       ]);
    }
}
