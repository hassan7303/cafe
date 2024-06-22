<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $prefix = '20';
    public function show(Request $requesr)
    {
        dd($requesr->all());
    }
    public function insert(Request $requesr)
    {
        dd($requesr->all());
    }
    public function update(Request $requesr)
    {
        dd($requesr->all());
    }
    public function delete(Request $requesr)
    {
        dd($requesr->all());
    }
}
