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

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'        => 'required',
            'start_date'  => 'required|date',
            'status'      => 'required|integer|min:0|max:2',
            'project_id'  => 'required|integer'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'        => 'required',
            'start_date'  => 'required|date',
            'status'      => 'required|integer|min:0|max:2',
            'project_id'  => 'required|integer'
        ]
    ];
}