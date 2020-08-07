<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserName() {
        return 'Aamer Dirar';
    }

    public function getIndex() {

        $data = [];
        $data['id'] = 5;
        $data['name'] = 'aamer dirar';

        $obj = new \stdClass();

        $obj->name = 'aamer dirar';
        $obj->id = 5;
        $obj->gender = 'male';

        $data = [];

        return view('welcome', compact('data'));
    }
}
