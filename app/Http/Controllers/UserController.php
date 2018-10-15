<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function MongoDB\BSON\toJSON;
use Response;
use Validator;

use App\User;
use App\StudentMaster;
use App\ParentMaster;
use App\StaffMaster;

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
    public function addUser(Request $request)
    {
        //
        if ($request->isMethod('post')) {
            $data = json_decode($request->getContent(), true);
            $rules = [
                'username' => 'required|unique:users|max:255',
                'user_type_id' => 'required|digits:1',
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->passes()) {
                //TODO Handle your data
                if ($data['user_type_id'] == 1) {
                    # code...

                }elseif ($data['user_type_id'] == 2) {
                    # code...
                   $staff = new StaffMaster();
                   $staff->user_name = $data['username'];
                   $staff->f_name = $data['fname'];
                   $staff->l_name = $data['lname'];
                   $staff->name = $data['fname']." ".$data['lname'];
                   $staff->org_id = $data['org_id'];
//                   print_r($staff->save());
                   if($staff->save() == 1){
                      $user = new User();
                      $user->username = $data['username'];
                      $six_digit_random_number = mt_rand(100000, 999999);
                        $user->password = Hash::make($six_digit_random_number);
                        $user->master_id = $staff->id;
                        $user->user_type_id = $data['user_type_id'];
                        $user->org_code = $data['org_id'];
                        $user->hint = $six_digit_random_number;
                       if($user->save() == 1){
                           return new UserResource($user);
                       }else{
                           return Response::json(array('Error'=>"Some Went Wrong. Try Again"));
                       }
                   }

                }elseif ($data['user_type_id'] == 3) {
                    # code...

                }else {
                    # code...

                }
            } else {
                //TODO Handle your error
                return Response::json(array('Error'=>$validator->errors()));
//                dd($validator->errors()->all());
            }

//            $data = json_decode($request->getContent(), true);

        }
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
            if(isset($data['username']) && isset($data['password'])){
                $login = User::where(['users.username' => $data['username'],'users.hint'=> $data['password'],'users.is_deleted'=> 0])
                            ->get();
            }else{
                return Response::json(array('Error'=>"Parameter Missing"));
            }          

        }else{

        }
        return UserResource::collection($login);
    }

    public function afterLoginDetails(Request $request)
    {
        # code...
        if ($request->isMethod('post')) {
            $data = json_decode($request->getContent(), true);
            if (isset($data['master_id']) && isset($data['user_type_id']) && isset($data['username'])) {
                # code...
                if ($data['user_type_id'] == 1) {
                    # code...
                    $masterInfo = StudentMaster::with('OrgMaster')
                    ->where(['StudentMaster.id' => $data['master_id'],'StudentMaster.is_deleted'=> 0])
                    ->get();
                }elseif ($data['user_type_id'] == 2) {
                    # code...
                    $masterInfo = StaffMaster::with('OrgMaster')
                        ->where(['staff_masters.id' => $data['master_id'],'staff_masters.is_deleted'=> 0,
                                    'staff_masters.user_name' => $data['username']])
                        ->get();
                }elseif ($data['user_type_id'] == 3) {
                    # code...
                    $masterInfo = ParentMaster::with('OrgMaster')
                        ->where(['ParentMaster.id' => $data['master_id'],'ParentMaster.is_deleted'=> 0,
                            'ParentMaster.username' => $data['username']])
                        ->get();
                }else {
                    # code...
                    $masterInfo = StudentMaster::with('OrgMaster')
                        ->where(['student_masters.id' => $data['master_id'],'student_masters.is_deleted'=> 0,
                            'student_masters.user_name'=> $data['username']])
                        ->get();
                }
            }else{
                return Response::json(array('Error'=>"Parameter Missing"));
            }
            
            return UserResource::collection($masterInfo);
        }
    }

}
