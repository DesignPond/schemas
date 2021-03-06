@extends('layouts.master')

@section('content')

<!-- Subheader -->
@include('partials.subheader')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h3><img src="{{ asset('images/icon/revision.png') }}" alt="icone" class="icon-title-manage" /> &nbsp;Projets en révision</h3>
            </div>
        </div>
        <div class="row">
            <div class="span12 gallery user-gallery">

                @if(!empty($projets))
                    @foreach($projets as $status => $liste)
                        @foreach($liste as $projet)
                            <!-- gallery item -->
                            <div class="item">

                                @include('partials.projet')

                                <div class="optionsProjet">

                                    {{ Form::open(array('method' => 'POST','url' => array('compose/status')))}}
                                        <input type="hidden" value="{{ $projet['id'] }}" name="id">
                                        <input type="hidden" value="actif" name="status">
                                        <button class="btn btn-mini option-approuve">Approuver</button>
                                    {{ Form::close() }}
                                    
							        {{ Form::open(array('method' => 'POST','url' => array('compose/status')))}}
							            <input type="hidden" value="{{ $projet['id'] }}" name="id">
							            <input type="hidden" value="archive" name="status">
							            <button class="btn btn-mini option-archive">Archiver</button>
							        {{ Form::close() }}

                                    <a href="{{ url('compose/'.$projet['id'].'/delete') }}"
                                       data-action="Projet"
                                       class="deleteAction btn btn-mini option-delete btn-last">
                                        Supprimer
                                    </a>

                                </div>
                            </div>
                            <!-- close gallery item -->
                        @endforeach
                        <hr/>
                    @endforeach
                @endif

            </div>
        </div>

    </div>
</div>

@stop