<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::paginate(5);
        return view('admin.categories.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|min:3',
                'description' => 'required',
            ]);

            Category::create([
                'title' => $request['title'],
                'description' => $request['description'],
            ]);
        } catch (ValidationExeption $e) {
        }

        return redirect()->route('categories')->with('success', 'Category created successfuly');
    }

    public function edit($id)
    {
        $data = Category::find($id);
        if (!$data) {
            abort(404);
        }

        return view('admin.categories.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $Category = Category::find($id);
        if (!$Category) {
            abort(404);
        }

        try {
            $this->validate($request, [
                'title' => 'required|min:3',
                'description' => 'required',
            ]);

            $Category->title = $request['title'];
            $Category->description = $request['description'];
            $Category->save();
        } catch (ValidationExeption $e) {
        }

        return redirect()->route('categories')->with('success', 'Category updated successfuly');
    }

    public function delete($id)
    {
        $Category = Category::find($id);
        if (!$Category) {
            abort(404);
        }

        $Category->delete();
        return redirect()->route('categories')->with('success', 'Category deleted successfuly');
    }

}
