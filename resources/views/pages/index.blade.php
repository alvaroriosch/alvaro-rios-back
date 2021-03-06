@extends('layout.base')

@section('styles')
  <style media="screen">
    #action_container {
      width: 450px;
    }
    .error {
      color: red;
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
  <form action="/" method="post">
    {{ csrf_field() }}
    <div class="error"></div>
    <div class="form_row">
      <label for="size">Tamaño de la matriz N x N x N</label>
      <input
        id="size"
        type="number"
        name="size"
        required
        min="{{ App\Models\Matriz::$MIN_MATRIZ_SIZE }}"
        max="{{ App\Models\Matriz::$MAX_MATRIZ_SIZE }}">
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
      let num_actions = [0,0];
      const template_update = `
        <div class="action update">
          <label>UPDATE</label>
          <input type="number" name="action[@action_number][x]" placeholder="x" required
            min="{{ App\Models\Matriz::$MIN_POINT }}"
            max="@max">
          <input type="number" name="action[@action_number][y]" placeholder="y" required
            min="{{ App\Models\Matriz::$MIN_POINT }}"
            max="@max">
          <input type="number" name="action[@action_number][z]" placeholder="z" required
            min="{{ App\Models\Matriz::$MIN_POINT }}"
            max="@max">
          <input type="number" name="action[@action_number][value]" placeholder="value"
            required
            min="{{ App\Models\Matriz::$MIN_VALUE }}"
            max="{{ App\Models\Matriz::$MAX_VALUE }}">
          <input type="hidden" name="action[@action_number][name]"
            value="{{ App\Models\Matriz::$UPDATE_ACTION_NAME }}">
        </div>
      `;
      const template_query = `
        <div class="action query">
          <label>QUERY</label>
          <input type="number" name="action[@action_number][x1]" placeholder="x1" required
            min="{{ App\Models\Matriz::$MIN_POINT }}"
            max="@max">
          <input type="number" name="action[@action_number][y1]" placeholder="y1" required
            min="{{ App\Models\Matriz::$MIN_POINT }}"
            max="@max">
          <input type="number" name="action[@action_number][z1]" placeholder="z1" required
            min="{{ App\Models\Matriz::$MIN_POINT }}"
            max="@max">
          <input type="number" name="action[@action_number][x2]" placeholder="x2" required
            min="{{ App\Models\Matriz::$MIN_POINT }}"
            max="@max">
          <input type="number" name="action[@action_number][y2]" placeholder="y2" required
            min="{{ App\Models\Matriz::$MIN_POINT }}"
            max="@max">
          <input type="number" name="action[@action_number][z2]" placeholder="z2" required
            min="{{ App\Models\Matriz::$MIN_POINT }}"
            max="@max">
          <input type="hidden" name="action[@action_number][name]"
          value="{{ App\Models\Matriz::$QUERY_ACTION_NAME }}">
        </div>
      `;
      $('#size').keyup(function() {
        const matriz_size = $('#size').val();
        $('.action input').attr('max', matriz_size);
      });
      $('#add_action').click(function() {
        const matriz_size = $('#size').val();
        if (matriz_size == ""
          || parseInt(matriz_size) < {{ App\Models\Matriz::$MIN_MATRIZ_SIZE }}
          || parseInt(matriz_size) > {{ App\Models\Matriz::$MAX_MATRIZ_SIZE }}) {
            $('.error').text(`Debe colocar el tamaño de la matriz y debe
              ser un valor entre `+ {{ App\Models\Matriz::$MIN_MATRIZ_SIZE }} +`
              y `+ {{ App\Models\Matriz::$MAX_MATRIZ_SIZE }});
            return;
        }
        $('.error').text('');
        const action = $('#actions').val();
        if (action === '1') {
          const html = template_update
            .replace(/@max/g, matriz_size)
            .replace(/@action_number/g,num_actions[0] + num_actions[1]);
          $('#action_container').append(html);
          num_actions[0] += 1;
        } else if (action === '2') {
          const html = template_query
            .replace(/@max/g, matriz_size)
            .replace(/@action_number/g,num_actions[0] + num_actions[1]);
          $('#action_container').append(html);
          num_actions[1] += 1;
        }
      });
      $('form').submit(function(e){
        if (num_actions[0] == 0 && num_actions[1] == 0) {
          $('.error').text('Está prueba no tiene ninguna acción, seleccione alguna');
          e.preventDefault();
        }
        if (num_actions[0] > 0 && num_actions[1] == 0) {
          $('.error').text('Está prueba no tiene ninguna acción de consulta');
          e.preventDefault();
        }
        if (num_actions[0] == 0 && num_actions[1] > 0) {
          $('.error').text('Está prueba no tiene ninguna acción de actualización');
          e.preventDefault();
        }
      });
    });
  </script>
@endsection
