<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'slug', 'summary', 'is_parent','parent_id', 'status', 'image','added_by'];

    public function getRules($act='add'){
    	$rules=[
			'title'=>'required|string|unique:categories,title',
			'summary'=>'nullable|string',
			'is_parent'=>'sometimes|in:1',
			'parent_id'=>'nullable|exists:categories,id',
			'status'=>'required|in:active,inactive',
			'image'=>'sometimes|image|max:6000'
    	];

    	if($act!=  'add'){
    		$rules['title'] = 'required|string';
    	}
    	return $rules;
	}

    public function shiftChild($child_id){
    	$array =array(
    		'is_parent'=> 1
    	);
    	return $this->whereIn('id',$child_id)->update($array);
    }

    public function shiftParent($old_parent_id,$new_parent_id){
    	if($new_parent_id>0){
    		$data= array(
    			'parent_id'=>$new_parent_id
    		);
    		return $this->where('parent_id',$old_parent_id)->update($data);
    	}
    }


    public function parent_info(){
    	return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }


    public function getAllCategories(){
    	return $this->with('parent_info')->get();
    }


    public function getSlug($title){
    	$slug = \Str::slug($title);
    	if ($this->where('slug',$slug)->count()>0) {
    		$slug .= rand(0,999);
    	}
    	return $slug;
    }

}
