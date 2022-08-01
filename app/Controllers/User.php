<?php

namespace App\Controllers;

use App\Models\UserModel;


class User extends BaseController
{

    public function test()
    {

        $data = [
            'blog_title'   => 'My Blog Title',
            'blog_heading' => 'My Blog Heading',
            'blog_entries' => [
                ['title' => 'Title 1', 'body' => 'Body 1'],
                ['title' => 'Title 2', 'body' => 'Body 2'],
                ['title' => 'Title 3', 'body' => 'Body 3'],
                ['title' => 'Title 4', 'body' => 'Body 4'],
                ['title' => 'Title 5', 'body' => 'Body 5'],
            ],
        ];

        // echo viewTesting('sex');
        // return $parser->setData($data)->render('blog_template');
        // useTemplate('blank_template');
        setTitle('User testing page');
        setMeta([
            'name="keywords" content="testing"',
            'property="og:title" content="propertype"',
            'name="description" content="user test page description"'
        ]);
        
        loadCss(['user/test.css', 'b.css']);
        loadJs(['a.js', 'b.js']);
        return view('test'); // someview in default_template
    }

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
        return view('user/login');
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

        return view('user/sigup', $data);
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

    public function view($slug){
        useTemplate('profile_template');
        return view('user/profile');
    }
}
