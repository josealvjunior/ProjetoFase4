<?php

namespace project\Http\Controllers;

use Illuminate\Http\Request;

use project\Entities\ProjectMembers;
use project\Entities\Projects;
use project\Http\Requests;
use DB;
use project\Repositories\ProjectMembersRepository;
use project\Services\ProjectMembersService;

class ProjectMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    /**
     * @var ProjectMembersRepository
     */
    private $repository;

    /**
     * @var ProjectMembersService
     */
    private $service;

    public function __Construct(ProjectMembersRepository $repository, ProjectMembersService $service)
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
        return $this->service->addMember($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, $membersId)
    {
        if($this->checkProjectPermissions($id)== false ){
            return ['error'=> 'Acesso Negado'];
        }
        return $this->repository->findWhere(['project_id'=>$id, 'id'=>$membersId]);
    }

    public function isMember($id,$membersId)
    {
        $members = DB::table('project_members')
                    ->where('id', '=', $membersId)
                    ->where('project_id', '=', $id)
                    ->value('id');
        if ($members == null){
           return  'este não é membro';
        }else {
           return  'este é membro';
        }
    }

       //}

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id, $membersId)
    {
        if($this->checkProjectOwner($id)==false){
            return ['error'=> 'Acesso Negado'];
        }
        return $this->service->update($request->all(),$membersId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($memberId, $id)
    {
        if($this->checkProjectOwner($id)==false){
            return ['error'=> 'Acesso Negado'];
        }
        $this->service->removeMember($memberId);
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
