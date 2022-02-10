<?php

namespace App\Service\User;

use App\Http\Requests\User\UserRequest;
use App\Manager\User\UserManager;
use Illuminate\Http\Request;

class UserService
{
    private $userManager;
    public function __construct(UserManager $userManager)
    {
        $this->userManager=$userManager;
    }
    public function index()
    {
        return $this->userManager->index();
    }

    public function create(){
        return $this->userManager->create();
    }

    public function store(UserRequest $request){
        return $this->userManager->store($request);
    }

    public function show($id){
        return $this->userManager->show($id);
    }

    public function edit($id){
        return $this->userManager->edit($id);
    }

    public function update(UserRequest $request, $id){
        return $this->userManager->update($request, $id);
    }

    public function changepassword(UserRequest $request, $id){
        return $this->userManager->changepassword($id,$request);
    }

    public function destroy($id){
        return $this->userManager->destroy($id);
    }
}
