<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\UserFilmProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFilmProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userFilmProfile = UserFilmProfile::where('user_id', Auth::user()->id)->get();
        return view('dashboard', compact('userFilmProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->can('update', UserFilmProfile::class)) {

            if ($request->hasFile('image_upload')) {
                $fullFileName = $request->file('image_upload')->getClientOriginalName();
                $filename = pathinfo($fullFileName, PATHINFO_FILENAME);
                $fileExtension = $request->file('image_upload')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $fileExtension;
            }

            $userFilmProfile = UserFilmProfile::where('user_id', Auth::user()->id)->first();
            // Checks if user has a Film Profile
            if ($userFilmProfile != null) {
                //Assigns new updated fields
                $userFilmProfile->favourite_film = $request['favFilm'];
                $userFilmProfile->interests = $request['interests'];
                $userFilmProfile->film_reasoning = $request['reasoning'];

                if ($request->hasFile('image_upload')) {
                    //Removes Image Reference
                    $image = Image::where('imageable_type', 'App\Models\UserFilmProfile')->where('imageable_id', $userFilmProfile->id);
                    if ($image->exists()) {
                        //Removes old image from folder
                        unlink('storage/images/' . $userFilmProfile->image->image);
                        $image->delete();
                    }
                    $newImage = new Image(['image' => $fileNameToStore]);
                    $userFilmProfile->image()->save($newImage);
                    $request->file('image_upload')->storeAs('public/images', $fileNameToStore);
                }

                $userFilmProfile->save();

            } else {
                //creates a new User Film Profile
                $filmProfile = new UserFilmProfile();
                $filmProfile->favourite_film = $request['favFilm'];
                $filmProfile->interests = $request['interests'];
                $filmProfile->film_reasoning = $request['reasoning'];
                $filmProfile->user_id = Auth::user()->id;
                $filmProfile->save();
                if ($request->hasFile('image_upload')) {

                    $image = new Image(['image' => $fileNameToStore]);
                    $filmProfile->image()->save($image);
                    $request->file('image_upload')->storeAs('public/images', $fileNameToStore);
                }
            }
            session()->flash('message', 'Profile is now up to date!');
            return redirect()->route('dashboard');

        } else {
            return redirect()->route('dashboard');
        }
    }
}
