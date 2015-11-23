<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UjiPublikRepositoryEloquent;
use Notification;

class UjiPublikController extends Controller
{

    protected $ujiPublikRepository;

    /**
     * AuditTrailController constructor.
     */
    public function __construct(UjiPublikRepositoryEloquent $ujiPublikRepository)
    {
        $this->ujiPublikRepository = $ujiPublikRepository;

        $this->authorize('manage-uji-public');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $ujiPublik = $this->ujiPublikRepository->paginate(20);
      return view('admin.ujiPublik.index', compact('ujiPublik'));
      //dd($ujiPublik);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ujiPublikRepository->delete($id);
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
    public function update(Request $request, $id)
    {
        $this->ujiPublikRepository->update($request->all(), $id);
        
        Notification::success('Data berhasil dirubah');
        
        return redirect()->back();
    }


}
