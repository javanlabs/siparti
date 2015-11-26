<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\SatkerRepositoryEloquent;
use App\Http\Requests\StoreSatkerRequest;
use Notification;

class SatuanKerjaController extends AdminController
{
    protected $satkerRepository;

    public function __construct(SatkerRepositoryEloquent $satkerRepository)
    {

        $this->satkerRepository = $satkerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satker = $this->satkerRepository->paginate(20);
        return view('admin.satuanKerja.index', compact('satker'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = "create";

        $route = Route('admin.satuanKerja.store');

        return view('admin.satuanKerja.form', compact('action', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSatkerRequest $request)
    {
        $this->satkerRepository->create( $request->all() );

        Notification::success('Program kerja berhasil disimpan.');

        return redirect()->route('admin.satuanKerja.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = "edit";

        $satker = $this->satkerRepository->find($id);

        $route = Route('admin.satuanKerja.update', ['id' => $id]);

        return view('admin.satuanKerja.form', compact('satker', 'action', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSatkerRequest $request, $id)
    {
        $this->satkerRepository->update($request->all(), $id);

        Notification::success('Data berhasil diubah');

        return redirect()->route('admin.satuanKerja.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->satkerRepository->delete($id);

        Notification::success('Data berhasil dihapus');

        return redirect()->back();
    }
}
