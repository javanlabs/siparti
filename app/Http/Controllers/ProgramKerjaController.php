<?php

namespace App\Http\Controllers;

use App\Repositories\FaseRepositoryEloquent;
use App\Http\Requests;

class ProgramKerjaController extends Controller
{
    /**
     * @var ProgramKerjaRepositoryEloquent
     */
    private $repository;


    /**
     * FaseController constructor.
     * @param FaseRepositoryEloquent $repository
     */
    public function __construct(FaseRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function getIndex()
    {
        return redirect('program-kerja/sedang-berjalan');
    }

    public function getBerjalan()
    {
        return view('program_kerja.berjalan');
    }

    public function getUsulan()
    {
        return view('program_kerja.usulan');
    }

    public function getArsip()
    {
        $programKerja = $this->repository->paginate();

        return view('program_kerja.arsip', compact('programKerja'));
    }

}
