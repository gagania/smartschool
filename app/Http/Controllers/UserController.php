<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return User::orderBy('id','DESC')->paginate(5);
        // return view('users.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    public function student(Request $request)
    {
        return User::where('type','=','S')->orderBy('id','DESC')->paginate(5);
        // return view('users.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function teacher(Request $request)
    {
        return User::where('type','=','T')->orderBy('id','DESC')->paginate(5);
        // return view('users.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|same:confirm-password',
        //     'roles' => 'required'
        // ]);
    
        $input = $request->input('user');
        if (!isset($input['roles'])) {
            $input['roles'] = 'User';
        }

        if ($input['password'] != '') {
            $input['password'] = Hash::make($input['password']);
        } else {
            $randNmbr = mt_rand(100000,999999);
            $input['password'] = Hash::make($randNmbr);
            //send email
            $this->send_mail($input,$randNmbr);
        }

        $user = User::create($input);
        $role = Role::where('name', '=', $input['roles'])->firstOrFail();
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole($role->id);
            
        return $user;
        // return redirect()->route('users.index')
        //                 ->with('success','User created successfully');
    }
    
    public function send_mail($data,$pass) {
        $to_name = $data['name'];
        $to_email = $data['email'];
        $data['raw_password'] = $pass;
        $dataEmail = $data;
        Mail::send("emails.mail", $dataEmail, 
        function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject("[Smart School] Login Information");
            $message->from("tukangj4l4n@gmailc.com","[Smart School] Admin");
        });
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
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
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,'.$id,
        //     'password' => 'same:confirm-password',
        //     'roles' => 'required'
        // ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        if ($user) {
            $user->update($input);
            
            if ($request->input('roles')) {
                $role = Role::where('name', '=', $request->input('roles'))->firstOrFail();
                DB::table('model_has_roles')->where('model_id',$id)->delete();
                
                $permissions = Permission::pluck('id','id')->all();
                $role->syncPermissions($permissions);
                $user->assignRole($request->input('roles'));
            }
        
            return $user;
        }

        return "user not found";
        // return redirect()->route('users.index')
        //                 ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete($id);
            return 'User deleted successfully';
        }

        return "user not found";
    }
}