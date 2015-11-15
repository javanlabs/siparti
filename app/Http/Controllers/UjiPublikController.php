<?php

namespace App\Http\Controllers;

use App\Repositories\UjiPublikRepositoryEloquent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Krucas\Notification\Facades\Notification;

class UjiPublikController extends Controller
{
    /**
     * @var UjiPublikRepositoryEloquent
     */
    protected $repository;

    /**
     * UjiPublikController constructor.
     */
    public function __construct(UjiPublikRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ujiPublik = $this->repository->paginate();
        $year = $this->repository->yearOptions('-- Semua Tahun --');

        return view('uji_publik.index', compact('ujiPublik', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uji_publik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ujiPublik = $this->repository->create($request->only(['name', 'materi']));
        $this->repository->attachDocument($ujiPublik, $request->file('file'));

        Notification::success('Uji publik berhasil disimpan.');
        return redirect()->route('uji-publik.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ujiPublik = $this->repository->find($id);

        return view('uji_publik.show', compact('ujiPublik'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
