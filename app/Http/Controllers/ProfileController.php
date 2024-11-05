<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    //

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        
    }
}
