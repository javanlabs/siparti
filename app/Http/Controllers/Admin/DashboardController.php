<?php

namespace App\Http\Controllers\Admin;

use DB;
use Cache;
use App\Enum\FaseType;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Entities\Fase;
use App\Entities\Comments;
use App\Entities\UjiPublik;
use App\Entities\ProgramKerjaUsulan;
use App\Entities\Votee;
use App\Repositories\FaseRepositoryEloquent;
use App\Repositories\ProgramKerjaRepositoryEloquent;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use App\Repositories\UjiPublikRepositoryEloquent;


class DashboardController extends AdminController
{

    protected $faseRepository;
    protected $programKerjaRepository;
    protected $programKerjaUsulanRepository;
    protected $ujiPublikRepository;

    /*
    *
    * DasboardController Constructor
    */
    public function __construct(
        FaseRepositoryEloquent $faseRepository,
        ProgramKerjaRepositoryEloquent $programKerjaRepository,
        ProgramKerjaUsulanRepositoryEloquent $programKerjaUsulanRepository,
        UjiPublikRepositoryEloquent $ujiPublikRepository
    ) {

        parent::__construct();

        $this->faseRepository = $faseRepository;

        $this->programKerjaRepository = $programKerjaRepository;

        $this->programKerjaUsulanRepository = $programKerjaUsulanRepository;

        $this->ujiPublikRepository = $ujiPublikRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $allCountData = $this->getCommonDataCount();

        $popularData = $this->getPopuler();

        $avaibleYears = $this->getAvaibleYears();

        $yearNow = (string)$request->query('year', date('Y'));

        $faseData = $this->getDataCount("App\Entities\Fase", 'created_at', $yearNow);

        $commentsData = $this->getDataCount("App\Entities\Comments", 'updated_at', $yearNow);

        $usulanData = $this->getDataCount("App\Entities\ProgramKerjaUsulan", 'created_at', $yearNow);

        $ujiPublikData = $this->getDataCount("App\Entities\UjiPublik", 'created_at', $yearNow);

        $voteUpData = $this->getVoteCount("App\Entities\Votee", 'updated_at', $yearNow, 1);

        $voteDownData = $this->getVoteCount("App\Entities\Votee", 'updated_at', $yearNow, -1);

        $max1 = $this->getMaxValue($faseData, $usulanData, $ujiPublikData);

        $max2 = $this->getMaxValue($commentsData, $voteUpData, $voteDownData);

        return view('admin.dashboard.index',
            compact('max1', 'max2', 'avaibleYears', 'popularData', 'allCountData', 'yearNow', 'faseData', 'usulanData',
                'ujiPublikData', 'commentsData', 'voteUpData', 'voteDownData'));
    }

    /*
    *   $entities : nama suatu class model eloquent beserta full namespace
    *   $column : colom yang akan dilakukan cek
    *   $year : tahun yang akan diambil
    *   return [1,2,3,4,6] array dari bulan dalam setahun yang memiliki enttitas yang dicari, tidak ada duplikasi
    */
    public function getArrayOfMonths($entitity, $column, $year)
    {
        $resultArray = [];

        $monthsEveryYear = [];

        $arrayMonth = [];

        $result = [];

        $class = $entitity;

        $months = $class::where(DB::raw('YEAR(' . $column . ')'), '=', $year)->get();

        foreach ($months as $month) {

            $arrayMonth[] = date("n", strtotime($month->created_at));
        }

        $arrayMonth = array_unique($arrayMonth);

        return $arrayMonth;
    }

    public function getDataCount($entity, $column, $year)
    {

        $cacheKey = $entity . $year . "." . "count";

        if (Cache::has($cacheKey)) {

            $result = Cache::get($cacheKey);

        } else {

            $arrayMonths = $this->getArrayOfMonths($entity, $column, $year);

            $monthsEveryYear[$year] = $arrayMonths;

            $container = $this->getContainer($arrayMonths, $column, $entity, $year);

            $result = $this->parseResult($container);

            Cache::put($cacheKey, $result, 60);
        }

        return $result;
    }

    public function getContainer($arrayMonth, $column, $entity, $year, $value = null)
    {
        $container = [];

        $class = $entity;

        if (is_null($value)) {

            foreach ($arrayMonth as $month) {
                
                $result = $class::where(DB::raw('MONTH(' . $column . ')'), '=', $month)
                                        ->where(DB::raw('YEAR(' . $column . ')'), '=', $year)->get();
                
                $count = $result->count();

                $container[$month] = $count;

            }

        } else {

            foreach ($arrayMonth as $month) {

                $result = $class::where(DB::raw('MONTH(' . $column . ')'), '=', $month)
                                ->where(DB::raw('YEAR(' . $column . ')'), '=', $year)
                                ->where('value', '=', $value)->get();

                $count = $result->count();

                $container[$month] = $count;

            }
        }

        return $container;
    }

    /*
    *
    *
    */
    public function getVoteCount($entity, $column, $year, $voteValue)
    {

        $arrayMonths = $this->getArrayOfMonths($entity, $column, $year);

        $monthsEveryYear[$year] = $arrayMonths;

        $container = $this->getContainer($arrayMonths, $column, $entity, $year, $voteValue);

        $result = $this->parseResult($container);

        return $result;
    }


    /*
    *   example $container => [1 => 100, 3  => 300, 6 => 800]
    *
    *   setiap anggota array mewakili nilai setiap bulan dari tahun
    *   return [1,1,1,1,1,1,1,1,1,1,1,1] <- 12
    */

    public function parseResult($container)
    {
        $monthsArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $resultArray = [];

        foreach ($monthsArray as $month) {

            if (array_key_exists($month, $container)) {

                $resultArray[$month] = $container[$month];

            } else {

                $resultArray[$month] = 0;
            }
        }

        return $resultArray;
    }

    public function getCommonDataCount()
    {

        if (Cache::has('fase.count')) {

            $faseCount = Cache::get('fase.count');

        } else {

            $faseData = $this->faseRepository->all();

            $faseCount = $faseData->count();

            Cache::put('fase.count', $faseCount, 60);
        }

        if (Cache::has('usulan.count')) {

            $usulanCount = Cache::get('usulan.count');

        } else {

            $usulanData = $this->programKerjaUsulanRepository->all();

            $usulanCount = $usulanData->count();

            Cache::put('usulan.count', $faseCount, 60);
        }

        if (Cache::has('programKerja.count')) {

            $programKerjaCount = Cache::get('programKerja.count');

        } else {

            $programKerjaData = $this->programKerjaRepository->all();

            $programKerjaCount = $programKerjaData->count();

            Cache::put('programKerja.count', $programKerjaCount, 60);
        }


        if (Cache::has('ujiPublik.count')) {

            $ujiPublikCount = Cache::get('ujiPublik.count');

        } else {

            $ujiPublikData = $this->ujiPublikRepository->all();

            $ujiPublikCount = $ujiPublikData->count();

            Cache::put('ujiPublik.count', $ujiPublikCount, 60);
        }

        $allCountData = [$ujiPublikCount, $faseCount, $usulanCount, $programKerjaCount];

        return $allCountData;
    }

    public function getPopuler()
    {
        
        if(Cache::has('popular.ujiPublik')) {

            $container1 = Cache::get('popular.ujiPublik');
        
        } else {

            $container1 = [];

            $popularUjiPublik = UjiPublik::with('creator')
                                            ->orderBy('vote_up', "DESC")
                                            ->limit(5)
                                            ->get();

            foreach($popularUjiPublik as $data) {

                $container1[] = [ 
                    'url' => route('uji-publik.show', ['id' => $data->id]), 
                    'name' => $data->name, 
                    'creator_name' => $data->creator->name
                ];
                
            }

            Cache::put('popular.ujiPublik', $container1, 60);

        }

        if(Cache::has('popular.usulan')) {

            $container2 = Cache::get('popular.usulan');
        
        } else {

            $container2 = [];

            $popularUsulan = ProgramKerjaUsulan::with('creator')
                                                ->orderBy('vote_up', "DESC")
                                                ->limit(5)
                                                ->get();

            foreach($popularUsulan as $data) {

                $container2[] = [
                    'url' => route("proker-usulan.show", ['id' => $data->id]), 
                    'name' => $data->name, 
                    'creator_name' => $data->creator->name
                ];
               
            }

            Cache::put('popular.usulan', $container2, 60);

        } 

        if(Cache::has('popular.fase')) {

            $container3 = Cache::get('popular.fase');
        
        } else {

            $container3 = [];

            $popularFase = Fase::with('programKerja')
                                ->orderBy('vote_up', "DESC")
                                ->limit(5)
                                ->get();

            foreach($popularFase as $data) {

                $container3[] = [
                    'url' =>  route("proker.show", ['id' => $data->id]), 
                    'name' => $data->programKerja->name, 
                    'status' => (new FaseType($data->type))->label(),
                ];
                
            }
            Cache::put('popular.fase', $container3, 60);
        }  
        
        $data = [
            'popularUsulan' => $container2, 
            'popularUjiPublik' => $container1, 
            'popularFase' => $container3
        ];

        return $data;
    }

    public function getAvaibleYears()
    {

        if (Cache::has('avaibleYears')) {

            $yearsArray = Cache::get('avaibleYears');

        } else {

            $yearsArray = [];

            $years = $this->programKerjaRepository->all('created_at');

            foreach ($years as $year) {

                $yearsArray[] = date('Y', strtotime($year->created_at));
            }

            $yearsArray = array_unique($yearsArray);

            Cache::put('avaibleYears', $yearsArray, 720);
        }

        return $yearsArray;
    }

    public function getMaxValue($array1, $array2, $array3)
    {

        $mergedArray = array_merge($array1, $array2, $array3);

        sort($mergedArray);

        $max = $mergedArray[count($mergedArray) - 1];

        $addNumber = $max % 10;

        $evenNumber = $max + (10 - $addNumber);

        return $evenNumber;
    }
}
