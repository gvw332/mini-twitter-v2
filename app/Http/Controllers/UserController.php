<?php

namespace App\Http\Controllers;

use Creativeorange\Gravatar\Facades\Gravatar;

public function generateAvatars()
{
    $users = User::all();

    foreach ($users as $user) {
        $avatarUrl = Gravatar::get($user->email);
        $avatar = new Avatar([
            'url' => $avatarUrl
        ]);
        $user->avatar()->save($avatar);
    }

    return redirect()->back();
}