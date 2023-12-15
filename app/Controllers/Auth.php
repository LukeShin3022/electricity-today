<?php

namespace App\Controllers;

use App\Libraried\Hash;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $data['title'] = "LoginForm";
        // return view('form/index', $data);
            //    return view('login');
               return redirect()->to('login');

    }

    public function check()
    {
        $validation = $this->validate([
            'email' => [
                // 'rules' => 'required|valid_email|is_not_unique[user_usr.email_usr]',
                'rules' => 'required|valid_email',
                
                'errors' => [
                    'required' => "Email Field Required",
                    'valid_email' => "Not a valid email",
                    'is_not_unique' => "Email not registered",
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Password Field Required"
                ]
            ],
        ]);
        if (!$validation) {
            // return view('login', ['validation' => $this->validator]);
            return redirect()->to('login');
        } else {

            // $email = $this->request->getPost('email');
            $email = '1234@a.com';
            // $password = $this->request->getPost('password');
            $password = '1234';            
            // $userModel = new UserModel();
            // $userInfo = $userModel->where('email_usr', $email)->first();
            $userInfo = [
                "id_usr" => $email,
                "firstname_usr"=>"Luke",
                "lastname_usr"=>"Shin",
                "password_usr" => $password,
            ];            
            // $checkPassword = Hash::check($password, $userInfo['password_usr']);
            // $checkPassword = '1234';
            $checkPassword = $userInfo['password_usr'];

            if (!$checkPassword) {
                session()->setFlashdata('fail', 'Incorrect password');
                return redirect()->to('auth')->withInput();
            } else {
                $loggedUserId = $userInfo['id_usr'];
                $loggedUserFullName = $userInfo['firstname_usr'] . ' ' . $userInfo['lastname_usr'];

                session()->set('loggedUserId', $loggedUserId);
                session()->set('loggedUserFullName', $loggedUserFullName);

                session()->setFlashdata('success', 'Login success');
                return redirect()->to('/')->withInput();
            }
        }
    }
    public function logout()
    {
        if (session()->has('loggedUserId')) {
            session()->remove('loggedUserId');
            return redirect()->to('login')->with('fail', "You are logged out.");
        }
    }
}
