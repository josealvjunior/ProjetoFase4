<?php
/**
 * Created by PhpStorm.
 * User: josej_000
 * Date: 26/07/2015
 * Time: 19:40
 */

namespace Project\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use project\Entities\Client;
use project\Repositories\ClientRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model()
    {
     return Client::class;
    }
}