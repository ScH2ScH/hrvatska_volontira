<?php

namespace Repository;

use Host;

class HostRepository implements RepositoryInterface
{

    public function all()
    {
        return Host::all();
    }

    public function find($id)
    {
        return Host::find($id);
    }

    public function findOrFail($id)
    {
        return Host::findOrFail($id);
    }

    public function destroy($id)
    {
        return Host::destroy($id);
    }

    public function create($input)
    {
        return Host::create($input);
    }

    public function getNew()
    {
        return new Host;
    }
}
