<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('profiles.index');
    }

    public function create()
    {
        return view('profiles.edit');
    }

    public function store(Request $request)
    {
        // Code to save a new user
    }

    public function show($id)
    {
        // Code to show a single user
    }

    public function edit($id)
    {
        // Code to show form to edit a user
    }

    public function update(Request $request, $id)
    {
        // Code to update a user
    }

    public function destroy($id)
    {
        // Code to delete a user
    }
}
