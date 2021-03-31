<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return view('user.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  \Yajra\DataTables\DataTables  $dt
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $req, DataTables $dt)
    {
        $columns = [
            'users.name as user_name',
            'role',
            'email',
            // Hidden column
            'users.id'
        ];

        $data = User::select($columns)
        ->orderBy('users.name', 'asc');

        return $dt->eloquent($data)
                ->addIndexColumn()
                ->filterColumn('user_name', function($query, $keyword) {
                    $sql = "LOWER(`users`.`name`) LIKE ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->addcolumn('action', function($row) use ($req) {
                    return  '<a data-toggle="tooltip" title="Edit" href="'.route('user.edit',['id'=>$row->id]).'"><i class="bx bx-edit"></i></a>'.
                            '<a data-toggle="tooltip" title="Delete" href="#" onclick="deleteRow(\'delete-form-'.$row->id.'\', userTable)"><i class="bx bx-trash"></i></a>'.
                            '<form id="delete-form-'.$row->id.'" action="'.route('user.delete',['id'=>$row->id]).'" method="POST" style="display: none;"><input name=_token value='.csrf_token().' type=hidden></form>';
                })
                ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function form(Request $req)
    {
        $user = User::find($req->route('id'));
        $roles = [
            'Developer',
            'Satgas Covid-19',
            'Relawan',
        ];

        return view('user.form', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function save(Request $req)
    {
        $id = $req->route('id');

        // Form Validation
        if(!$id){
            $rules = [
                'email' => 'required|unique:users,email',
                'name' => 'required',
                'role' => 'required',
                'password' => 'required',
            ];
        }else{
            $rules = [
                'email' => 'required|unique:users,email,'.$id,
                'name' => 'required',
                'role' => 'required',
            ];
        }

        $attributes = [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
        ];
        $this->validate($req,$rules,[],$attributes);

        // Database Transaction
        \DB::beginTransaction();
        try {
            // Make Instance
            if($req->route('id')){
                $user = User::findOrFail($req->route('id'));
            }else{
                $user = new User;
            }

            // Assign Value
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            if(!$id && $req->input('password')) {
                $user->password = bcrypt($req->input('password'));
            }
            $user->role = $req->input('role');
            $user->save();

            // Response Message
            $response = ($id) ? trans('message.update.success') : trans('message.create.success');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error("user.save: {$e->getMessage()}");

            // Response Message
            $response = ($id) ? trans('message.update.failed') : trans('message.create.failed');
        }

        // End Database Transaction
        \DB::commit();

        // Return Response
        if($req->ajax()){
            return response()->json($response);
        }else{
            $req->session()->flash('status',$response);
            return redirect()->route('user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        // Database Transaction
        \DB::beginTransaction();

        try {
            // Make Instance
            $user = User::findOrFail($req->route('id'));
            $user->delete();

            // Response Message
            $response = trans('message.delete.success');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error("user.delete: {$e->getMessage()}");

            // Response Message
            $response = trans('message.delete.failed');
        }

        // End Database Transaction
        \DB::commit();

        // Return Response
        if($req->ajax()){
            return response()->json($response);
        }else{
            $req->session()->flash('status',$response);
            return redirect()->route('user');
        }
    }
}
