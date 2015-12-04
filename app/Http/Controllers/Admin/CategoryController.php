<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\ProgramKerjaRepositoryEloquent;
use App\Repositories\ProgramKerjaUsulanRepositoryEloquent;
use App\Http\Requests\StoreSatkerRequest;
use Notification;


class CategoryController extends AdminController
{
    protected $categoryRepository;
    protected $prokerRepository;
    protected $prokerUsulanRepository;

    public function __construct(CategoryRepositoryEloquent $categoryRepository,
                                ProgramKerjaRepositoryEloquent $prokerRepository,
                                ProgramKerjaUsulanRepositoryEloquent $prokerUsulanRepository)
    {
        parent::__construct();

        $this->categoryRepository = $categoryRepository;
        $this->prokerRepository = $prokerRepository;
        $this->prokerUsulanRepository = $prokerUsulanRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allSubCategories = $this->categoryRepository->getCategories();

        return view('admin.category.index', compact('allSubCategories'));
        var_dump($allSubCategories);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = "create";

        $route = Route('admin.category.store');

        $parent = $this->categoryRepository->getParent();

        return view('admin.category.form', compact('action', 'route', 'parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSatkerRequest $request)
    {
        $this->categoryRepository->create( $request->all() );

        Notification::success('Program kerja berhasil disimpan.');

        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = "edit";

        $category = $this->categoryRepository->find($id);
        if($category->parent_id==0){
            $child = "Sebagai Parent";
        }
        else{
            $child = $this->categoryRepository->find($category->parent_id);
            $child = $child->name;
        }

        $listparent = $this->categoryRepository->getParent();

        $route = Route('admin.category.update', ['id' => $id]);

        return view('admin.category.form', compact('category', 'action', 'route', 'listparent', 'child'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSatkerRequest $request, $id)
    {
        $this->categoryRepository->update($request->all(), $id);

        Notification::success('Data berhasil diubah');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);
        $proker = $this->prokerRepository->findByField('category_id',$id)->count();
        $prokerUsulan = $this->prokerUsulanRepository->findByField('category_id',$id)->count();

        if($proker!=0 AND $prokerUsulan!=0){

            Notification::error('Data masih di pakai');

            return redirect()->back();

        }
        else{
            if($category->parent_id==0){
                $childs = $this->categoryRepository->findByField('parent_id',$id);

                foreach ($childs as $child) {
                    $this->categoryRepository->delete($child->id);
                }
                $this->categoryRepository->delete($id);

                Notification::success('Data kategori dan sub kategori berhasil dihapus');
                return redirect()->back();
            }
            else{
                $this->categoryRepository->delete($id);

                Notification::success('Data berhasil dihapus');

                return redirect()->back();
            }
        }
    }
}
