<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CommentsRepositoryEloquent;

class UjiPublikController extends Controller
{

    protected $ujiPublikRepository;

    /**
     * AuditTrailController constructor.
     */
    public function __construct(CommentsRepositoryEloquent $ujiPublikRepository)
    {
        $this->ujiPublikRepository = $ujiPublikRepository;

        $this->authorize('manage-uji-public');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $ujiPublik = $this->ujiPublikRepository->paginate(20);
      return view('admin.ujiPublik.index', compact('ujiPublik'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ujiPublikRepository->delete($id);
        return redirect()->back();

    }

    /**
     * Menghapus multiple comment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMultiple(Request $request)
    {

      $toBeDeletedIds = $request->get('deletedId');

      foreach ($toBeDeletedIds as $id) {

        $this->ujiPublikRepository->delete((int)$id);

      }

      return redirect()->back();

    }


}
