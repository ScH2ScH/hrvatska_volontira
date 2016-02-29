@extends('Layouts.admin')

@section('content')
    @parent
    @include('Navigation.menu')

    <div class="container">
        <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#infoTab" aria-controls="infoTab" role="tab"
                                                          data-toggle="tab">Informacije</a>
                </li>
                <li role="presentation"><a href="#imagesTab" aria-controls="imagesTab" role="tab" data-toggle="tab">Slike</a>
                </li>
            </ul>

            {{ Form::model($model, array('route' => array('Admin.Homepage.Update', $model->id),'files' => true)) }}

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="infoTab">

                    <h1>Tekstovi na početnoj stranici</h1>

                    <div class="notifications"></div>

                    @include('Form.input', array(
                                        'label'=>'Naslov kategorije',
                                        'type'=>'text',
                                        'placeholder'=>'Name',
                                        'name'=>'title',
                                        ))
                    @include('Form.input', array(
                                        'label' => 'Općeniti tekst o akciji',
                                        'type' => 'textarea',
                                        'class' => 'full-width wysihtml5',
                                        'rows' => 6,
                                        'placeholder' => 'Text to show on mainpage',
                                        'name' => 'general',
                                        ))

                    @include('Form.input', array(
                                       'label'=>'Podnaslov ovogodišnje akcije',
                                       'type'=>'text',
                                       'placeholder'=>'Name',
                                       'name'=>'subtitle',
                                       ))

                    @include('Form.input', array(
                                        'label' => 'Tekst o  ovogodišnjoj akciji',
                                        'type' => 'textarea',
                                        'class' => 'full-width wysihtml5',
                                        'rows' => 6,
                                        'placeholder' => 'Text to show on mainpage',
                                        'name' => 'specific',
                                        ))

                    @include('Form.input', array(
                      'label'=>'Active',
                      'type'=>'select',
                      'name'=>'active',
                      'options' => array("No", "Yes"),
                      'selectedValue' => Input::old('active', isset($model) ? $model->active : 0)
                  ))


                </div>

                <div role="tabpanel" class="tab-pane" id="imagesTab">
                    <div class="row">
                        <div class="col-sm-6">
                            @include('Form.input', array(
                                'label'=>'Upload slike',
                                'type'=>'file',
                                'name'=>'images[]',
                                'additional' => ' multiple="true" ',
                            ))
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Choose image from gallery</label><br/>
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

@stop

@section('scripts')
    @parent
    <script src="//cdn.ckeditor.com/4.4.5/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'general' );
        CKEDITOR.replace( 'specific' );

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
@stop
