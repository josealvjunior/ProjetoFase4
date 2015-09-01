<?php

namespace project\Http\Controllers;

use Illuminate\Http\Request;

use project\Http\Requests;
use project\Repositories\ProjectNotesRepository;
use project\Services\ProjectNotesService;

class ProjectNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    /**
     * @var ProjectNotesRepository
     */
    private $repository;

    /**
     * @var ProjectNotesService
     */
    private $service;

    public function __Construct(ProjectNotesRepository $repository, ProjectNotesService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, $noteId)
    {
        if($this->checkProjectPermissions($id)==false){
            return ['error'=> 'Acesso Negado'];        }
        return $this->repository->findWhere(['project_id'=>$id, 'id'=>$noteId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id, $noteId)
    {
       if($this->checkProjectOwner($id)){
           return ['error'=> 'Acesso Negado'];
       }
        return $this->service->update($request->all(),$noteId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($noteId, $id)
    {
        if($this->checkProjectOwner($id) == false){
            return ['error'=> 'Acesso Negado'];
        }
        $this->repository->find($noteId)->delete();
    }

    private function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }

    private function checkProjectPermissions($projectId)
    {
        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }
        return false;
    }
}
