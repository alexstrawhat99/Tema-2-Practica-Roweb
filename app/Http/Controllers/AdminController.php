<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    public function users()
    {
        $users = DB::table('users')->paginate(10);

        return view(
            'users.index',
            [
                'users' => $users
            ]
        );
    }

//functia ajax pentru edit admin button
//    function getdata()
//    {
//        $users = User::select('id', 'first_name', 'last_name');
//        return Datatables::of($users)
//            ->addColumn('action', function($users){
//                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$users->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
//            })
//            ->make(true);
//    }

    public function ajaxRequest()

    {

        return view('ajaxRequest');

    }

    public function ajaxRequestPost(Request $request)

    {

        $input = $request->all();

        return response()->json(['success'=>'Got Simple Ajax Request.']);

    }

}
