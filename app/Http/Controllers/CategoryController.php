<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $all__data = Category::where('user_id', $user_id)
               ->get();
        $pagination = Category::paginate(5);
        return view('admin/category/category', compact('all__data'))->withPagination($pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/category/add-category');

        //  $all__data = Category::latest()->paginate(5);
        //  return view('admin/category/category',compact('all__data'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $validatedData = $this->validate($request, [
            'user_id'       => 'required|integer',
            'category_name' => 'required|min:2|max:255|string',
            'category_slug' => 'required|unique:categories,category_slug,'.Auth::user()->id,
            'category_img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
    //    Category::create($validatedData);
      $data = new Category();
       $data->user_id = $request->post('user_id');
       $data->category_name = $request->post('category_name');
        $data->category_slug = $request->post('category_slug');
      if ($request->hasFile('category_img')) {
        $image = $request->file('category_img');
        // $name =  $image->getClientOriginalExtension();
         $imageName = time().'.'.$request->category_img->extension();  
        $destinationPath = public_path('/images');
        $imagePath = $destinationPath. "/".  $imageName;
        $image->move($destinationPath, $imageName);
        $data->category_img = $imageName;
      }

      $data->save();

      return redirect()->route('category.index')->withSuccess('You have successfully created a Category!');
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
        $user__data = Category::findOrFail($id);
        return view('admin/category/update_category', compact('user__data'));
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

    // $update__data = Category::findOrFail($id);
    $update__data = Category::find($id);
     $request->validate([
             'category_name' => 'required|min:2|max:255|string',
            'category_slug' => 'required|unique:categories,category_slug'
           
        ]);
        
        if($request->hasFile('category_img')){
            $request->validate([
               'category_img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $image = $request->file('category_img');
        $imageName = time().'.'.$request->category_img->extension();  
        $destinationPath = public_path('/images');
        $imagePath = $destinationPath. "/".  $imageName;
        $image->move($destinationPath, $imageName);
        $update__data->category_img = $imageName;
        }
        $update__data->category_name = $request->category_name;
        $update__data->category_slug = $request->category_slug;
        $update__data->save();
    

    // $input = $request->all();
    // $update__data->fill($input)->save();
    
    return redirect()->route('category.index')->withSuccess('You have successfully updated a Category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $delete = Category::findOrFail($id);
        $delete->delete();
        return redirect()->route('category.index')->withSuccess('You have successfully delete a Category!');

    }
}
