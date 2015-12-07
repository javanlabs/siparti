<?php

namespace App\Http\Controllers\Admin;

use App\Entities\UjiPublik;
use App\Enum\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUjiPublikRequest;
use App\Repositories\UjiPublikRepositoryEloquent;
use Notification;

class UjiPublikController extends AdminController
{

    protected $ujiPublikRepository;

    /**
     * AuditTrailController constructor.
     */
    public function __construct(UjiPublikRepositoryEloquent $ujiPublikRepository)
    {
        $this->ujiPublikRepository = $ujiPublikRepository;

        $this->authorize(Permission::MANAGE_UJI_PUBLIK()->getKey());

        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $ujiPublik = $this->ujiPublikRepository->with('creator')->paginate(20);
      return view('admin.ujiPublik.index', compact('ujiPublik'));
    }

    public function create(Request $request)
    {
        return view('admin.ujiPublik.create');
    }

    public function store(StoreUjiPublikRequest $request)
    {
        $ujiPublik = $this->ujiPublikRepository->create($request->only(['name', 'materi']));
        $this->ujiPublikRepository->attachDocument($ujiPublik, $request->file('file'));

        Notification::success('Uji publik berhasil disimpan.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ids
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        $ids = explode(',', $ids);
        UjiPublik::destroy($ids);

        return redirect()->back();

    }

    /**
     * Menghapus multiple uji publik
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMultiple(Request $request)
    {

      $toBeDeletedIds = $request->get('deletedId');

      foreach ($toBeDeletedIds as $id) {

        $this->ujiPublikRepository->delete((int)$id);

      }

      return redirect()->back();

    }

    /*
     * Menampilkan form edit
     */
    public function edit(Request $request, $id)
    {
        $ujiPublik = $this->ujiPublikRepository->find($id);

        return view('admin.ujiPublik.form', compact('ujiPublik'));
    }

    /*
     *  Update data
     */
    public function update(StoreUjiPublikRequest $request, $id)
    {
        $this->ujiPublikRepository->update($request->all(), $id);

        Notification::success('Data berhasil dirubah');

        return redirect()->back();
    }


}
