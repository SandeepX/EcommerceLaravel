<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{   

    protected $category = null;
    public function __construct(Category $category){
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->category = $this->category->getAllCategories();
           
       return view('admin.category')->with('category_data', $this->category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
    {
        $parent_cats = $this->category->where('is_parent',1)->orderBy('title','ASC')->pluck('title','id');

        return view('admin.category-form')->with('parent_cats',$parent_cats);
    }

    /**

    //using compact
     return view('admin.category-form', compact('parent_cats', 'parent_cats'));


     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =$this->category->getRules();
        $request->validate($rules);

        $data =$request->all();
        $data['slug'] =  $this->category->getSlug($request->title);
        $data['is_parent']=$request->input('is_parent','0');
        $data['added_by'] = $request->user()->id;


        if ($request->image) {
            $file_name = uploadImage($request->image,'category','200x200');
            if($file_name){
                $data['image']= $file_name;
            }else{
                $data['image']= null;
            }
        }
        $this->category->fill($data);
        $status =$this->category->save();
        if($status){
            $request->session()->flash('success','category added successfully');
        }else{
             $request->session()->flash('error','category not added ');

        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }


    public function getAllchild(Request $request){
        $this->category = $this->category->find($request->category_id);
        if (!$this->category) {
            return response()->json(['status'=>false, 'data'=>null, 'msg'=>'Invalid category selected..']);
        }
        $child_id = $this->category->where('parent_id',$this->category->id)->orderBy('title','ASC')->get();
        return response()->json(['status'=>true, 'data'=> $child_id, 'msg'=>'']);                                                           
    }
    
    public function edit($id)
    {   
        $this->category=$this->category->find($id);
        if(!$this->category){
            request()->session()->flash('erro','category  not found');
            return redirect()->route('category.index');
        }
        
        $parent_cats = $this->category->where('is_parent',1)->orderBy('title','ASC')->pluck('title','id');

        return view('admin.category-form')
        ->with('cat_detail', $this->category)
        ->with('parent_cats',$parent_cats);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->category=$this->category->find($id);
        if(!$this->category){
            request()->session()->flash('erro','category  not found');
            return redirect()->route('category.index');
        }

        $rules =$this->category->getRules('update');
        $request->validate($rules);
        $data =$request->all();
        $data['is_parent']=$request->input('is_parent','0');
        if ($request->image) {
            $file_name = uploadImage($request->image,'category','200x200');
            if($file_name){
                $data['image']= $file_name;
                deleteImage($this->category->image,'category'); 
            }
        }
        $this->category->fill($data);
        $status =$this->category->save();
        if($status){

            $this->category->shiftParent($this->category->id,$this->category->parent_id);


            $request->session()->flash('success','category updated successfully');
        }else{
             $request->session()->flash('error','category not updated ');

        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category=$this->category->find($id);
        if(!$this->category){
            request()->session()->flash('erro','category  not found');
            return redirect()->route('category.index');
        }

        $image = $this->category->image;
        $child_cat_id = $this->category->where('parent_id',$this->category->id)->pluck('id');
        $del =$this->category->delete();
        if($del){
            deleteImage($image,'category');
            $this->category->shiftChild($child_cat_id);            
            request()->session()->flash('success','category deleted successfully');
        }else{
            request()->session()->flash('error','category not deleted ');
        }
        return redirect()->route('category.index');
    }
}
