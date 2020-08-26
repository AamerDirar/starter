<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation()
    {
        $user = User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(6);

        // $phone = $user->phone;

        return response()->json($user);
    }

    public function hasOneRelationReverse()
    {
        // $phone = Phone::find(1);
        // $phone = Phone::with('user')->find(1);
        $phone = Phone::with(['user' => function($q) {
            $q->select('id', 'name');
        }])->find(1);

        // make some attribute visible
        // return $phone->makeVisible(['user_id']);

        // make some attribute hidden
        // return $phone->makeHidden(['code']);

        //return $phone->user; // return user of this phone number
        //return $phone->user->name; // return user name of this phone number

        // get all data phone + user
        return $phone;


    }

    public function getUserHasPhone()
    {
        return User::whereHas('phone')->get();
    }

    public function getUserNotHasPhone()
    {
        return User::whereDoesntHave('phone')->get();
    }

    public function getUserWhereHasPhoneWithCondition()
    {
        return User::whereHas('phone', function($q) {
            $q -> where('code', '249');
        })->get();
    }


}
