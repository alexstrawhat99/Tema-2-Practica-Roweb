<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Description;


namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;


/**
 * Class TaskController
 *
 * @package App\Http\Controllers
 */
class TasksController extends Controller
{

    /**
     * @return Application|Factory|View
     */

    public function tasks()
    {
        /** @var Task $tasks */

        $tasks = DB::table('tasks')->paginate(10);


        $tasks = $tasks->select('id', 'name', 'description', 'assignment' , 'status', 'created_at')->get();




        return view(
            'tasks.index',
            [
//                'tasks' => $tasks,
                $tasks => 'id',
                $tasks => 'name',
                $tasks => 'description',
                $tasks => 'assignment',
                $tasks => 'status',
                $tasks => 'created_at',

            ]
        );
    }

    public function updateTasks($id)
    {

    }

    public function deleteTasks($id)
    {

    }

}
