<?php

namespace App\Http\Controllers\my;

use Illuminate\Http\Request;
use App\Criteria\ProgramKerjaUsulanByUserCriteria;
use App\Http\Requests;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use App\Http\Controllers\Controller;

class ProgramKerjaUsulanController extends Controller
{
    protected $prokerusulan;
    public function __construct(ProgramKerjaUsulanRepositoryEloquent $prokerusulan)
    {

        $this->prokerusulan = $prokerusulan;
    }
    /**
     * Display a listing of the Program Kerja Usulan for spesific user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usulan = $this->prokerusulan->pushCriteria(new ProgramKerjaUsulanByUserCriteria())->paginate(20);
        
        return view('my.program_kerja_usulan.index', compact('usulan'));
    }
    
}
