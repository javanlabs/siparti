<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UsulanProgramKerjaEloquent;

class UsulanProgramKerjaController extends Controller
{

    protected $usulanProgramKerjaRepository;

    /**
     * UsulanProgramKerjaController constructor.
     */
    public function __construct(UsulanProgramKerjaEloquent $usulanProgramKerjaRepository)
    {
        $this->usulanProgramKerjaRepository = $usulanProgramKerjaRepository;

        $this->authorize('manage-usulan-program-kerja');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $usulanProgramKerja = $this->usulanProgramKerjaRepository->paginate(20);
      return view('admin.usulanProgramKerja.index', compact('usulanProgramKerja'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->usulanProgramKerjaRepository->delete($id);
        return redirect()->back();

    }

    /**
     * Menghapus multiple usulanProgramKerja
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMultiple(Request $request)
    {

      $toBeDeletedIds = $request->get('deletedId');

      foreach ($toBeDeletedIds as $id) {

        $this->commentsRepository->delete((int)$id);

      }

      return redirect()->back();
    }


}
