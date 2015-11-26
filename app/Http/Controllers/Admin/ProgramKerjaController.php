<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreProgramKerjaRequest;
use App\Repositories\SatkerRepositoryEloquent;
use App\Repositories\ProgramKerjaRepositoryEloquent;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use App\Repositories\ProgramKerjaDanUsulanRelationRepositoryEloquent;
use Notification;
use Auth;

class ProgramKerjaController extends AdminController
{
    protected $satkerRepository;

    protected $programKerjaRepository;

    protected $programKerjaUsulanRepository;

    protected $programKerjaDanUsulanRelationRepository;

    /**
     * ProgramKerjaController constructor.
     */
    public function __construct(
            SatkerRepositoryEloquent $satkerRepository,
            ProgramKerjaRepositoryEloquent $programKerjaRepository,
            ProgramKerjaUsulanRepositoryEloquent $programKerjaUsulanRepository,
            ProgramKerjaDanUsulanRelationRepositoryEloquent $programKerjaDanUsulanRelationRepository
    )
    {

        $this->satkerRepository = $satkerRepository;

        $this->programKerjaRepository = $programKerjaRepository;

        $this->programKerjaUsulanRepository = $programKerjaUsulanRepository;

        $this->programKerjaDanUsulanRelationRepository = $programKerjaDanUsulanRelationRepository;

        $this->authorize('manage-fase-program-kerja');


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $programKerja = $this->programKerjaRepository->paginate(20);

      return view('admin.programKerja.index', compact('programKerja'));
    }

    /*
    *   Menampilakn form create
    */
    public function create(Request $request)
    {

        $action = "create";

        $route = Route('admin.programKerja.store');

        $satkers = $this->satkerRepository->all();

        return view('admin.programKerja.form', compact('satkers', 'action', 'route'));
    }

    /*
    *
    *   Record program kerja baru
    */
    public function store(StoreProgramKerjaRequest $request)
    {
        $attributes = [];

        if ($request->input('satkerChoice') == "baru") {


            $satkerName = ['name' => $request->input('satuanKerjaBaru')];

            $satker = $this->satkerRepository->create($satkerName);

            $attributes = [
                'name'          => $request->input('name'),
                'satker_id'     => $satker->id,
                'creator_id'    => Auth::user()->id
            ];

        } else {

            $attributes = [
                'name'          => $request->input('name'),
                'satker_id'     => $request->input('satker_id'),
                'creator_id'    => Auth::user()->id
            ];
        }

        $this->programKerjaRepository->create($attributes);

        Notification::success('Fase Program kerja berhasil disimpan.');

        return redirect()->back();

    }

    /*
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $action = "edit";

        $satkers = $this->satkerRepository->all();

        $programKerja = $this->programKerjaRepository->find($id);

        $route = Route('admin.programKerja.update', ['id' => $id]);

        return view('admin.programKerja.form', compact('programKerja', 'satkers', 'action', 'route'));
    }

    /*
     * Melakukan update data
     */
    public function update(StoreProgramKerjaRequest $request, $id)
    {
        $attributes = $this->getAttributes($request);

        $this->programKerjaRepository->update($attributes, $id);

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

    public function getAttributes(Request $request)
    {
        $attributes = [];

        if ($request->input('satkerChoice') == "baru") {

            $satkerName = ['name' => $request->input('satuanKerjaBaru')];

            $satker = $this->satkerRepository->create($satkerName);

            $attributes = [
                'name'          => $request->input('name'),
                'satker_id'     => $satker->id,
                'creator_id'    => Auth::user()->id
            ];

        } else {

            $attributes = [
                'name'          => $request->input('name'),
                'satker_id'     => $request->input('satker_id'),
                'creator_id'    => Auth::user()->id
            ];
        }

        return $attributes;
    }

    /**
    *  Menampilkan form buat program kerja baru berdasar program kerja usulan
    *
    *  @param int $usulan_id
    *  @return \Illuminate\Http\Response
    */
    public function createProkerBasedUsulan(Request $request)
    {

        $usulan_id = $request->query('usulan_id');

        $satkers = $this->satkerRepository->all();

        $programKerjaUsulan = $this->programKerjaUsulanRepository->find($usulan_id);

        return view('admin.programKerja.formBasedUsulan', compact('programKerjaUsulan', 'satkers'));
    }

    /**
    *  Menyimpan data program kerja berdasar usulan
    *
    *  @return \Illuminate\Http\Response
    */
    public function storeProkerBasedUsulan(StoreProgramKerjaRequest $request)
    {
        $attributes = $this->getAttributes($request);

        $usulan_id = $request->input('usulan_id');

        $programKerja = $this->programKerjaRepository->create($attributes);

        $relationData = ['usulan_id' => $usulan_id, 'program_kerja_id' => $programKerja->id];

        $this->programKerjaDanUsulanRelationRepository->create($relationData);

        Notification::success('Program Kerja Berhasil Dibuat');

        return redirect()->back();
    }


}
