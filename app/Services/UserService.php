<?php


namespace App\Services;


use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserService extends BaseService
{
    public function __construct(UserRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function store($request)
    {
        $input = $request->validated();

        $input['password'] = bcrypt($input['password']);
        
        $user = $this->repository->create($input);

        $user['token'] = $user->createToken('MyApp')->plainTextToken;

        return $user;
    }

    public function login($request)
    {
        $input = $request->validated();

        if(Auth::attempt(['email' => $input['email'], 'password' => $input['password']])){ 
            
            $user = Auth::user(); 

            $user['token'] = $user->createToken('MyApp')->plainTextToken;
   
            return $user;
        } 

        throw new Exception;
    }
}
