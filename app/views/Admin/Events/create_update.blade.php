@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{asset('assets/css/jquery.datetimepicker.css')}}">
@endsection
@extends('Layouts.iframe')

@section('iframe-body')
    <div class="container ">

        @if(!empty($model->id))
            {{-- UPDATE --}}
            {{ Form::model($model, array('route' => array('Admin.Events.Update', $model->id), 'files' => true)) }}
        @else
            {{-- NEW --}}
            {{ Form::model($model, array('route' => array('Admin.Events.Store', $model->id), 'files' => true)) }}
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
                    'label'=>'Naziv volonterskog događaja',
                    'type'=>'text',
                    'placeholder'=>'Naziv',
                    'name'=>'name',
                    ))

                    @include('Form.input', array(
                    'label'=>'Email',
                    'type'=>'text',
                    'placeholder'=>'email',
                    'name'=>'email',
                    ))

                    @include('Form.input', array(
                    'label' => 'Opis događaja',
                    'type' => 'textarea',
                    'class' => 'full-width wysihtml5',
                    'rows' => 6,
                    'placeholder' => 'Opis',
                    'name' => 'description',
                    ))

                    @include('Form.input', array(
                    'label'=>'Procjena broja volontera',
                    'type'=>'number',
                    'placeholder'=>'Procjena',
                    'name'=>'estimated_volunteers_no',
                    ))

                    @include('Form.input', array(
                    'label'=>'Početak događaja',
                    'type'=>'text',
                    'placeholder'=>'početak',
                    'name'=>'start',
                    'additional' => 'data-datetimepicker',
                    ))

                    @include('Form.input', array(
                    'label'=>'Kraj događaja',
                    'type'=>'text',
                    'placeholder'=>'Kraj',
                    'name'=>'end',
                    'additional' => 'data-datetimepicker',
                    ))

                    @include('Form.input', array(
                    'label'=>'Volonterski sati',
                    'type'=>'text',
                    'placeholder'=>'Volonterski sati',
                    'name'=>'working_hours',
                    ))

                    @include('Form.input', array(
                    'label'=>'Ukupno sati',
                    'type'=>'text',
                    'placeholder'=>'Ukupno sati',
                    'name'=>'total_hours',
                    ))

                    @include('Form.input', array(
                    'label'=>'Adresa',
                    'type'=>'text',
                    'placeholder'=>'Adresa',
                    'name'=>'address',
                    ))

                    @include('Form.input', array(
                    'label'=>'Grad',
                    'type'=>'select',
                    'name'=>'city_id',
                    'options' => City::all()->lists('name', 'id'),
                    'selectedValue' => Input::old('city_id', isset($model) ? $model->city_id : null),
                    'class' => 'select2',
                    ))

                    @include('Form.input', array(
                    'label'=>'Kontakt osoba',
                    'type'=>'text',
                    'placeholder'=>'Kontakt',
                    'name'=>'contact_person',
                    ))

                    @include('Form.input', array(
                    'label'=>'Telefon',
                    'type'=>'text',
                    'placeholder'=>'Telefon',
                    'name'=>'phone',
                    ))

                    @include('Form.input', array(
                    'label' => 'Poziv na volontiranje',
                    'type' => 'textarea',
                    'class' => 'full-width',
                    'rows' => 6,
                    'placeholder' => 'poruka volonterima',
                    'name' => 'additional_note',
                    ))


                    @include('Form.input', array(
                    'label'=>'Akcija',
                    'type'=>'select',
                    'name'=>'action_id',
                    'options' => Action::all()->lists('name', 'id'),
                    'selectedValue' => Input::old('action_id', isset($model) ? $model->action_id : null),
                    'class' => 'select2',
                    ))

                    @include('Form.input', array(
                    'label'=>'Oznake',
                    'type'=>'select',
                    'name'=>'tags[]',
                    'options' => Tag::all()->lists('name','id'),
                    'selectedValue' => Input::old('tags', isset($model) ? $model->getRelatedIDs('tags') : null),
                    'class' => 'select2',
                    'multiple' => 'multiple',
                    ))

                    @include('Form.input', array(
                    'label'=>'Organizator',
                    'type'=>'select',
                    'name'=>'host_id',
                    'options' => Host::all()->lists('name','id'),
                    'selectedValue' => Input::old('host_id', isset($model) ? $model->host_id : null),
                    'class' => 'select2',
                    ))


                    <h2>Završni izvještaj</h2>

                    @include('Form.input', array(
                       'label' => 'Završni izvještaj o aktivnosti',
                       'type' => 'textarea',
                       'class' => 'full-width wysihtml5',
                       'rows' => 6,
                       'placeholder' => 'Opis aktivnosti',
                       'name' => 'final_report',
                       ))

                    @include('Form.input', array(
                          'label'=>'Konačni broj volontera',
                          'type'=>'text',
                          'placeholder'=>'Konačni broj volontera',
                          'name'=>'final_estimated_volunteers_no',
                          ))

                    @include('Form.input', array(
                      'label'=>'Završni broj sati',
                      'type'=>'text',
                      'placeholder'=>'Ukupan broj sati',
                      'name'=>'final_total_hours',
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
                            <label class="control-label">Odaberi sliku iz galerije</label><br/>
                            <a onclick="return popupwindow('{{ URL::route('Admin.Images.Popup') }}', 'Images', 700, 500)"
                               class="btn btn-primary">
                                <i class="fa fa-image"></i>Dodaj sliku</a>
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
        CKEDITOR.replace('final_report');


        jQuery(function () {
            jQuery('*[data-datetimepicker]').datetimepicker({
                lang: 'hr',
                format: 'd.m.Y. H:i'
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

