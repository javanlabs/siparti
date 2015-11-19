<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\FaseRepositoryEloquent;

class ProgramKerjaController extends Controller
{

    protected $programKerjaRepository;

    /**
     * ProgramKerjaController constructor.
     */
    public function __construct(FaseRepositoryEloquent $programKerjaRepository)
    {
        $this->programKerjaRepository = $programKerjaRepository;

        $this->authorize('manage-program-kerja');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $programKerja = $this->programKerjaRepository->paginate(20);
      //dd($programKerja);
      return view('admin.programKerja.index', compact('programKerja'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->programKerjaRepository->delete($id);
        return redirect()->back();

    }

    /**
     * Menghapus multiple comment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMultiple(Request $request)
    {

      $toBeDeletedIds = $request->get('deletedId');

      foreach ($toBeDeletedIds as $id) {

        $this->programKerjaRepository->delete((int)$id);

      }

      return redirect()->back();

    }


}
