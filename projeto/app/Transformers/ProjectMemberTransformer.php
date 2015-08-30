<?php
/**
 * Created by PhpStorm.
 * User: josej_000
 * Date: 22/08/2015
 * Time: 00:46
 */

namespace project\Transformers;
use project\Entities\User;
use League\Fractal\TransformerAbstract;
class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform(User $member)
    {
        return[
            'member_id' => $member->id,
            'name' => $member->name,
        ];
    }
}