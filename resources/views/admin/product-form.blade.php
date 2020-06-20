@extends('layouts.admin')

@section('title','Product ADD | Admin dashboard')

@section('styles')
    <link rel="stylesheet"  href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.js')}}"></script>
    <script>  
        $(document).ready(function() {
            $('#description').summernote();
        });
        


        $('#cat_id').change(function(e){
            var cat_id = $(this).val();
            $.ajax({
                url: "{{ route('get-child') }}",
                type:"post",
                data:{ 
                    category_id:cat_id, 
                    _token: "{{ csrf_token() }}"
                },
                success:function(response){
                    if (typeof(response)!='object') {
                        response = $.parseJSON(response);
                    }

                    var option_html = "<option value='select any one' selected> <option>";

                    if(response.status){
                        if(response.data.length > 0){
                            $.each(response.data,function(key,value){
                                option_html += "<option value = '"+value.id+"'>"+value.title+" <option>"

                            })

                            $('#sub_cat_div').removeClass('d-none');
                        }
                    } else{
                            $('#sub_cat_div').addClass('d-none');

                        }
                    $('#sub_cat_id').html(option_html);
                }
            });
        });
    </script>
@endsection

@section ('main-content')
   
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Product {{isset($product_detail)? 'Update':'Add'}} </div>
                   
                </div>
                <div class="ibox-body">
                    @if(isset($product_detail))
                        {{ Form::open(['url'=>route('product.update',$product_detail->id), 'files'=>true, 'class'=>'form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url'=>route('product.store'), 'files'=>true, 'class'=>'form']) }}
                    @endif
                        <div class="form-group row">
                            {{ Form:: label('title','Title: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::text('title',@$product_detail->title, ['class'=>'form-control form-control-sm' ,'id'=>'title', 'required'=>true, 'placeholder'=>'Enter Product Title...']) }}

                                @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form:: label('summary','Summary: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::textarea('summary',@$product_detail->summary, ['class'=>'form-control form-control-sm' ,'id'=>'summary', 'required'=>false,  'rows'=> 6, 'style'=>'resize: none']) }}

                                @error('summary')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form:: label('description','Description: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::textarea('description',@$product_detail->description, ['class'=>'form-control form-control-sm' ,'id'=>'description', 'required'=>false,  'rows'=> 6, 'style'=>'resize: none']) }}

                                @error('description')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>                           

                        <div class="form-group row">
                            {{ Form:: label('cat_id','Category: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                               
                                {{ Form::select('cat_id', @$parent_cats, @$product_detail->cat_id, ['id'=>'cat_id' ,'class'=>'form-control form-control-sm','placeholder'  =>'----- select any one----']) }} 

                                @error('cat_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row d-none" id="sub_cat_div">
                            {{ Form:: label('sub_cat_id','Sub-Category: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                               
                                {{ Form::select('sub_cat_id', [], @$product_detail->sub_cat_id, ['id'=>'sub_cat_id' ,'class'=>'form-control form-control-sm']) }} 

                                @error('sub_cat_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            {{ Form:: label('price','Price(NRP): ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::number('price',@$product_detail->price, ['class'=>'form-control form-control-sm' ,'id'=>'price', 'required'=>true, 'placeholder'=>'Enter Product Price...','min'=>100]) }}

                                @error('price')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            {{ Form:: label('discount','Discount(%): ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::number('discount',@$product_detail->discount, ['class'=>'form-control form-control-sm' ,'id'=>'discount', 'required'=>false, 'placeholder'=>'Enter Product discount','min'=>0,'max'=>85]) }}

                                @error('discount')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            {{ Form:: label('brand','Brand: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::number('brand',@$product_detail->brand, ['class'=>'form-control form-control-sm' ,'id'=>'brand', 'required'=>false, 'placeholder'=>'Enter Product brand...']) }}

                                @error('brand')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            {{ Form:: label('is_featured','Is Featured: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::checkbox('is_featured',1,((isset($product_detail))?@$product_detail->is_featured:1) , ['id'=>'is_featured']) }} Yes

                                @error('is_featured')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            {{ Form:: label('keywords','Keywords: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::textarea('keywords',@$product_detail->keywords, ['class'=>'form-control form-control-sm' ,'id'=>'keywords', 'required'=>false,  'rows'=> 3, 'style'=>'resize: none']) }}

                                @error('keywords')
                                    <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row " >
                            {{ Form:: label('vendor_id','Vendor Id: ', ['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::select('vendor_id',$vendors, @$product_detail->vendor_id, ['id'=>'vendor_id' ,'class'=>'form-control form-control-sm','placeholder'=>'','required'=>false]) }} 

                                @error('vendor_id')
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
