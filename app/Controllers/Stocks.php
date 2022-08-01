<?php

namespace App\Controllers;

use App\Models\ExchangeModel;
use App\Models\StocksDataModel;
use App\Models\StocksModel;



class Stocks extends BaseController
{

    public function index()
    {
        $model = model(StocksModel::class);
        $all_stocks = $model->findAll();
        return view('stocks/index', ['stocks' => $all_stocks]);
        return view('layout/header', ['title' => 'List Stocks'])
            . view('stocks/index', ['stocks' => $all_stocks])
            . view('layout/footer');
    }

    public function exchange(){
        $model = model(ExchangeModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate(([
            'name' => 'required'
        ]))) {
            $model->save([
                'name' => $this->request->getPost('name'),
            ]);
        }

        $exchange = $model->getAllExchanges();
        return view('stocks/exchange', ['exchange' => $exchange]);

        return view('layout/header', ['title' => 'add new exchanges'])
        . view('stocks/exchange', ['exchange' => $exchange])
        . view('layout/footer');

    }

    public function add(){
        if($this->request->getMethod() == 'post' && $this->validate([
            'exchange_name' => 'required',
            'name' => 'required'
        ])) {
            $stockModel = model(StocksModel::class);
            $stockModel->addStock($this->request->getPost('exchange_name'), strtoupper($this->request->getPost('name')));
            // $stockModel->save([
            //     'name' => strtoupper($this->request->getPost('name')),
            //     'exchange_name' => $this->request->getPost('exchange_name')
            // ]);

            // $stockModel->updateInfomation($this->request->getPost('exchange_name'), strtoupper($this->request->getPost('name')));
        }

        $model = model(ExchangeModel::class);
        $exchange = $model->getAllExchanges();

        return view('stocks/add', ['exchange' => $exchange]);

        return view('layout/header', ['title' => 'add new stocks'])
        . view('stocks/add', ['exchange' => $exchange])
        . view('layout/footer');
    }

    public function crawl($slug = null){
        // $this->load->helper('url'); 
        $stockModel = model(StocksModel::class);
        $stock = $stockModel->where('name', $slug)->first();
        if(!$stock) {
            redirect('stocks');
        }
        
        $stockDataModel = model(StocksDataModel::class);
        $stockDataModel->crawlStockData($slug, $stock['exchange_name']);
        redirect('stocks');
    }

    public function view($slug)
    {
        $stockModel = model(StocksModel::class, false);
        $stock = $stockModel->where('name', $slug)->first();

        $stockDataModel = model(StocksDataModel::class, false);
        $chart_data = $stockDataModel->where('stock_name', $slug)->findAll();
        $datas = [];
        $key = 'gia_tham_chieu';
        if($stock['exchange_name'] == 'HOSE') {
            $key = 'gia_mo_cua';
        }
        foreach($chart_data as $data) {
            $tmp = array('time' => $data['date'], 'value' => $data[$key]);
            $datas[] = $tmp;
        }
        
        // die(var_dump(json_encode($datas)));
        $data = [
            'stocks' => $stockDataModel->where('stock_name', $slug)->paginate(20),
            'pager' => $stockDataModel->pager,
        ];

        return view('stocks/view', ['data' => $data, 'stockinfo' => $stock, 'c_data' => json_encode($datas)]);

        return view('layout/header', ['title' => $slug.' : Dữ liệu giao dịch hàng ngày '])
            . view('stocks/view', ['data' => $data, 'stockinfo' => $stock, 'c_data' => json_encode($datas)])
            . view('layout/footer');
    }
}
