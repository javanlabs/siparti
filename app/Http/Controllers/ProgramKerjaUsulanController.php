<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsulanProgramKerja;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use Krucas\Notification\Facades\Notification;

class ProgramKerjaUsulanController extends Controller
{

    protected $programKerjaUsulanRepository;


    public function __construct(ProgramKerjaUsulanRepositoryEloquent $programKerjaUsulanRepository)
    {
        $this->programKerjaUsulanRepository = $programKerjaUsulanRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usulan = $this->programKerjaUsulanRepository->paginate(18);

        return view('program_kerja_usulan.index', compact('usulan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('program_kerja_usulan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UsulanProgramKerja $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsulanProgramKerja $request)
    {
        $usulanProgramKerja = $this->programKerjaUsulanRepository->create($request->only(['name', 'manfaat', 'lokasi', 'target', 'description']));
        $this->programKerjaUsulanRepository->attachDocument($usulanProgramKerja, $request->file('file'));

        Notification::success('Usulan program kerja berhasil disimpan.');
        return redirect()->route('proker-usulan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usulanProker = $this->programKerjaUsulanRepository->find($id);
        $documents = $this->programKerjaUsulanRepository->getDocuments($usulanProker);

        return view('program_kerja_usulan.show', compact('usulanProker', 'documents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
