@extends('layouts.admin')

@section('title','Product list')

@section ('main-content')




    
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Product List</div>
                <a href="{{  route('product.create') }}" class="btn  btn-success add_btn">
                    <i class="fa fa-plus"></i>Add Product
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
                    @if(isset($product_data))

                        @foreach($product_data as $key=>$productdetail)
                            <tr>
                                <td> {{ $productdetail->title}}  </td>
                                
                                <td> 
                                   {{ ($productdetail->is_parent==1)? 'Yes':'No'}}
                                </td>
                                
                                <td> 
                                   {{ ($productdetail->parent_info['title']) }}
                                </td>

                                <td> 
                                    <img src="{{ asset('uploads/product/Thumb-'.$productdetail->image) }}" alt="" class="img img-thumbnail img-responsive">
                                </td>
                                <td>
                                    <span class="badge badge-{{ ( $productdetail->status=='active') ? 'success':'danger'}}">{{ ucfirst ($productdetail->status) }}</span> 
                                     </td>
                                <td>
                                    <a href="{{ route('product.edit',$productdetail->id) }} " class="btn btn-success pull-left edit_product" style="border-radius:50%;"      data-id="{{ $productdetail->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>



                                    {{ Form::open(['url'=>route('product.destroy', $productdetail->id),'onsubmit'=>'return confirm("Are you sure you want to delete this product ?")','class'=>'form pull-left' ]) }}

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
