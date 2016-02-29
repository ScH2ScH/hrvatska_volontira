<?php

namespace Repository;

use Action;

class ActionRepository implements RepositoryInterface
{

    public function all()
    {
        return Action::all();
    }

    public function find($id)
    {
        return Action::find($id);
    }

    public function findOrFail($id)
    {
        return Action::findOrFail($id);
    }

    public function destroy($id)
    {
        return Action::destroy($id);
    }

    public function create($input)
    {
        return Action::create($input);
    }

    public function getNew()
    {
        return new Action;
    }
}
