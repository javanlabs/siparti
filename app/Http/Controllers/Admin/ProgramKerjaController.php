<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreProgramKerjaRequest;
use App\Http\Controllers\Controller;
use App\Repositories\SatkerRepositoryEloquent;
use App\Repositories\ProgramKerjaRepositoryEloquent;
use Notification;
use Auth;

class ProgramKerjaController extends Controller
{

    
    
    protected $satkerRepository;
    
    protected $programKerjaRepository;
    
    /**
     * ProgramKerjaController constructor.
     */
    public function __construct(
            SatkerRepositoryEloquent $satkerRepository, 
            ProgramKerjaRepositoryEloquent $programKerjaRepository
    )
    {
        
        $this->satkerRepository = $satkerRepository;
        
        $this->programKerjaRepository = $programKerjaRepository;
        
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


}
