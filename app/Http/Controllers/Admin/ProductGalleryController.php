<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\Admin\ProductGalleryRequest;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $query = ProductGallery::with(['product']);
            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                    <div class="btn-group">
                        <div class="drop-down">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Action</button>
                            <div class="dropdown-menu">
                                <form action="'.route('product-gallery.destroy', $item->id).'" method="POST">
                                    '.csrf_field().method_field('DELETE').'
                                    <button type="submit" class="dropdown-item text-danger" href="">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })
            ->editColumn('photos', function($item){
                return $item->photos ? '<img src="'.Storage::url($item->photos).'" style="max-height:80px;" width="100px" height="100px">' : '';
            })
            ->rawColumns(['action','photos'])
            ->make();
        }else{
            return view('pages.admin.product-gallery.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $products=Product::all();
        return view('pages.admin.product-gallery.create',[
            'products'=>$products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data=$request->all();
        $data['photos']=$request->file('photos')->store('assets/product','public');
        ProductGallery::create($data);
        return redirect()->route('product-gallery.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=ProductGallery::findOrFail($id);
        $item->delete();
        return redirect()->route('product-gallery.index');
    }
}
