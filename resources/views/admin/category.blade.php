@extends('layouts.admin')

@section('title','category List')

@section ('main-content')




    
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Category List</div>
                <a href="{{  route('category.create') }}" class="btn  btn-success add_btn">
                    <i class="fa fa-plus"></i>Add Category
                </a>
            </div>
        
        <div class="ibox-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Is Parent</th>
                        <th>Parent</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($category_data))

                        @foreach($category_data as $key=>$categorydetail)
                            <tr>
                                <td> {{ $categorydetail->title}}  </td>
                                
                                <td> 
                                   {{ ($categorydetail->is_parent==1)? 'Yes':'No'}}
                                </td>
                                
                                <td> 
                                   {{ ($categorydetail->parent_info['title']) }}
                                </td>

                                <td> 
                                    <img src="{{ asset('uploads/category/Thumb-'.$categorydetail->image) }}" alt="" class="img img-thumbnail img-responsive">
                                </td>
                                <td>
                                    <span class="badge badge-{{ ( $categorydetail->status=='active') ? 'success':'danger'}}">{{ ucfirst ($categorydetail->status) }}</span> 
                                     </td>
                                <td>
                                    <a href="{{ route('category.edit',$categorydetail->id) }} " class="btn btn-success pull-left edit_category" style="border-radius:50%;"      data-id="{{ $categorydetail->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>



                                    {{ Form::open(['url'=>route('category.destroy', $categorydetail->id),'onsubmit'=>'return confirm("Are you sure you want to delete this category ?")','class'=>'form pull-left' ]) }}

                                        @method('delete')

                                      {{Form::button('<i class= "fa fa-trash"></i>',['class'=>'btn btn-danger', 'style'=>'border-radius:50%','type'=>'submit'])  }} 

                                    {{ Form::close() }}
                                    
                                </td>
                            </tr>
                        @endforeach        
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>



@endsection
