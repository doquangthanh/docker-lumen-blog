<?php
namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Users;
use App\Helpers\Response;


class UsersController extends Controller
{

    protected $users;

    protected $request;

    public function __construct(Users $users, Request $request)
    {
        $this->users = $users;
        $this->request = $request;
    }

    /**
     * Check user credentials
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $validator = Validator::make($this->request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        
        $email = $this->request->input('email');
        $password = $this->request->input('password');
        $users = $this->users->getUserEmail($email);
        if ($users) {
            foreach ($users as $user) {
                $email_password = $user->password;
            }
            if (Hash::check($password, $email_password)) {
                // you can use any logic to create the apikey. You can use md5 with other hash function, random shuffled string characters also
                $apikey = base64_encode(str_random(32));               
                $this->users->updateUserApi($email,$apikey);
                return response()->json([
                    'status' => 'success',
                    'api_key' => $apikey
                ]);
            } else {
                
                return response()->json([
                    'status' => 'fail'
                ], 401);
            }
        }
    }
    
    /**
     * Get user all
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $users = $this->users->getUsers();
        if ($users) {
            return Response::json($users);
        }
        
        return Response::internalError('Unable to get the users');
    }
    
    /**
     * Get user all
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser($id)
    {
        $user = $this->users->getUser($id);
        if (! $user) {
            return Response::notFound('User not found');
        }
        
        return Response::json($user);
    }

    public function getUserPosts($id)
    {
        $user = $this->users->getUser($id);
        if (! $user) {
            return Response::notFound('User not found');
        }
        
        return $user->posts;
    }

    public function getUserComments($id)
    {
        $user = $this->users->getUser($id);
        if (! $user) {
            return Response::notFound('User not found');
        }
        
        return $user->comments;
    }

    public function getUserComment($id, $commentId)
    {
        $user = $this->users->getUser($id);
        if (! $user) {
            return Response::notFound('User not found');
        }
        
        return $user->comments()->find($commentId);
    }

    public function getUserPost($id, $postId)
    {
        $user = $this->users->getUser($id);
        if (! $user) {
            return Response::notFound('User not found');
        }
        
        return $user->posts()->find($postId);
    }

    public function createUser()
    {
        $validator = Validator::make($this->request->all(), [
            'username' => 'required|unique:users|max:255',
            'password' => 'required',
            'birthday' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);
        
        if ($validator->errors()->count()) {
            return Response::badRequest($validator->errors());
        }
        
        $user = $this->users->createUser($this->request);
        if ($user) {
            return Response::created($user);
        }
        
        return Response::internalError('Unable to create the user');
    }

    public function deleteUser($id)
    {
        $user = $this->users->find($id);
        if (! $user) {
            return Response::notFound('User not found');
        }
        
        if (! $user->delete()) {
            return Response::internalError('Unable to delete the user');
        }
        
        return Response::deleted();
    }

    public function updateUser($id)
    {
        $user = $this->users->find($id);
        if (! $user) {
            return Response::notFound('User not found');
        }
        
        $validator = Validator::make($this->request->all(), [
            'username' => 'unique:users'
        ]);
        
        if ($validator->errors()->count()) {
            return Response::badRequest($validator->errors());
        }
        
        $user = $this->users->updateUser($id, $this->request->all());
        if ($user) {
            return Response::json($user);
        }
        
        return Response::internalError('Unable to update the user');
    }
}