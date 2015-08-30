<?php

namespace project\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectTask extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'project_id',
        'name',
        'start_date',
        'status'
    ];

    public function projects()
    {
        return $this->belongsTo(Projects::class);
    }

}
