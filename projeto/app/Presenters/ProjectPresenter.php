<?php
/**
 * Created by PhpStorm.
 * User: josej_000
 * Date: 22/08/2015
 * Time: 00:55
 */

namespace project\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use project\Transformers\ProjectTransformer;

class ProjectPresenter extends FractalPresenter
{
    public function getTransformer(){
        return new ProjectTransformer();
    }
}