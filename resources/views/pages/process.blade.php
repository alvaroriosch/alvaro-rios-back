@extends('layout.base')

@section('content')
  <section class="results">
    <h2>Resultados</h2>
    @foreach ($results as $result)
      <div class="result">
        {{ $result }}
      </div>
    @endforeach
  </section>
@endsection
