<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use App\User;
use App\StudentMaster;

use App\Http\Resources\User as  UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(3);
        return UserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)    {

        if ($request->isMethod('post')) {
            $data = json_decode($request->getContent(), true);
            if(isset($data['username'])){
                $login = User::where(['users.username' => $data['username'],'users.is_deleted'=> 0])
                            ->get();
            }else{
                return Response::json(array('Error'=>"Parameter Missing"));
            }          

        }else{

        }
        return UserResource::collection($login);
    }

    public function afterLoginDetails()
    {
        # code...
        if ($request->isMethod('post')) {
            $data = json_decode($request->getContent(), true);
            if (isset($data['master_id']) && isset($data['user_type_id'])) {
                # code...
                if ($data['user_type_id'] == 1) {
                    # code...
                    $masterInfo = StudentMaster::with('OrgMaster')
                    ->where(['StudentMaster.id' => $data['master_id'],'StudentMaster.is_deleted'=> 0])
                    ->get();
                }elseif ($data['user_type_id'] == 2) {
                    # code...
                   
                }elseif ($data['user_type_id'] == 3) {
                    # code...
                }else {
                    # code...
                }
            }else{
                return Response::json(array('Error'=>"Parameter Missing"));
            }
            
            return UserResource::collection($masterInfo);
        }
    }
}
