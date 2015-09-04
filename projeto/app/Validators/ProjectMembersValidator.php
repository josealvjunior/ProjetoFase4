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

class ProjectMembersValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'project_id'  => 'required|integer',
            'user_id'     => 'required|integer'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'project_id'  => 'required|integer',
            'user_id'     => 'required|integer'
        ]
    ];
}