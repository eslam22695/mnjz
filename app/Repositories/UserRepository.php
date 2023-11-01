<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Container\Container as App;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }
}