<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use File;
use Image;
class BannerController extends Controller
{

    protected $banner = null;
    public function __construct(Banner $banner){
        $this->banner = $banner;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $this->banner = $this->banner->orderBy('id','DESC')->get(); 

        return view('admin.banner')->with('bannerData', $this->banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $rules = $this->banner->getRules();
        $request->validate($rules);

        $data = $request->all();
        
        $data['added_by'] = $request->user()->id;

        

        if($request->image){
            $upload_dir = public_path().'/uploads/banner' ;
            if(!File::exists($upload_dir)){
                File::makeDirectory($upload_dir,0777,true,true);
            }
            $file_name = "Banner-".date('Ymdhis').rand(0,999).".".$request->image->getClientOriginalExtension();
            $success = $request->image->move($upload_dir, $file_name);
            if($success){
                Image::make($upload_dir."/". $file_name)-> resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })-> save($upload_dir.'/Thumb-'.$file_name);
                $data['image'] = $file_name;
            } else{
                $data['image'] = null;
            }



        }

        $this->banner->fill($data);
        $status = $this->banner->save();
        if($status){
            $request->session()->flash('success','Banner added successfully');
        }else{
             $request->session()->flash('error','Banner not added ');

        }
        return redirect()->route('banner.index');
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
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBannerById(Request $request){
        $this->banner = $this->banner->find($request->ban_id);
        if(!$this->banner){
            return response()->json(['status' => false, 'msg' =>'Banner doesnot exist', 'data'=> null]);
        }
        return response()->json(['status' => true, 'msg' =>null, 'data'=> $this->banner]);

    }


    public function update(Request $request, $id)
    {  
        $this->banner = $this->banner->find($id); 
        
        if (!$this->banner) {
            $request->session()->flash('error','Banner not found'); 
        return redirect()->route('banner.index');
    }   
        $rules = $this->banner->getRules();
        $request->validate($rules);

        $data = $request->all();
        

        

        if($request->image){
            $upload_dir = public_path().'/uploads/banner' ;
            if(!File::exists($upload_dir)){
                File::makeDirectory($upload_dir,0777,true,true);
            }
            $file_name = "Banner-".date('Ymdhis').rand(0,999).".".$request->image->getClientOriginalExtension();
            $success = $request->image->move($upload_dir, $file_name);
            if($success){
                Image::make($upload_dir."/". $file_name)-> resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })-> save($upload_dir.'/Thumb-'.$file_name);
                $data['image'] = $file_name; 
                    @unlink($upload_dir.'/'.$this->banner->image); 
                    @unlink($upload_dir.'/Thumb-'.$this->banner->image);
            } else{
                $data['image'] = null;
            }

        }

        $this->banner->fill($data);
        $status = $this->banner->save();
        if($status){
            $request->session()->flash('success','Banner updated successfully');
        }else{
             $request->session()->flash('error','Banner not updated ');

        }
        return redirect()->route('banner.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $this->banner =$this->banner->find($id);
        if(!$this->banner){
            request()->session()->flash('error', 'Banner not found.');
            return redirect()->route('banner.index');
        }

         
        $image =  $this->banner->image;
        $success = $this->banner->delete($id);
        if($success){
            if( $image != null && file_exists(public_path().'/uploads/banner/'. $image)){
                @unlink(public_path().'/uploads/banner/'. $image);
                @unlink(public_path().'/uploads/banner/Thumb-'. $image);   
            } 

            request()->session()->flash('success','Banner deleted successfully.');
        }else{
             request()->session()->flash('error',' sorry !Banner not deleted.');
        }
        return redirect()->route('banner.index');











    }
}
