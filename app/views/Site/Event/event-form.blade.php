@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{asset('assets/css/jquery.datetimepicker.css')}}">
@endsection

@section('notifications')
@show

@if(!empty($model->id))
    {{-- UPDATE --}}
    {{ Form::model($model, array('route' => array('Api.UpdateEvent', $model->id))) }}
@else
    {{-- NEW --}}
    {{ Form::model($model, array('route' => array('Api.StoreEvent', $model->id))) }}
@endif


<div class="global-notifications text-center">
    @if (Session::get('error'))
        <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
    @endif

    @if (Session::get('notice'))
        <div class="alert alert-success">{{{ Session::get('notice') }}}</div>
    @endif
</div>


<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#infoTab" aria-controls="infoTab" role="tab" data-toggle="tab">Informacije</a>
        </li>
        <li role="presentation"><a href="#imagesTab" aria-controls="imagesTab" role="tab" data-toggle="tab">Slike</a>
        </li>
        @if(!empty($model->id) and (date_format(new DateTime($model->end), "Y-m-d H:i:s") < date("Y-m-d H:i:s")))
            <li role="presentation"><a href="#reportTab" aria-controls="reportTab" role="tab"
                                       data-toggle="tab">Izvještaj</a>
            </li>
        @endif

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="infoTab">

            @include('Form.input', array(
            'label'=>'Naziv aktivnosti',
            'type'=>'text',
            'placeholder'=>'Naziv aktivnosti',
            'name'=>'name',
            ))

            @include('Form.input', array(
            'label' => 'Opis aktivnosti',
            'type' => 'textarea',
            'class' => 'full-width wysihtml5',
            'rows' => 6,
            'placeholder' => 'Opis aktivnosti',
            'name' => 'description',
            ))

            @include('Form.input', array(
            'label'=>'Procjena broja volontera',
            'type'=>'number',
            'placeholder'=>'Broj volontera',
            'name'=>'estimated_volunteers_no',
            ))

            @include('Form.input', array(
            'label'=>'Početni datum aktivnosti',
            'type'=>'text',
            'placeholder'=>'Početni datum aktivnosti',
            'name'=>'start',
            'additional' => 'data-datetimepicker',
            ))

            @include('Form.input', array(
            'label'=>'Završni datum aktivnosti',
            'type'=>'text',
            'placeholder'=>'Završni datum aktivnosti',
            'name'=>'end',
            'additional' => 'data-datetimepicker',
            ))

            @include('Form.input', array(
            'label'=>'Vrijeme u kojem se aktivnost odvija (npr. 10-12)',
            'type'=>'text',
            'placeholder'=>'Radni sati volontiranja',
            'name'=>'working_hours',
            ))

            @include('Form.input', array(
            'label'=>'Ukupan broj sati',
            'type'=>'text',
            'placeholder'=>'Ukupan broj sati',
            'name'=>'total_hours',
            ))

            @include('Form.input', array(
            'label'=>'Adresa',
            'type'=>'text',
            'placeholder'=>'Adresa',
            'name'=>'address',
            ))

            @include('Form.input', array(
            'label'=>'Email',
            'type'=>'text',
            'placeholder'=>'Email',
            'name'=>'email',
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
            'placeholder'=>'Kontakt osoba',
            'name'=>'contact_person',
            ))

            @include('Form.input', array(
            'label'=>'Kontakt telefon',
            'type'=>'text',
            'placeholder'=>'Phone',
            'name'=>'phone',
            ))


            @include('Form.input', array(
            'label' => 'Potreba za volonterima* - Poziv volonterima da se pridruže vašem događaju',
            'type' => 'textarea',
            'class' => 'full-width',
            'rows' => 6,
            'placeholder' => 'Poziv volonterima na volontiranje',
            'name' => 'additional_note',
            ))
            <div class="alert alert-info" role="alert">
                <p>
                    *U slučaju da ćete trebati pomoć pri regrutaciji volontera za prijavljene volonterske aktivnosti,
                    obratite se nadležnom volonterskom centru
                </p>
            </div>


            @include('Form.input', array(
            'label'=>'Događaj',
            'type'=>'select',
            'name'=>'action_id',
            'options' => Action::all()->lists('name', 'id'),
            'selectedValue' => Input::old('action_id', isset($model) ? $model->action_id : null),
            'class' => 'select2',
            ))

            @include('Form.input', array(
            'label'=>'Oznake o područjima volonterske aktivnosti',
            'type'=>'select',
            'name'=>'tags[]',
            'options' => Tag::all()->lists('name','id'),
            'selectedValue' => Input::old('tags', isset($model) ? $model->getRelatedIDs('tags') : null),
            'class' => 'select2',
            'multiple' => 'multiple',
            ))

            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4>Nakon završetka manifestacije, potrebno je, najkasnije do <b>27. svibnja</b>, popuniti
                    izvještajni
                    obrazac i
                    priložiti barem jednu fotografiju s provedene aktivnosti
                </h4>
            </div>


            <button type="submit" class="btn btn-light-form">
                <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
            </button>
        </div>

        <div role="tabpanel" class="tab-pane" id="imagesTab">
            @if(!empty($model->id))

                <div class="image-roll">
                    <ul>
                        @foreach($model->images()->get() as $image)
                            <li class="image-roll-item" data-id="{{ $image->id }}">
                                <img src="{{ \Helpers\ImageHelper::getImageUrl($image, 'thumbnail') }}"
                                     alt="{{ $image->caption }}">


                                <div class="delete-icon">
                                    <a href="javascript:void(0)"
                                       onclick="deleteImage(this, {{ $image->id }}, {{ $model->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                <div class="preview-icon">
                                    <a href="{{ \Helpers\ImageHelper::getImageUrl($image, 'original') }}" rel="event"
                                       class="fancybox">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
                <input type="hidden" id="imagesToDelete" name="imagesToDelete" value="[]">

                <hr>

                <a href="javascript:void(0)"
                   class="btn btn-light-small addImageTrigger">
                    <i class="fa fa-image"></i> Dodaj slike
                </a>
                <hr>
                <p>Molimo učitavajte slike (.jpeg,.png,.gif) do 4Mb veličine</p>
            @else


                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4> Kako bi ste dodali sliku, potrebno je prvo registrirati volontersku aktivnost !

                    </h4>
                </div>
            @endif
        </div>

        <div role="tabpanel" class="tab-pane" id="reportTab">
            @if(!empty($model->id) and (date_format(new DateTime($model->end), "Y-m-d H:i:s") < date("Y-m-d H:i:s")))

                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4>Nakon završetka manifestacije, potrebno je, najkasnije do <b>27. svibnja</b>, popuniti
                        izvještajni
                        obrazac i
                        priložiti barem jednu fotografiju s provedene aktivnosti
                    </h4>
                </div>
                <h1>Završni izvještaj o aktivnosti</h1>
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

                <button type="submit" class="btn btn-light-form">
                    <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
                </button>
            @endif
        </div>
    </div>
</div>


<input type="hidden" name="iframe" value="1"/>
{{ Form::close() }}

<!-- Modal -->
<div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Dodajte novu sliku</h4>
            </div>

            <div class="modal-body">
                <iframe style="border: 0; width: 100%;height: 100%"
                        data-src="{{URL::route('Site.MyEvent.Images', array('id' => $model->id))}}">
                    Greška.
                </iframe>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent

    <script src="//cdn.ckeditor.com/4.4.5/full/ckeditor.js"></script>
    <script type="text/javascript" language="javascript" src="{{asset('assets/js/jquery.datetimepicker.js')}}"></script>
    <script>

        CKEDITOR.replace('description');

        @if(!empty($model->id) and (date_format(new DateTime($model->end), "Y-m-d H:i:s") < date("Y-m-d H:i:s")))
        CKEDITOR.replace('final_report');
        @endif

        function deleteImage(elem, imageId, eventId) {

            if (!confirm('Jeste li sigurni?')) {
                return;
            }

            var url = "{{ URL::route('Api.DeleteEventImage') }}";
            jQuery.ajax({
                url: url,
                type: "POST",
                dataType: "JSON",
                data: {imageID: imageId, eventID: eventId},
                success: function (data, textStatus, jqXHR) {
                    if (data.status == "OK") {
                        jQuery(elem).parents('.image-roll-item').remove();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        }

        jQuery(function () {
            jQuery('*[data-datetimepicker]').datetimepicker({
                lang: 'hr',
                format: 'd.m.Y. H:i'
            });

            window.imagesModal = jQuery('#imagesModal');

            jQuery('.addImageTrigger').on("click", function () {
                jQuery('#imagesModal iframe').each(function () {
                    $(this).attr('src', $(this).attr('data-src'));
                });

                window.imagesModal.modal({keyboard: false});
            });
        });
    </script>
@endsection
