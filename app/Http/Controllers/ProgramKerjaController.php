<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProgramKerjaUsulanRequest;
use App\Repositories\FaseRepositoryEloquent;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use App\Repositories\SatkerRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Krucas\Notification\Facades\Notification;



class ProgramKerjaController extends Controller
{

    protected $faseRepository;

    protected $satkerRepository;

    protected $programKerjaUsulanRepository;


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

    public function viewTambahKerjaUsulanForm(Request $request)
    {
        
       return view("program_kerja.tambah");
    }

    public function tambahKerjaUsulan(CreateProgramKerjaUsulanRequest $request)
    {

        $this->programKerjaUsulanRepository->create($request->all());
        Notification::success('Usulan Program Kerja Berhasil Disimpan');
        return redirect()->back();


    }

}