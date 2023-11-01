<?php

namespace App\Repositories;

use Illuminate\Container\Container as App;


interface IRepository
{

    /**
     * @param App $app
     */
    public function setModel(App $app);

    public function find($id, $with = []);

    public function paginate($with = []);

    public function get();

    public function create($data);

    public function update($id, $data);

    public function destroy($id);
}
