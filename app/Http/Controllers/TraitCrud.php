<?php

namespace App\Http\Controllers;

trait TraitCrud
{
    public function index()
    {
        $this->data['data'] = $this->model::paginate();

        return view("pages.{$this->route}.index", $this->data);
    }

    public function create()
    {
        return view("pages.{$this->route}.create", $this->data);
    }
}
