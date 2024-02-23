<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nav_item;

class AdminController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return view('admin.index');
        }
        else {

        }
    }

    public function navbar() {
        $nav_items = Nav_item::all();
        
        return view('admin.navbar')->with('nav_items', $nav_items);
    }

    public function create(Request $request) {
        $nav_item = new Nav_item;
        $nav_item->title = $request->title;
        $nav_item->order = $request->order;
        $nav_item->save();
        return redirect('/admin/navbar');
    }

    public function edit(Request $request) {
        $nav_item = Nav_item::find($request->id);
        return view('admin.navbar_edit')->with("nav_item" ,$nav_item);
    }

    public function update(Request $request) {
        $nav_item = Nav_item::find($request->id);
        $nav_item->update([
            'title' => $request->title,
            'order' => $request->order,
        ]);
        return redirect('/admin/navbar');
    }

    public function delete(Request $request) {
        $nav_item = Nav_item::find($request->id);
        $nav_item->delete();
        return redirect('/admin/navbar');
    }
}
