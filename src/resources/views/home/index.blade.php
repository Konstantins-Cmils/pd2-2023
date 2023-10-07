
@extends('layout')

@section('content')
     <h1>{{ $title }}</h1>
    <hr>
   @if (count($items) > 0)

        //

   @else
        <p>Nav atrasts neviens ieraksts</p>

    @endif

@endsection
