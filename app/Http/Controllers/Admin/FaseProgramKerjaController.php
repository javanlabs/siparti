<?php

namespace App\Http\Controllers\Admin;

use App\Enum\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Entities\Fase;
use App\Http\Controllers\Controller;
use App\Repositories\FaseRepositoryEloquent;
use App\Repositories\SatkerRepositoryEloquent;
use App\Repositories\ProgramKerjaRepositoryEloquent;
use App\Http\Requests\StoreFaseRequest;
use Notification;


class FaseProgramKerjaController extends AdminController
{

    protected $faseRepository;

    protected $satkerRepository;

    protected $programKerjaRepository;

    /**
     * ProgramKerjaController constructor.
     */
    public function __construct(
            FaseRepositoryEloquent $faseRepository,
            SatkerRepositoryEloquent $satkerRepository,
            ProgramKerjaRepositoryEloquent $programKerjaRepository
    )
    {
        $this->faseRepository = $faseRepository;

        $this->satkerRepository = $satkerRepository;

        $this->programKerjaRepository = $programKerjaRepository;

        $this->authorize(Permission::MANAGE_PROGRAM_KERJA()->getKey());

        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $programKerja = $this->faseRepository->paginate(20);

      return view('admin.faseProgramKerja.index', compact('programKerja'));
    }

    /*
    *   Menampilakn form create
    */
    public function create(Request $request)
    {

        $action = "create";

        $avaibleTags = Fase::existingTags();

        $route = Route('admin.faseProgramKerja.store');

        $satkers = $this->satkerRepository->all();

        $programKerja = $this->programKerjaRepository->all();

        return view('admin.faseProgramKerja.form', compact('avaibleTags', 'satkers', 'programKerja', 'action', 'route', 'type'));
    }

    /*
    *
    *   Record fase baru
    */
    public function store(StoreFaseRequest $request)
    {

        $fase = $this->faseRepository->create($request->all());

        Notification::success('Fase Program kerja berhasil disimpan.');

        return redirect()->back();

    }

    /*
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $action = "edit";

        $programKerja = $this->programKerjaRepository->all();

        $satkers = $this->satkerRepository->all();

        $fase = $this->faseRepository->find($id);

        $route = Route('admin.faseProgramKerja.update', ['id' => $id]);

        return view('admin.faseProgramKerja.form', compact('programKerja', 'fase', 'satkers', 'action', 'route'));
    }

    /*
     * Melakukan update data
     */
    public function update(StoreFaseRequest $request, $id)
    {
        $this->faseRepository->update($request->all(), $id);

        Notification::success('Data berhasil dirubah');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Res
     */
    public function destroy($id)
    {
        $this->faseRepository->delete($id);
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

        $this->faseRepository->delete((int)$id);

      }

      return redirect()->back();

    }
}
