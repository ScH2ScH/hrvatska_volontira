<?php

namespace Repository;

use OrganizationType;

class OrganizationTypeRepository implements RepositoryInterface
{

    public function all()
    {
        return OrganizationType::all();
    }

    public function find($id)
    {
        return OrganizationType::find($id);
    }

    public function findOrFail($id)
    {
        return OrganizationType::findOrFail($id);
    }

    public function destroy($id)
    {
        return OrganizationType::destroy($id);
    }

    public function create($input)
    {
        return OrganizationType::create($input);
    }

    public function getNew()
    {
        return new OrganizationType;
    }
}
