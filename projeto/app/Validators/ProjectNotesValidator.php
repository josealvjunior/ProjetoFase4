<?php
/**
 * Created by PhpStorm.
 * User: josej_000
 * Date: 27/07/2015
 * Time: 22:02
 */

namespace project\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectNotesValidator extends LaravelValidator
{
    protected $rules = [
            'project_id' => 'required|integer',
            'title' => 'required',
            'notes' => 'required'
    ];
}