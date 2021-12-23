<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\TemporaryFiles;
use App\Http\Requests\StoreProductRequest;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $posts = Product::where('user_id', $user_id)->get(); 
        $pagination = Product::paginate(5);
        return view('admin/products/index')->withPosts($posts)->withPagination($pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = ProductCategory::with('children')->whereNull('parent_id')->get();
        return view('admin/products/create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request)
    {
        // $user_id = Auth::id();
        $request->validate ([
        'title'         => 'required|min:3|max:255',
        'slug'          => 'required|min:3|max:255|unique:products',
        'sku'         => 'required|min:3|max:255|unique:products',
        'featured_img' => 'required',
        'featured_img.*' => 'image',
        'mrp_price'   => 'required|numeric',
        'sale_price'   => 'required|numeric',
        'category_id'   => 'required|numeric',
        'short_description' => 'min:3|max:255',
        'specification'  => 'min:3|max:255',
        'description'   => 'required|min:3|max:255'

    ]);

    $user_id = Auth::id();
    $slug = Str::slug($request->slug, '-');
    
    $mrp_price = $request->mrp_price;
    $sale_price = $request->sale_price;
    $discount = $mrp_price - $sale_price;
    $discountvalue = $discount;
    $percent = (($mrp_price - $sale_price)*100) /$mrp_price ;
    $dis_percentage = round($percent);

    // if ($request->hasFile('featured_img[]')) {
    //     $image = $request->file('featured_img[]');
    //      $imageName = time().'.'.$request->featured_img->extension();  
    //     $destinationPath = public_path('/images');
    //     $imagePath = $destinationPath. "/".  $imageName;
    //     $image->move($destinationPath, $imageName);
    //     $featured_img = $imageName;
    //   }

      $files = [];
        if($request->hasfile('featured_img'))
         {
            foreach($request->file('featured_img') as $file)
            {
    
                
                // $imageName = time().'.'.$file->extension();  
                // $destinationPath = public_path('/images');
                // $imagePath = $destinationPath. "/".  $imageName;
                // $file->move($destinationPath, $imageName);
                // $featured_img[] = $imageName;
        //  $update__data['slug'] = Str::($update__data['slug'], '-');
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('/images'), $name);  
                $files[] = $name;  
            }
         }
         print_r($files);


        // print_r($files);
         $post = Product::create([
             'user_id' => $user_id,
             'title' => $request->title,
             'slug' => $slug,
             'sku' => $request->sku,
             'featured_img' => $files,
             'mrp_price' => $request->mrp_price,
             'sale_price' => $request->sale_price,
             'discount' => $discountvalue,
             'dis_percentage' => $dis_percentage,
             'category_id' => $request->category_id,
             'short_description' => $request->short_description,
             'specification' => $request->specification,
             'description' => $request->description
    
         ]);
         
        
    //   $yourModel = Product::find('multi_img');
    //  if ($request->hasFile('multi_img')) {
    //     $fileAdders = $post->addMultipleMediaFromRequest(['multi_img'])
    //         ->each(function ($fileAdder) {
    //             $fileAdder->toMediaCollection('uploads');
    //         });
    // }

    // if($request->hasfile('multi_img')) {
    //         foreach($request->file('multi_img') as $image) {
    //             if($image->isValid()) {
    //                 $post->addMedia($image)->toMediaCollection('uploads');
    //             }
    //         }
    //     }

 

      $temporaryfiles = TemporaryFiles::where('folder', $request->multi_img )->first();
      if ( $temporaryfiles ) {
      $post->addMedia(storage_path('app/uploads/temp/' . $request->multi_img . '/' . $temporaryfiles->filename))->toMediaCollection('uploads');
      rmdir(storage_path('app/uploads/temp/' . $request->multi_img));
      $temporaryfiles->delete();
      }

    return redirect()->route('product.index')->withSuccess('You have successfully created a Category!')->withPost($post);
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
     $categories = ProductCategory::with('children')->whereNull('parent_id')->get();
     
     $posts = Product::findOrFail($id);
     $category_id = $posts->category_id;
     $catname = ProductCategory::where('id', $posts->category_id)->get();
     return view('admin/products/edit', compact('posts'),compact('categories'))->withCatname($catname);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = Auth::id();
        $update__data = Product::find($id);
        $request->validate([
        'user_id'       => 'required|integer',
        'title'         => 'required|min:3|max:255',
        'slug'          => 'required|min:3|max:255|unique:products,slug,'.$user_id,
        'sku'         => 'required|min:3|max:255|unique:products,sku,'.$user_id,
        'mrp_price'   => 'required|numeric',
        'sale_price'   => 'required|numeric',
        'category_id'   => 'required|numeric',
        'short_description' => 'min:3|max:255',
        'specification'  => 'min:3|max:255',
        'description'   => 'required|min:3|max:255'
        ]);

    $update__data['user_id'] = Auth::id();
    $update__data['slug'] = Str::slug($update__data['slug'], '-');
    
    $mrp_price = $request->mrp_price;
    $sale_price = $request->sale_price;
    $discount = $mrp_price - $sale_price;
    $update__data->discount = $discount;
    $percent = (($mrp_price - $sale_price)*100) /$mrp_price ;
    $update__data->dis_percentage = round($percent);

        $update__data->title = $request->title;
        $update__data->slug = $request->slug;
        $update__data->sku = $request->sku;
        $update__data->mrp_price = $request->mrp_price;
        $update__data->sale_price = $request->sale_price;
        $update__data->slug = $request->slug;
        $update__data->category_id = $request->category_id;
        $update__data->short_description = $request->short_description;
        $update__data->specification = $request->specification;
        $update__data->description = $request->description;
        if($request->hasFile('featured_img')){
            $request->validate([
               'featured_img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $request->file('featured_img');
        $imageName = time().'.'.$request->featured_img->extension();  
        $destinationPath = public_path('/images');
        $imagePath = $destinationPath. "/".  $imageName;
        $image->move($destinationPath, $imageName);
        $update__data->featured_img = $imageName;
        }



        $update__data->save();

        return redirect()->route('product.index')->withSuccess('You have successfully updated Product!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Product::findOrFail($id);
        $delete->delete();
        return redirect()->route('product.index')->withSuccess('You have successfully delete a Product!');
    }
}
