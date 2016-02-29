<?php

namespace Repository;

use County;

class CountyRepository implements RepositoryInterface
{

    public function all()
    {
        return County::all();
    }

    public function find($id)
    {
        return County::find($id);
    }

    public function findOrFail($id)
    {
        return County::findOrFail($id);
    }

    public function destroy($id)
    {
        return County::destroy($id);
    }

    public function create($input)
    {
        return County::create($input);
    }

    public function getNew()
    {
        return new County;
    }
}
