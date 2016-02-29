<?php

namespace Repository;

use Homepage;

class HomepageRepository implements RepositoryInterface
{

    public function all()
    {
        return Homepage::all();
    }

    public function find($id)
    {
        return Homepage::find($id);
    }

    public function findOrFail($id)
    {
        return Homepage::findOrFail($id);
    }

    public function destroy($id)
    {
        return Homepage::destroy($id);
    }

    public function create($input)
    {
        return Homepage::create($input);
    }

    public function getNew()
    {
        return new Homepage;
    }
}
