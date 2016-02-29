<?php

namespace Repository;

use Region;

class RegionRepository implements RepositoryInterface
{

    public function all()
    {
        return Region::all();
    }

    public function find($id)
    {
        return Region::find($id);
    }

    public function findOrFail($id)
    {
        return Region::findOrFail($id);
    }

    public function destroy($id)
    {
        return Region::destroy($id);
    }

    public function create($input)
    {
        return Region::create($input);
    }

    public function getNew()
    {
        return new Region;
    }
}
