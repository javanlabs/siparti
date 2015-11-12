<?php

namespace App\Http\Controllers;

use App\Criteria\ProgramKerjaSearchCriteria;
use App\Repositories\FaseRepositoryEloquent;
use App\Http\Requests;
use App\Repositories\SatkerRepositoryEloquent;

class ProgramKerjaController extends Controller
{

    protected $faseRepository;

    protected $satkerRepository;


    /**
     * FaseController constructor.
     * @param FaseRepositoryEloquent $faseRepository
     */
    public function __construct(FaseRepositoryEloquent $faseRepository, SatkerRepositoryEloquent $satkerRepository)
    {
        $this->faseRepository = $faseRepository;
        $this->satkerRepository = $satkerRepository;
    }

    public function getIndex()
    {
        return redirect('program-kerja/sedang-berjalan');
    }

    public function arsip()
    {
        $fase = $this->faseRepository->lists();
        $satker = $this->satkerRepository->lists();
        $year = $this->faseRepository->yearOptions('-- Semua Tahun --');

        $programKerja = $this->faseRepository->paginateArsip();

        return view('program_kerja.arsip', compact('programKerja', 'satker', 'fase', 'year'));
    }

    public function berjalan()
    {
        $fase = $this->faseRepository->lists();
        $satker = $this->satkerRepository->lists();
        $year = $this->faseRepository->yearOptions('-- Semua Tahun --');

        $programKerja = $this->faseRepository->paginateBerjalan();

        return view('program_kerja.berjalan', compact('programKerja', 'satker', 'fase', 'year'));

    }

    public function usulan()
    {
        return view('program_kerja.usulan');
    }

    public function show($id)
    {
        $programKerja = $this->faseRepository->find($id);

        return view('program_kerja.show', compact('programKerja'));
    }
}
