@extends('Layouts.iframe')

@section('iframe-body')
<div class="container ">

@if(!empty($model->id))
{{-- UPDATE --}}
{{ Form::model($model, array('route' => array('Admin.Products.Update', $model->id), 'files' => true)) }}
@else
{{-- NEW --}}
{{ Form::model($model, array('route' => array('Admin.Products.Store', $model->id), 'files' => true)) }}
@endif

    <div role="tabpanel">

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#infoTab" aria-controls="infoTab" role="tab" data-toggle="tab">Info</a></li>
        <li role="presentation"><a href="#imagesTab" aria-controls="imagesTab" role="tab" data-toggle="tab">Images</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="infoTab">
            @include('Form.input', array(
                'label'=>'Title',
                'type'=>'text',
                'placeholder'=>'Title',
                'name'=>'title',
            ))

            @include('Form.input', array(
                'label' => 'Description',
                'type' => 'textarea',
                'class' => 'full-width wysihtml5',
                'rows' => 6,
                'placeholder' => 'Description',
                'name' => 'description',
            ))


            @include('Form.input', array(
                'label'=>'Tags',
                'type'=>'select',
                'name'=>'tags[]',
                'options' => $tags,
                'selectedValue' => Input::old('tags', isset($model) ? $model->getRelatedIDs('tags') : null),
                'class' => 'select2',
                'multiple' => 'multiple',
            ))

            @include('Form.input', array(
                'label'=>'Price',
                'type'=>'text',
                'name'=>'price',
                'placeholder'=>'Price',
            ))
        </div>
        <div role="tabpanel" class="tab-pane" id="imagesTab">
            <div class="row">
                <div class="col-sm-6">
                    @include('Form.input', array(
                        'label'=>'Upload images',
                        'type'=>'file',
                        'name'=>'images[]',
                        'additional' => ' multiple="true" ',
                    ))
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Choose image from gallery</label><br/>
                    <a onclick="return popupwindow('{{ URL::route('Admin.Images.Popup') }}', 'Images', 700, 500)" class="btn btn-primary"><i class="fa fa-image"></i> Add image</a>
                    <ul id="newImages">
                    </ul>
                    <input type="hidden" id="imagesToAdd" name="imagesToAdd" value="[]">
                </div>
            </div>


            @if(!empty($model->id))
                @include('Form.image-roll', array(
                    'images'=>$model->images()->get(),
                ))
            @endif
        </div>
      </div>

    </div>

    <button type="submit" class="btn btn-success">
    <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
    </button>

    <input type="hidden" name="iframe" value="1"/>
{{ Form::close() }}
</div>

<script src="//cdn.ckeditor.com/4.4.5/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
</script>

@section('scripts')
    @parent
    <script>
        var imagesToAdd = [];
        function selectImage(id, title){
            var li = $("<li>").text(title).attr({'data-id' : id});
            $("#newImages").append(li);
            imagesToAdd.push(id);
            console.log(imagesToAdd);
            $("#imagesToAdd").val(JSON.stringify(imagesToAdd));
        }

        $(function(){
            initImageRoll();
        })
    </script>
@endsection

@stop
