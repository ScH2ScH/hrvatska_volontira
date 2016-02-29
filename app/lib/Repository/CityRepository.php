<?php

namespace Repository;

use City;

class CityRepository implements RepositoryInterface
{

    public function all()
    {
        return City::all();
    }

    public function find($id)
    {
        return City::find($id);
    }

    public function findOrFail($id)
    {
        return City::findOrFail($id);
    }

    public function destroy($id)
    {
        return City::destroy($id);
    }

    public function create($input)
    {
        return City::create($input);
    }

    public function getNew()
    {
        return new City;
    }
}
