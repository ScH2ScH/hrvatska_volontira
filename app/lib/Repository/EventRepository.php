<?php

namespace Repository;

use Models\Event;

class EventRepository implements RepositoryInterface
{

    public function all()
    {
        return Event::all();
    }

    public function find($id)
    {
        return Event::find($id);
    }

    public function findOrFail($id)
    {
        return Event::findOrFail($id);
    }

    public function destroy($id)
    {
        return Event::destroy($id);
    }

    public function create($input)
    {
        return Event::create($input);
    }

    public function getNew()
    {
        return new Event;
    }

    public function where($attributes)
    {
        return Event::where($attributes);
    }
}
