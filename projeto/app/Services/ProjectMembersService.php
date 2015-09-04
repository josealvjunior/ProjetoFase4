<?php
/**
 * Created by PhpStorm.
 * User: josej_000
 * Date: 27/07/2015
 * Time: 21:47
 */

namespace project\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Http\Exception;
use project\Repositories\ProjectMembersRepository;
use project\Repositories\ProjectTaskRepository;
use project\Validators\ProjectMembersValidator;
use project\Validators\ProjectTaskValidator;

class ProjectMembersService
{
    /**
     * @var ProjectMembersRepository
     */
    protected $repository;
    /**
     * @var ProjectMembersValidator
     */
    protected $validator;

    public function __construct(ProjectMembersRepository $repository, ProjectMembersValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function all()
    {
        return response()->json($this->repository->with(['projects', 'users'])->all());
    }

    public function read($id)
    {
        try{
            return response()->json($this->repository->with(['projects', 'users'])->find($id));
        }catch (ModelNotFoundException $e){
            return $this->notFound($id);
        }
    }

    public function addMember(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            return $this->repository->create($data);
        } catch(ValidatorException $e) {
            return [
            'error' => true,
            'message' => $e->getMessageBag()
            ];
        };

    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            return $this->repository->update($data, $id);
        } catch(ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        };
    }

    public function removeMember($id)
    {
        $this->repository->delete($id);
    }
}