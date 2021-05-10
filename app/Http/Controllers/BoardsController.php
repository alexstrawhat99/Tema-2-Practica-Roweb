<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers
 */
class BoardsController extends Controller
{
    public function boards()
    {
        $boards = DB::table('boards')->paginate(10);

        return view(
            'boards.index',
            [
                'boards' => $boards
            ]
        );
    }
}
