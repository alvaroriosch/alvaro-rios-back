<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Matriz;

class PageController extends Controller
{
  public static $INDEX_VIEW = "pages.index";
  public static $PROCESS_VIEW = "pages.process";
  public function index(Request $request)
  {
    return view(PageController::$INDEX_VIEW, []);
  }

  public function process(Request $request)
  {
    $request->validate([
      'size' => 'required|min:'.Matriz::$MIN_MATRIZ_SIZE.'|max:'.Matriz::$MAX_MATRIZ_SIZE
    ]);

    $input = $request->all();

    $matriz = new Matriz($input['size']);
    $results = [];
    foreach ($input['action'] as $action)
    {
      if ($action['name'] == Matriz::$UPDATE_ACTION_NAME) {
        $matriz->update($action['x'], $action['y'], $action['z'], $action['value']);
      }
      if ($action['name'] == Matriz::$QUERY_ACTION_NAME) {
        $sum = $matriz->query(
          $action['x1'],
          $action['y1'],
          $action['z1'],
          $action['x2'],
          $action['y2'],
          $action['z2']
        );
        array_push($results, $sum);
      }
    }

    return view(PageController::$PROCESS_VIEW, [
      'results' => $results
    ]);
  }
}
