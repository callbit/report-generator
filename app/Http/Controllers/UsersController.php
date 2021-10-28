<?php

namespace App\Http\Controllers;
use App\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function update() {
        $attributes = request()->validate([
            'id'  => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
           
        ]);

        $attributes['password'] = Hash::make($attributes['password']);

        Users::find($attributes['id'])->update($attributes);

        return back()->with('message', 'Updated');
    }
}
