<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Comments;
use App\Enum\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\CommentsRepositoryEloquent;

class CommentsController extends AdminController
{

    protected $commentsRepository;

    /**
     * AuditTrailController constructor.
     */
    public function __construct(CommentsRepositoryEloquent $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;

        $this->authorize(Permission::MANAGE_COMMENT()->getKey());

        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $comments = $this->commentsRepository->paginate(20);
      return view('admin.comments.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        $ids = explode(',', $ids);
        Comments::destroy($ids);

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

        $this->commentsRepository->delete((int)$id);

      }

      return redirect()->back();

    }


}
