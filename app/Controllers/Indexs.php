<?php

namespace App\Controllers;

use App\Models\IndexsDataModel;
use App\Models\IndexsModel;



class Indexs extends BaseController
{

    public function index()
    {
        $model = model(IndexsModel::class);
        $indexs = $model->getAllIndexs();
        return view('indexs/index', ['indexs' => $indexs]);
    }


    public function view($name)
    {
        $idxModel = model(IndexsModel::class, false);
        $indexs = $idxModel->where('name', $name)->first();
        loadJs(['indexs/view.js']); 
        return view('indexs/view', ['data' => $indexs]);
    }

    public function add()
    {
        $model = model(IndexsModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate(([
            'name' => 'required',
            'title' => 'required'
        ]))) {
            $model->save([
                'name' => $this->request->getPost('name'),
                'title' => $this->request->getPost('title'),
            ]);
        }

        $indexs = $model->getAllIndexs();
        return view('indexs/add', ['indexs' => $indexs]);
    }

    public function crawl()
    {

        if ($this->request->isAJAX()) {
            $data = $this->request->getVar();
            $index_name = $data['index_name'];
            $model = model(IndexsModel::class);
            $index = $model->where('name', $index_name)->first();
            if (!$index) {
                redirect('indexs');
            }

            $indexDataModel = model(IndexsDataModel::class);
            $indexDataModel->crawlIndexData($index_name);
            return json_encode('done');
        }
        return false;
    }


}