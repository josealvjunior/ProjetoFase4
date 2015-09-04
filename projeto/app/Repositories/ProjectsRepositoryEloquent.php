<?php

namespace project\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use project\Entities\Projects;
use project\Presenters\ProjectPresenter;
/**
 * Class ProjectsRepositoryEloquent
 * @package namespace project\Repositories;
 */
class ProjectsRepositoryEloquent extends BaseRepository implements ProjectsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Projects::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }

    public function isOwner($projectId, $userId)
    {
        if(count($this->findWhere(['id'=>$projectId, 'owner_id'=>$userId]))){
            return true;
        }
        return false;
    }

    public function hasMember($projectId, $memberId)
    {
        $project = $this->find($projectId);

        foreach($project->members as $member){
            if($member->id == $memberId){
                return true;
            }
        }
        return false;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }

}