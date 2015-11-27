<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\FaseRepositoryEloquent;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use App\Repositories\UjiPublikRepositoryEloquent;
use Feed;
use Route;
use Cache;

class SiteController extends Controller
{

    protected $ujiPublikRepository;
    protected $programKerjaUsulanRepository;
    protected $programKerjaRepository;

    public function __construct(
        ProgramKerjaUsulanRepositoryEloquent $programKerjaUsulanRepository,
        FaseRepositoryEloquent $programKerjaRepository,
        UjiPublikRepositoryEloquent $ujiPublikRepository
    ) {

        $this->programKerjaRepository = $programKerjaRepository;

        $this->programKerjaUsulanRepository = $programKerjaUsulanRepository;

        $this->ujiPublikRepository = $ujiPublikRepository;
    }

    public function getKontak()
    {
        return view('site.kontak');
    }

    public function getTentang()
    {
        return view('site.tentang');
    }

    public function postQuickForm(Request $request)
    {
        return redirect('auth/login?next=' . route('proker-usulan.create'))->withCookie(cookie('quick-form', $request->only(['name', 'description']), 10));
    }

    public function getRss()
    {

        if (Cache::has('rss.sorted')) {

            $container = Cache::get('rss.sorted');

        } else {

            $ujiPubliks = $this->ujiPublikRepository->scopeQuery(function ($query) {
                return $query->orderBy('created_at', 'desc');
            })->all();

            $programKerjaUsulans = $this->programKerjaRepository->scopeQuery(function ($query) {
                return $query->orderBy('created_at', 'desc');
            })->all();

            $programKerjas = $this->programKerjaRepository->scopeQuery(function ($query) {
                return $query->orderBy('created_at', 'desc');
            })->all();

            $container = [];

            foreach ($ujiPubliks as $data) {

                $container[] =
                    [
                        'title'      => $data->present('name'),
                        'creator'    => $data->present('creator_name'),
                        'url'        => $data->present('url'),
                        'deskripsi'  => $data->present('materi'),
                        'created_at' => $data->present('created_at'),
                        'pubDate'    => $data->present('created_for_human'),

                    ];
            }

            foreach ($programKerjaUsulans as $data) {

                $container[] =
                    [
                        'title'      => $data->present('name'),
                        'creator'    => $data->present('creator_name'),
                        'url'        => $data->present('url'),
                        'deskripsi'  => $data->present('description'),
                        'created_at' => $data->present('created_at'),
                        'pubDate'    => $data->present('created_for_human'),

                    ];
            }

            foreach ($programKerjas as $data) {

                $container[] =
                    [
                        'title'      => $data->present('name'),
                        'creator'    => $data->present('creator_name'),
                        'url'        => $data->present('url'),
                        'deskripsi'  => $data->present('description'),
                        'created_at' => $data->present('created_at'),
                        'pubDate'    => $data->present('created_for_human'),

                    ];
            }


            $sorted = [];

            foreach ($container as $key => $row) {
                $sorted[$key] = $row['created_at'];
            }

            array_multisort($sorted, SORT_DESC, $container);

            Cache::put('rss.sorted', $container, 1440);
        }

        /* endif */

        $feed = Feed::make();
        $feed->setCache(0, 'openKominfo');
        $feed->title = 'Open Kominfo';
        $feed->description = 'Layanan partisipasi publik dalam membangun program kerja Kominfo yang berkualitas';
        $feed->link = action('SiteController@getRss');
        $feed->setDateFormat('datetime');
        $feed->pubdate = $container[0]['created_at'];
        $feed->lang = 'id';
        $feed->setShortening(true);
        $feed->setTextLimit(100);

        foreach ($container as $data) {
            $feed->add(
                $data['title'],
                $data['creator'],
                $data['url'],
                $data['created_at'],
                $data['deskripsi']
            );
        }


        return $feed->render('atom', 0, 'openKominfo');

    }
}
