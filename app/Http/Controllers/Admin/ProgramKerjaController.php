<?php

namespace App\Http\Controllers\Admin;

use App\Entities\ProgramKerja;
use App\Enum\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreProgramKerjaRequest;
use App\Repositories\SatkerRepositoryEloquent;
use App\Repositories\ProgramKerjaRepositoryEloquent;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use App\Repositories\ProgramKerjaDanUsulanRelationRepositoryEloquent;
use App\Entities\ProgramKerjaDanUsulanRelation;
use Notification;
use Auth;
use Validator;

class ProgramKerjaController extends AdminController
{
    protected $satkerRepository;

    protected $programKerjaRepository;

    protected $programKerjaUsulanRepository;


    /**
     * ProgramKerjaController constructor.
     */
    public function __construct(
        SatkerRepositoryEloquent $satkerRepository,
        ProgramKerjaRepositoryEloquent $programKerjaRepository,
        ProgramKerjaUsulanRepositoryEloquent $programKerjaUsulanRepository
    ) {

        $this->satkerRepository = $satkerRepository;

        $this->programKerjaRepository = $programKerjaRepository;

        $this->programKerjaUsulanRepository = $programKerjaUsulanRepository;

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
        $programKerja = $this->programKerjaRepository->with(['faseSekarang', 'satker', 'creator'])->paginate(20);

        return view('admin.programKerja.index', compact('programKerja'));
    }

    /*
    *   Menampilakn form create
    */
    public function create(Request $request)
    {

        $action = "create";

        $usulan = $this->programKerjaUsulanRepository->all();

        $route = Route('admin.programKerja.store');

        $satkers = $this->satkerRepository->all();

        return view('admin.programKerja.form', compact('satkers', 'action', 'route', 'usulan'));

    }

    /*
    *
    *   Record program kerja baru
    */
    public function store(StoreProgramKerjaRequest $request)
    {

        $attributes = $this->getAttributes($request);

        $programKerja = $this->programKerjaRepository->create($attributes);

        if ($request->input('usulanId')) {

            $usulanIds = $request->input('usulanId');

            $programKerja->usulan()->attach($usulanIds);
        }

        Notification::success('Program kerja berhasil disimpan');

        return redirect()->route('admin.programKerja.index');

    }

    /*
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $action = "edit";

        $usulan = $this->programKerjaUsulanRepository->all();

        $satkers = $this->satkerRepository->all();

        $programKerja = $this->programKerjaRepository->find($id);

        $route = Route('admin.programKerja.update', ['id' => $id]);

        return view('admin.programKerja.form', compact('programKerja', 'satkers', 'action', 'route', 'usulan'));
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
     * @param  int $ids
     * @return \Illuminate\Http\Res
     */
    public function destroy($ids)
    {
        $ids = explode(',', $ids);
        ProgramKerja::destroy($ids);

        return redirect()->back();

    }

    /**
     * Menghapus multiple comment
     *
     * @param  int $id
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
                'name'       => $request->input('name'),
                'satker_id'  => $satker->id,
                'creator_id' => Auth::user()->id
            ];

        } else {

            $attributes = [
                'name'       => $request->input('name'),
                'satker_id'  => $request->input('satker_id'),
                'creator_id' => Auth::user()->id
            ];
        }

        return $attributes;
    }

    /**
     *  Menampilkan form buat program kerja baru berdasar program kerja usulan
     *
     * @param int $usulan_id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function storeProkerBasedUsulan(StoreProgramKerjaRequest $request)
    {
        $attributes = $this->getAttributes($request);

        $usulan_id = $request->input('usulan_id');

        $model = $this->programKerjaRepository->create($attributes);

        $model->usulan()->attach($usulan_id);

        Notification::success('Program Kerja Berhasil Dibuat');

        return redirect()->back();
    }

    /*
    *   Handle ajax request, delete relation with program kerja usulan
    */
    public function deleteRelation(Request $request)
    {

        $usulanId = $request->input('usulan_id');

        $programKerjaId = $request->input('program_kerja_id');

        $model = $this->programKerjaRepository->find($programKerjaId);

        $model->usulan()->detach($usulanId);

        return json_encode(['message' => 'success']);

    }

    /*
    *   handle ajax requesy, Add Relation qith program kerja usulan
    */
    public function addRelation(Request $request)
    {

        $usulanId = $request->input('usulan_id');

        $programKerjaId = $request->input('program_kerja_id');

        $model = $this->programKerjaRepository->find($programKerjaId);

        $model->usulan()->attach($usulanId);

        return json_encode(['message' => 'success']);
    }

    private function extractId($array)
    {
        $idArray = [];

        foreach ($array as $data) {

            $idArray[] = $data->usulan_id;
        }

        return $idArray;
    }


}
