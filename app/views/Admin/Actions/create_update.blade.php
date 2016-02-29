@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{asset('assets/css/jquery.datetimepicker.css')}}">
@endsection
@extends('Layouts.iframe')

@section('iframe-body')
    <div class="container ">

        @if(!empty($model->id))
            {{-- UPDATE --}}
            {{ Form::model($model, array('route' => array('Admin.Actions.Update', $model->id), 'files' => true)) }}
        @else
            {{-- NEW --}}
            {{ Form::model($model, array('route' => array('Admin.Actions.Store', $model->id), 'files' => true)) }}
        @endif


        <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#infoTab" aria-controls="infoTab" role="tab"
                                                          data-toggle="tab">Informacije</a></li>
                <li role="presentation"><a href="#imagesTab" aria-controls="imagesTab" role="tab" data-toggle="tab">Slike</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="infoTab">
                    @include('Form.input', array(
                    'label'=>'Naziv',
                    'type'=>'text',
                    'placeholder'=>'Naziv',
                    'name'=>'name',
                    ))

                    @include('Form.input', array(
                    'label' => 'Opis',
                    'type' => 'textarea',
                    'class' => 'full-width wysihtml5',
                    'rows' => 6,
                    'placeholder' => 'Opis',
                    'name' => 'description',
                    ))

                    @include('Form.input', array(
                    'label'=>'Početak',
                    'type'=>'text',
                    'placeholder'=>'Početni datum',
                    'name'=>'start',
                    'additional' => 'data-datetimepicker',
                    ))

                    @include('Form.input', array(
                    'label'=>'Završetak',
                    'type'=>'text',
                    'placeholder'=>'End',
                    'name'=>'end',
                    'additional' => 'data-datetimepicker',
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
                            <label class="control-label">Odaberite sliku iz galerije</label><br/>
                            <a onclick="return popupwindow('{{ URL::route('Admin.Images.Popup') }}', 'Images', 700, 500)"
                               class="btn btn-primary">
                                <i class="fa fa-image"></i> Add image</a>
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

        <hr>

        <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
        </button>

        <input type="hidden" name="iframe" value="1"/>
        {{ Form::close() }}
    </div>
@endsection


@section('scripts')
    @parent
    <script src="//cdn.ckeditor.com/4.4.5/full/ckeditor.js"></script>
    <script type="text/javascript" language="javascript" src="{{asset('assets/js/jquery.datetimepicker.js')}}"></script>
    <script>

        CKEDITOR.replace('description');


        jQuery(function () {
            jQuery('*[data-datetimepicker]').datetimepicker({
                lang: 'hr',
                format: 'Y-m-d H:i:m'
            });
        })

        $(function () {
            $("#total_hours").on("change", function () {
                $(this).val($(this).val().replace(/,/g, '.'));
            });
        });


        var imagesToAdd = [];
        function selectImage(id, title) {
            var li = $("<li>").text(title).attr({'data-id': id});
            $("#newImages").append(li);
            imagesToAdd.push(id);
            console.log(imagesToAdd);
            $("#imagesToAdd").val(JSON.stringify(imagesToAdd));
        }

        $(function () {
            initImageRoll();
        })
    </script>
@endsection
