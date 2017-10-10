@extends('layout.base')

@section('styles')
  <style media="screen">
    #action_container {
      width: 450px;
    }
    .form_row {
      padding: 5px 0;
    }
    input, select, button {
      color: black;
      font-family: 'Raleway', sans-serif;
      font-weight: 300;
      padding: 1px 5px;
    }
    .update input {
      width: 60px;
    }
    .query input {
      width: 35px;
    }

  </style>
@endsection

@section('content')
  <form class="" action="/" method="post">
    <div class="form_row">
      <label for="size">Tamaño de la matriz NxNxN</label>
      <input id="size" type="number" name="size" value="">
    </div>
    <div class="form_row">
      <label>Acciones</label>
      <select id="actions">
        <option value="1">UPDATE</option>
        <option value="2">QUERY</option>
      </select>
      <button type="button" id="add_action">+</button>
    </div>
    <div class="form_row" id="action_container">
    </div>
    <button type="submit" name="button">
      Enviar
    </button>
  </form>
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      const template_update = `
        <div class="action update">
          <label>UPDATE</label>
          <input type="number" name="action[][x]" placeholder="x">
          <input type="number" name="action[][y]" placeholder="y">
          <input type="number" name="action[][z]" placeholder="z">
          <input type="number" name="action[][value]" placeholder="value">
          <input type="hidden" name="action[][name]" value="update">
        </div>
      `;
      const template_query = `
        <div class="action query">
          <label>QUERY</label>
          <input type="number" name="action[][x1]" placeholder="x1">
          <input type="number" name="action[][y1]" placeholder="y1">
          <input type="number" name="action[][z1]" placeholder="z1">
          <input type="number" name="action[][x2]" placeholder="x2">
          <input type="number" name="action[][y2]" placeholder="y2">
          <input type="number" name="action[][z2]" placeholder="z2">
          <input type="hidden" name="action[][name]" value="query">
        </div>
      `;
      $('#add_action').click(function() {
        const action = $( "#actions" ).val();
        if (action === '1') {
          $('#action_container').append(template_update);
        } else if (action === '2') {
          $('#action_container').append(template_query);
        }
      });
    });
  </script>
@endsection
