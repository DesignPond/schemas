@extends('layouts.master')

@section('content')

<!-- Subheader -->
@include('partials.subheader')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h3><img src="{{ asset('images/icon/submitted.png') }}" alt="icone" class="icon-title-manage" /> &nbsp;Projets soumis pour approbation</h3>
            </div>
        </div>
        <div class="row">
            <div class="span12 gallery user-gallery">

                @if(!empty($projets))
                    @foreach($projets as $status => $liste)
                        @foreach($liste as $projet)
                        
                            <!-- gallery item -->
                          
                                @include('partials.card')
                       
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