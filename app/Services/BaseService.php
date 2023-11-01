<?php


namespace App\Services;


use App\Repositories\IRepository;
use Illuminate\Http\Request;

class BaseService implements IService
{
    /**
     * @var IRepository $repository
     */
    protected $repository;

    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @var array $with
     */
    protected $with = [];

    /**
     * BaseService constructor.
     *
     * @param IRepository $repository
     */
    public function __construct(IRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }


    public function destroy($id)
    {
        $this->repository->destroy($id);
    }

    public function show($id)
    {
        return $this->repository->find($id, $this->with);
    }

    public function store($data)
    {
        $record = $this->repository->create($data);
        return $record;
    }

    public function update($id, $data)
    {
        $this->repository->update($id, $data);
        $record = $this->repository->find($id, $this->with);
        return $record;
    }

    public function get()
    {
        return $this->repository->get();
    }
}
