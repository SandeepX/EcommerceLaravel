@extends('layouts.admin')

@section('title','Admin dashboard')

@section ('main-content')

<!-- Modal -->
<div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="bannerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bannerModalLabel">Banner Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    {{  Form::open(['url'=>route('banner.store'),'files'=>true , 'id'=>'banner_form']) }}
    <div class="modal-body">
        
        <div class="form-group row">
            {{ Form::label('title',"Title:",['class'=>'col-md-3'])}}
            <div class="col-md-9">
                {{ Form::text('title','',['class'=>'form-control form-control-sm','id'=>'title','placeholder'=>'Enter banner title','required'=>true]) }}
            </div>
         </div>

        <div class="form-group row">
            {{ Form::label('link',"Link:",['class'=>'col-md-3'])}}
            <div class="col-md-9">
                {{ Form::url('link','',['class'=>'form-control form-control-sm','id'=>'link','placeholder'=>'Enter link','required'=>true]) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('status',"Status:",['class'=>'col-md-3'])}}
            <div class="col-md-9">
                {{ Form::select('status',['active'=>'Active','inactive'=>'Inactive'],null,['class'=>'form-control form-control-sm','id'=>'status','required'=> true]) }}
            </div>
         </div>

        <div class="form-group row">
            {{ Form::label('image',"Image:",['class'=>'col-md-3'])}}
            <div class="col-md-5">
                {{ Form::file('image',['accept'=>'image/*','required'=>true,'id'=>'image' ]) }}
            </div>
            
            <div class="col-sm-4">
                <img src="" class="img img-thumbnail img-responsive" id="thumb" alt="">
            </div>
        </div>
    </div>
      <div class="modal-footer">
        <input type="hidden" name="_method" id="method" value="post">
        <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash" ></i>Reset</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" ></i>Submit</button>
      </div>
    {{ Form::close() }}

    </div>
  </div>
</div>

@section('scripts')
    <script>
        $('.add_btn').click(function(e){
            e.preventDefault();
            $('.modal-title').html('Banner Add');
            $('#title').val('');
            $('#link').val('');
            $('#status').val('active');
            $('#thumb').attr('src'," ");
            $('#banner_form').attr('action',"{{ route('banner.store') }}");
            $('#method').attr('method','post');
            $('#bannerModal').modal('show');

        });

        $('.edit_banner').click( function(e){
             e.preventDefault();
             var banner_id = $(this).data('id');
             
             $.ajax({
                url: "{{ route('banner-detail')}}",
                type: "post",
                data:{
                    ban_id: banner_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                   if (typeof(response)!='object') {
                    response = $.parseJSON(response);
                   }

                   if(response.status){
                        $('.modal-title').html('Banner Update');
                        $('#title').val(response.data.title);
                        $('#link').val(response.data.link);
                        $('#status'). val(response.data.status);
                        $('#thumb').attr('src',"{{asset('uploads/banner')}}/Thumb-"+response.data.image);
                        $('#banner_form').attr('action',"/admin/banner/"+ response.data.id);
                        $('#method').val('put');
                        $('#image').removeAttr('required','required');
                        $('#bannerModal').modal('show');
                    }

                }
             });
        });


    </script>
@endsection
    
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Banner List</div>
                <a href="" class="btn  btn-success add_btn">
                    <i class="fa fa-plus"></i>Add Banner
                </a>
            </div>
        
        <div class="ibox-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($bannerData))
                        @foreach($bannerData as $key=>$bannerdetail)
                            <tr>
                                <td> {{ $bannerdetail->title}} </td>
                                <td> 
                                    <a href="{{ $bannerdetail->link}}" target="_link" class=" btn-link">{{ $bannerdetail->link}}</a> 
                                </td>

                                <td> 
                                    <img src="{{ asset('uploads/banner/Thumb-'.$bannerdetail->image) }}" alt="" class="img img-thumbnail img-responsive">
                                </td>
                                <td>
                                    <span class="badge badge-{{ ( $bannerdetail->status=='active') ? 'success':'danger'}}">{{ ucfirst ($bannerdetail->status) }}</span> 
                                     </td>
                                <td>
                                    <a href="" class="btn btn-success pull-left edit_banner" style="border-radius:50%;"      data-id="{{ $bannerdetail->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>










                                    {{ Form::open(['url'=>route('banner.destroy', $bannerdetail->id),'onsubmit'=>'return confirm("Are you sure you want to delete this banner ?")','class'=>'form pull-left' ]) }}

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
