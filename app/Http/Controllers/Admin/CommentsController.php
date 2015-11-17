<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CommentsRepositoryEloquent;

class CommentsController extends Controller
{

    protected $commentsRepository;

    /**
     * AuditTrailController constructor.
     */
    public function __construct(CommentsRepositoryEloquent $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;

        $this->authorize('manage-comments');
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
    public function destroy($id)
    {
        $this->commentsRepository->delete($id);
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
