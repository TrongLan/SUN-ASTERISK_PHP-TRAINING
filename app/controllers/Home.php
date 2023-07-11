<?php

class Home extends Controller
{
    public function index()
    {
        $this->loadModel("User");
        $user = new User();
        $this->loadView("user_info", ["username" => $user->getUserName()]);
    }

}
