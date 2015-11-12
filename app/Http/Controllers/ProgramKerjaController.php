<?php

namespace App\Http\Controllers;

use App\Repositories\FaseRepositoryEloquent;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\SatkerRepositoryEloquent;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use Illuminate\Support\Facades\Session;


class ProgramKerjaController extends Controller
{

    protected $faseRepository;

    protected $satkerRepository;

    protected $programKerjaRepository;


    /**
     * FaseController constructor.
     * @param FaseRepositoryEloquent $faseRepository
     */
    public function __construct(FaseRepositoryEloquent $faseRepository, SatkerRepositoryEloquent $satkerRepository, ProgramKerjaUsulanRepositoryEloquent $programKerjaUsulanRepositoyEloquent)
    {
        $this->faseRepository = $faseRepository;
        $this->satkerRepository = $satkerRepository;
        $this->programKerjaUsulanRepository = $programKerjaUsulanRepositoyEloquent;
    }

    public function getIndex()
    {
        return redirect('program-kerja/sedang-berjalan');
    }

    public function berjalan()
    {
        $programKerja = $this->faseRepository->paginate();
        $satker = $this->satkerRepository->lists();
        $fase = $this->faseRepository->lists();

        return view('program_kerja.berjalan', compact('programKerja', 'satker', 'fase'));
    }

    public function usulan()
    {
        return view('program_kerja.usulan');
    }

    public function arsip()
    {
        $programKerja = $this->faseRepository->paginate();
        $satker = $this->satkerRepository->lists();
        $fase = $this->faseRepository->lists();

        return view('program_kerja.arsip', compact('programKerja', 'satker', 'fase'));
    }

    public function show($id)
    {
        $programKerja = $this->faseRepository->find($id);

        return view('program_kerja.show', compact('programKerja'));
    }

    public function tambah(Request $request)
    {
        
        if ($request->isMethod('post')) {

            $this->validate($request, 
                [
                    'namaProgram' => 'required',
                    'instansiTerkait' => 'required',
                    'description' => 'required',
                    'file' => 'required'
                ]
            );

            $this->programKerjaUsulanRepository->create($request->all());

            Session::flash('flash_message', 'Usulan Program Kerja Berhasil Disimpan');


        }
        
        return view("program_kerja.tambah");
    }
}
