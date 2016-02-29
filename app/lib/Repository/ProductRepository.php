<?php

namespace Repository;

use Product;

class ProductRepository implements RepositoryInterface
{

    public function all()
    {
        return Product::all();
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function findOrFail($id)
    {
        return Product::findOrFail($id);
    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }

    public function create($input)
    {
        return Product::create($input);
    }

    public function getNew()
    {
        return new Product;
    }
}
