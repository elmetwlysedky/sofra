<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use voku\helper\ASCII;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository,)
    {
        $this->userRepository=$userRepository;
    }

    public function index()
    {
        return view('Dashboard.User.index',[
            'users'=> $this->userRepository->all()
        ]);
    }

    public function create()
    {
        return view('Dashboard.User.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] =Hash::make($data['password']);

        $this->userRepository->store($data);

        session()->flash('success', __('main.added_success'));
        return to_route('user.index');

    }



    public function update(UserRequest $request , $id)
    {
        $data = $request->validated();
//        dd($data['password']);
        if ($data['password']) {
             Hash::make($data['password']);
        }
        $this->userRepository->update($data , $id);

        session()->flash('success', __('main.edited_success'));
        return to_route('user.index');
    }
}
