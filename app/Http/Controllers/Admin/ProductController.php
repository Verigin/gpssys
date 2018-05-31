<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as ImageInt;
use UploadImage;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::paginate(5);
        return view('admin.products.index', ['data' => $data]);
    }

    public function create()
    {
        $categories = Category::get();
        return view('admin.products.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required',
            'price' => 'integer',
        ]);

        $Product = new Product;
        $Product->title = $request['title'];
        $Product->price = $request['price'];
        $Product->description = $request['description'];
        $Product->category_id = $request['category_id'];

        if ($request->has('image')) {
            $file = $request->file('image');
            //dd($file);
            $video = false;
            $watermark = false;
            $thumbnail = true;
            try {
                $path = "/" . public_path() . '/images/';
                $filename = str_random(20) . '.' . $file->getClientOriginalExtension() ?: 'png';
                $img = ImageInt::make($file);
                $img->resize(600, 600, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($path . 'trumb_' . $filename);
                $file_resize = new File($path . 'trumb_' . $filename);
                $imageName = UploadImage::upload($file_resize, 'product', $watermark, $video, $thumbnail)->getImageName();
                $Product->image_small = '/images/uploads/products/w250/' . $imageName;
                $Product->image_large = '/images/uploads/products/original/' . $imageName;

            } catch (UploadImageExeption $e) {
                return back()->withInput()->withErrors(['image', $e->getMessage()]);
            }

        }
        $Product->save();

        return redirect()->route('products')->with('success', 'Product created successfuly');
    }

    public function edit($id)
    {
        $data = Product::findOrFail($id);
        // if (!$data) {
        //     abort(404);
        // }
        $categories = Category::get();
        return view('admin.products.edit', ['data' => $data, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $Product = Product::find($id);
        if (!$Product) {
            abort(404);
        }

        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required',
            'price' => 'integer',
        ]);

        $Product->title = $request['title'];
        $Product->description = $request['description'];
        $Product->price = $request['price'];
        $Product->category_id = $request['category_id'];
        if ($request->has('image')) {
            $file = $request->file('image');
            //dd($file);
            $video = false;
            $watermark = false;
            $thumbnail = true;
            //dd($file);
            try {
                $path = "/" . public_path() . '/images/';
                $filename = str_random(20) . '.' . $file->getClientOriginalExtension() ?: 'png';
                $img = ImageInt::make($file);
                //$img->resize(500, 500)->save($path . $filename);
                $img->resize(600, 600, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($path . 'trumb_' . $filename);
                $file_resize = new File($path . 'trumb_' . $filename);
                $imageName = UploadImage::upload($file_resize, 'product', $watermark, $video, $thumbnail)->getImageName();
                $Product->image_small = '/images/uploads/products/w250/' . $imageName;
                $Product->image_large = '/images/uploads/products/original/' . $imageName;
            } catch (UploadImageExeption $e) {
                return back()->withInput()->withErrors(['image', $e->getMessage()]);
            }
        }
        $Product->save();

        return redirect()->route('products')->with('success', 'Product updated successfuly');
    }

    public function delete($id)
    {
        $Product = Product::find($id);
        if (!$Product) {
            abort(404);
        }

        $Product->delete();
        return redirect()->route('products')->with('success', 'Product deleted successfuly');
    }
}
