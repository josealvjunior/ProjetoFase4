<?php
/**
 * Created by PhpStorm.
 * User: josej_000
 * Date: 27/07/2015
 * Time: 21:47
 */

namespace project\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;
use project\Repositories\ProjectNotesRepository;
use Illuminate\Http\Exception;
use project\Validators\ProjectNotesValidator;

class ProjectNotesService
{
    /**
     * @var ProjectNotesRepository
     */
    protected $repository;
    /**
     * @var ProjectsNotesValidator
     */
    protected $validator;

    public function __construct(ProjectNotesRepository $repository, ProjectNotesValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function all()
    {
        return response()->json($this->repository->with(['owner', 'client'])->all());
    }

    public function read($id)
    {
        try{
            return response()->json($this->repository->with(['owner', 'client'])->find($id));
        }catch (ModelNotFoundException $e){
            return $this->notFound($id);
        }
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
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
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch(ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        };
    }
}