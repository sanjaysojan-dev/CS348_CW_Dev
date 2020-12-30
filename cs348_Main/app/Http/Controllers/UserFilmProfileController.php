<?php

namespace App\Http\Controllers;

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
        //dd($userFilmProfile);
        return view('dashboard', compact('userFilmProfile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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


        if ($request->hasFile('image_upload')) {
            $fullFileName = $request->file('image_upload')->getClientOriginalName();
            $filename = pathinfo($fullFileName, PATHINFO_FILENAME);
            $fileExtension = $request->file('image_upload')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $fileExtension;
        }

        //dd($request);

        $userFilmProfile = UserFilmProfile::where('user_id', Auth::user()->id)->first();

        if ($userFilmProfile != null) {
            $userFilmProfile->favourite_film = $request['favFilm'];
            $userFilmProfile->interests = $request['interests'];
            $userFilmProfile->film_reasoning = $request['reasoning'];

            if ($request->hasFile('image_upload')) {

                if ($userFilmProfile->image != 'noImageUploaded.jpg' && ($userFilmProfile->image!=null)) {
                    unlink('storage/images/' . $userFilmProfile->image);
                }

                $userFilmProfile->image = $fileNameToStore;
                $request->file('image_upload')->storeAs('public/images', $fileNameToStore);
            }

            $userFilmProfile->save();

        } else {
            $userFilmProfile = new UserFilmProfile();
            $userFilmProfile->favourite_film = $request['favFilm'];
            $userFilmProfile->interests = $request['interests'];
            $userFilmProfile->film_reasoning = $request['reasoning'];
            $userFilmProfile->user_id = Auth::user()->id;

            if ($request->hasFile('image_upload')) {

                if ($userFilmProfile->image != 'noImageUploaded.jpg' && ($userFilmProfile->image!=null)) {
                    unlink('storage/images/' . $userFilmProfile->image);
                }

                $userFilmProfile->image = $fileNameToStore;
                $request->file('image_upload')->storeAs('public/images', $fileNameToStore);
            }


            $userFilmProfile->save();
        }

        return redirect()->route('dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
