<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use Notification;


class ProgramKerjaUsulanController extends Controller
{

    protected $programKerjaUsulanRepository;

    /**
     * ProgramKerjaUsulanController constructor.
     */
    public function __construct(ProgramKerjaUsulanRepositoryEloquent $programKerjaUsulanRepository)
    {
        $this->programKerjaUsulanRepository = $programKerjaUsulanRepository;

        $this->authorize('manage-program-usulan-kerja');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $programKerjaUsulan = $this->programKerjaUsulanRepository->paginate(20);
      return view('admin.programKerjaUsulan.index', compact('programKerjaUsulan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->programKerjaUsulanRepository->delete($id);
        return redirect()->back();
    }

    /**
     * Menghapus multiple programKerjaUsulan
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMultiple(Request $request)
    {

      $toBeDeletedIds = $request->get('deletedId');

      foreach ($toBeDeletedIds as $id) {

        $this->programKerjaUsulanRepository->delete((int)$id);

      }

      return redirect()->back();
    }
    
    /*
     *  Menampilkan form edit
     */
    public function edit(Request $request, $id)
    {
        $programKerjaUsulan = $this->programKerjaUsulanRepository->find($id);
        
        return view('admin.programKerjaUsulan.form', compact('programKerjaUsulan'));
    }
    
    /*
     * Update data
     */
    public function update(Request $request, $id)
    {
        $this->programKerjaUsulanRepository->update($request->all(), $id);
        
        Notification::success('Data berhasil dirubah');
        
        return redirect()->back();
    }


}
