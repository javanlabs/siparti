<?php

namespace App\Http\Controllers\My;

use App\Http\Requests;
use Illuminate\Http\Request;

class ProfileController extends MyController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile;
        $timezones = $this->timezone->lists();
        return view('my.profile.edit', compact('user', 'profile', 'timezones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->repository->update($request->only('name'), auth()->user()->getAuthIdentifier());
        $this->repository->updateProfile($request->except('_token'), auth()->user()->getAuthIdentifier());
        return redirect()->back();
    }

}
