<?php
namespace App\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class UjiPublikSearchCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if ($keyword = $this->request->get('nama')) {
            $model = $model->search($keyword, ['name']);
        }

        if ($keyword = $this->request->get('tahun')) {
            $model = $model->byYear($keyword);
        }

        return $model;
    }
}
