@extends('layouts.admin')

@section('title','Category ADD | Admin dashboard')

@section('scripts')
    <script >
        $('#is_parent').change(function(){
            var is_checked = $(this).prop('checked');
            if (is_checked==true){
                $('#parent_cat_div').addClass('d-none');
            }else{
                $('#parent_cat_div').removeClass('d-none');
            }
        });
    </script>
@endsection

@section ('main-content')
   
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Category {{isset($cat_detail)? 'Update':'Add'}} </div>
                   
                </div>
                <div class="ibox-body">
                    @if(isset($cat_detail))
                        {{ Form::open(['url'=>route('category.update',$cat_detail->id), 'files'=>true, 'class'=>'form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url'=>route('category.store'), 'files'=>true, 'class'=>'form']) }}
                    @endif
                        <div class="form-group row">
                            {{ Form:: label('title','Title: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::text('title',@$cat_detail->title, ['class'=>'form-control form-control-sm' ,'id'=>'title', 'required'=>true, 'placeholder'=>'Enter Category Title...']) }}

                                @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form:: label('summary','Summary: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::textarea('summary',@$cat_detail->summary, ['class'=>'form-control form-control-sm' ,'id'=>'summary', 'required'=>false,  'rows'=> 6, 'style'=>'resize: none']) }}

                                @error('summary')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            {{ Form:: label('is_parent','Is Parent: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::checkbox('is_parent',1,((isset($cat_detail))?@$cat_detail->is_parent:1) , ['id'=>'is_parent']) }} Yes

                                @error('is_parent')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row {{ (isset($cat_detail) && $cat_detail->is_parent!=1)? '':'d-none'}}" id="parent_cat_div">
                            {{ Form:: label('parent_id','Parent Category: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                               
                                {{ Form::select('parent_id', $parent_cats, @$cat_detail->parent_id, ['id'=>'parent_id' ,'class'=>'form-control form-control-sm','placeholder'  =>'----- select any one----']) }} 

                                @error('parent_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row " >
                            {{ Form:: label('status','Status: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::select('status',['active'=>'Active','inactive'=>'Inactive'], @$cat_detail->status, ['id'=>'status' ,'class'=>'form-control form-control-sm','required'=>true]) }} 

                                @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row " >
                            {{ Form:: label('image','Image: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-5">
                                {{ Form::file('image', ['id'=>'image' ,'accept'=>'image/*']) }} 

                                @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if(isset($cat_detail))
                                <div class="col-sm-4">
                                    <img src="{{asset('uploads/category/Thumb-'.$cat_detail->image) }}" alt="" class="img img-responsive img-thumbnail">
                                </div>
                            @endif    
                        </div>
                        
                        <div class="form-group row " >
                            {{ Form:: label('','', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                               {{ Form::button("<i class='fa fa-trash'></i> Reset",['class'=>'btn     btn-danger','type'=>'reset']) }}

                               {{ Form::button("<i class='fa fa-paper-plane'></i> Submit",['class'=>'btn     btn-success','type'=>'submit']) }}
                            </div>
                        </div>
            



















                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    


@endsection
