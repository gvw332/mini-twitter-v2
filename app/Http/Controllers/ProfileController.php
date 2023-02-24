<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:5000'],
        ]);

        $path = Storage::url($request->file('avatar')->store('avatars', 'public'));

        // dd($path);

        $user = $request->user();
        $user->avatar = $path;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'avatar-updated');
    }
}


// use Creativeorange\Gravatar\Facades\Gravatar;

// public function generateAvatars()
// {
//     $users = User::all();

//     foreach ($users as $user) {
//         $avatarUrl = Gravatar::get($user->email);
//         $avatar = new Avatar([
//             'url' => $avatarUrl
//         ]);
//         $user->avatar()->save($avatar);
//     }

//     return redirect()->back();
// }