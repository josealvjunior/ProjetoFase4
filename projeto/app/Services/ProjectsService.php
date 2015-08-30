<?php
/**
 * Created by PhpStorm.
 * User: josej_000
 * Date: 27/07/2015
 * Time: 21:47
 */

namespace project\Services;


use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use project\Entities\ProjectFile;
use project\Repositories\ProjectsRepository;
use Illuminate\Http\Exception;
use project\Validators\ProjectFileValidator;
use project\Validators\ProjectsValidator;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;


class ProjectsService
{
    /**
     * @var ProjectsRepository
     */
    protected $repository;
    /**
     * @var ProjectsValidator
     */
    protected $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @var fileValidator
     */
    private $fileValidator;

    public function __construct(ProjectsRepository $repository, ProjectsValidator $validator, Filesystem $filesystem, Storage $storage, ProjectFileValidator $fileValidator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->fileValidator = $fileValidator;
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

    public function createFile(array $data)
    {
        try{
            $this->fileValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $project = $this->repository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);
            return $this->storage->put($projectFile->id.".".$data['extension'], $this->filesystem->get($data['file']));
        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function removeProjecFile($id)
    {

    }
}