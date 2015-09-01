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

class ProjectsValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'        => 'required',
            'description' => 'required',
            'progress'    => 'required|integer|min:0|max:100',
            'status'      => 'required|integer|min:0|max:2',
            'due_date'    => 'required|date',
            'owner_id'    => 'required|integer',
            'client_id'   => 'required|integer'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'        => 'sometimes|required|max:255',
            'description' => 'sometimes|required',
            'progress'    => 'sometimes|required|integer|min:0|max:100',
            'status'      => 'sometimes|required|integer|min:0|max:2',
            'due_date'    => 'sometimes|required|date',
            'owner_id'    => 'sometimes|required|integer',
            'client_id'   => 'sometimes|required|integer'
        ]
    ];
}