<?php namespace Siparti\UjiPublik\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Siparti\UjiPublik\Http\Requests\Store;
use Siparti\UjiPublik\Http\Requests\Update;
use Siparti\UjiPublik\Repositories\RepositoryInterface;

class Controller extends BaseController
{

	protected $repository;

	function __construct(RepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Display a listing of the UjiPublik.
	 *
	 * @return Response
	 */
	public function index()
	{
		$collection = $this->repository->paginate();

		return view('uji-publik::index', compact('collection'));
	}

	/**
	 * Show the form for creating a new UjiPublik.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('uji-publik::create');
	}

	/**
	 * Store a newly created UjiPublik in storage.
	 *
	 * @param CreateUjiPublikRequest $request
	 *
	 * @return Response
	 */
	public function store(Store $request)
	{
		$input = $request->all();

		$this->repository->create($input);

		\Notification::success('uji-publik::store.success');

		return redirect()->route('uji-publik.index');
	}

	/**
	 * Display the specified UjiPublik.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$item = $this->repository->find($id);

		return view('uji-publik::show', compact('item'));
	}

	/**
	 * Show the form for editing the specified UjiPublik.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$item = $this->repository->find($id);

		return view('uji-publik::edit', compact('item'));
	}

	public function update($id, Update $request)
	{
		$this->repository->update($request->all(), $id);

		\Notification::success('uji-publik::update.success');

		return redirect()->route('uji-publik.index');
	}

	/**
	 * Remove the specified UjiPublik from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->repository->delete($id);

		\Notification::success('uji-publik::destroy.success');

		return redirect()->route('uji-publik.index');
	}
}
