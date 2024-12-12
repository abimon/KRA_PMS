<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $user = User::findOrFail($id);
        if (request('fname') != null) {
            $user->fname = request('fname');
        }
        if (request('lname') != null) {
            $user->lname = request('lname');
        }
        if (request('employer') != null) {
            $user->employer = request('employer');
        }
        if (request('kpin') != null) {
            $user->kpin = request('kpin');
        }
        if (request('employer_kra') != null) {
            $user->employer_kra = request('employer_kra');
        }
        if (request('nid') != null) {
            $user->nid = request('nid');
        }
        if (request('contact') != null) {
            $user->contact = request('contact');
        }
        if (request('email') != null) {
            $user->email = request('email');
        }
        if (request('password') != null) {
            $user->password = request('password');
        }
        if (request('role') != null) {
            $user->role = request('role');
        }
        if (request('isAdmin') != null) {
            $user->isAdmin = request('isAdmin');
        }
        $user->update();
        return back()->with('success', 'User details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
