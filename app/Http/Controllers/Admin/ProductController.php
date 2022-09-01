<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Product::with(['user', 'category']);
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <div class="btn-group">
                        <div class="drop-down">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="' . route('product.edit', $item->id) . '">Edit</a>
                                <form action="' . route('product.destroy', $item->id) . '" method="POST">
                                    ' . csrf_field() . method_field('DELETE') . '
                                    <button type="submit" class="dropdown-item text-danger" href="">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
                })->rawColumns(['action'])
                ->make();
        } else {
            return view('pages.admin.product.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('pages.admin.product.create', [
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);

        Product::create($data);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::findOrFail($id);
        $users = User::all();
        $categories = Category::all();
        return view('pages.admin.product.edit', [
            'item' => $item,
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id);
        $data['slug'] = Str::slug($data['name']);
        $item->update($data);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();
        return redirect()->route('product.index');
    }
}
