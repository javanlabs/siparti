<?php

namespace App\Http\Controllers\My;

use App\Http\Requests;
use Illuminate\Http\Request;

class EmailController extends MyController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function activate($token)
    {
        if ($this->repository->activateEmail($token)) {
            \Notification::success('Email berhasil diperbarui');
        } else {
            \Notification::error('Token aktivasi tidak valid');
        }

        return redirect()->to('my/account');
    }


}
