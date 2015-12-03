<?php

namespace App\Http\Controllers\Admin;

use App\Enum\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use App\Repositories\ProgramKerjaRepositoryEloquent;
use Notification;

class ProgramKerjaUsulanController extends AdminController
{

    protected $programKerjaUsulanRepository;
    protected $programKerjaRepository;
    protected $programKerjaRelationRepository;

    /**
     * ProgramKerjaUsulanController constructor.
     */
    public function __construct(
        ProgramKerjaUsulanRepositoryEloquent $programKerjaUsulanRepository,
        ProgramKerjaRepositoryEloquent $programKerjaRepository
    )
    {
        $this->programKerjaUsulanRepository = $programKerjaUsulanRepository;

        $this->programKerjaRepository = $programKerjaRepository;

        $this->authorize(Permission::MANAGE_USULAN);

        parent::__construct();
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

        $programKerja = $this->programKerjaRepository->all();

        $programKerjaUsulan = $this->programKerjaUsulanRepository->find($id);

        return view('admin.programKerjaUsulan.form', compact('programKerjaUsulan', 'programKerja', 'relatedProgramKerja'));
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

    /*
    *   Delete relation Ajax
    */
    public function deleteRelation(Request $request)
    {

        $usulanId = $request->input('usulan_id');

        $programKerjaId = $request->input('program_kerja_id');

        $model = $this->programKerjaUsulanRepository->find($usulanId);

        $model->programKerja()->detach($programKerjaId);

        return json_encode(['message' => 'success']);

    }

    /*
    *   Add Relation
    */
    public function addRelation(Request $request)
    {

        $usulanId = $request->input('usulan_id');

        $programKerjaId = $request->input('program_kerja_id');

        $model = $this->programKerjaUsulanRepository->find($usulanId);

        $model->programKerja()->attach($programKerjaId);

        return json_encode(['message' => 'success']);
    }

}
