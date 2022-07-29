<?php

namespace App\Controllers;

use App\Models\UserModel;


class User extends BaseController
{


    public function login()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() === 'post') {

            $rules = [
                'username' => 'required|min_length[3]',
                'password' => 'required|min_length[8]|max_length[255]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $userModel = new UserModel();
                $user = $userModel->where('username', $this->request->getVar('username'))->first();
                if ($user && password_verify($this->request->getVar('password'), $user['password'])) {
                    $this->setUserSession($user);
                    return redirect()->to('/stocks');
                }
            }
        }

        echo view('layout/header', ['title' => 'Login'])
            . view('user/login')
            . view('layout/footer');
    }

    public function signup()
    {
        $data = [];
        helper(['form']);

        $userModel = model(UserModel::class);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
                'password' => 'required|min_length[6]|max_length[255]',
                'email_phone' => 'required|is_unique[users.username]',
                'full_name' => 'required|min_length[8]|max_length[20]',
                'password_confirm' => 'matches[password]'
            ];


            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $password = password_hash($this->request->getPost('password'),  PASSWORD_DEFAULT, array('cost' => 9));
                $userModel->save([
                    'username' => $this->request->getPost('username'),
                    'password' => $password,  // md5(salt*md5(pass))
                    'email_phone' => $this->request->getPost('email_phone'),
                    'full_name' => $this->request->getPost('full_name')
                ]);
                return redirect()->to('/login');
            }
        }

        echo view('layout/header', ['title' => 'Signup'])
            . view('user/sigup', $data)
            . view('layout/footer');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
            'email_phone' => $user['email_phone'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }
}
