@extends('layout.base')

@section('content')
  <section class="results">
    @foreach ($results as $result)
      <div class="result">
        {{ $result }}
      </div>
    @endforeach
  </section>
@endsection
