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
        $all_stocks = $model->getStockandData();
       
        setBreadcrumb([
            'stocks' => 'Stocks'
        ]);
        loadCss(['stocks/index.css']);
        loadJs(['stocks/index.js']);

        return view('stocks/index', ['data' => $all_stocks]);
    }

    public function exchange()
    {
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

    public function add()
    {
        if ($this->request->getMethod() == 'post' && $this->validate([
            'exchange_name' => 'required',
            'name' => 'required'
        ])) {
            $stockModel = new StocksModel;
            $stockModel->addStock($this->request->getPost('exchange_name'), strtoupper($this->request->getPost('name')));
            // $stockModel->save([
            //     'name' => strtoupper($this->request->getPost('name')),
            //     'exchange_name' => $this->request->getPost('exchange_name')
            // ]);

            // $stockModel->updateInfomation($this->request->getPost('exchange_name'), strtoupper($this->request->getPost('name')));
        }

        $model = model(ExchangeModel::class);
        $exchange = $model->getAllExchanges();
        setTitle('Add new Stock');
        setBreadcrumb([
            'stocks' => 'Stocks',
            'stocks/add' => 'Add new Stock'
        ]);

        return view('stocks/add', ['exchange' => $exchange]);
    }

    public function crawl()
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getVar();
            $stock_id = $data['stock_id'];
            $stockModel = model(StocksModel::class);
            $stock = $stockModel->where('name', $stock_id)->first();
            if (!$stock) {
                redirect('stocks');
            }

            $stockDataModel = model(StocksDataModel::class);
            $stockDataModel->crawlStockData($stock_id, $stock['exchange_name']);
            return json_encode('done');
        }
    }

    public function view($slug)
    {
        $stockModel = model(StocksModel::class, false);
        $stock = $stockModel->where('name', $slug)->first();

        $stockDataModel = model(StocksDataModel::class, false);
        $chart_data = $stockDataModel->where('stock_name', $slug)->findAll();
        $datas = [];
        $key = 'gia_tham_chieu';
        if ($stock['exchange_name'] == 'HOSE') {
            $key = 'gia_mo_cua';
        }
        foreach ($chart_data as $data) {
            $tmp = array('time' => $data['date'], 'value' => $data[$key]);
            $datas[] = $tmp;
        }

        // die(var_dump(json_encode($datas)));
        $data = [
            'stocks' => $stockDataModel->where('stock_name', $slug)->paginate(15),
            'pager' => $stockDataModel->pager,
        ];
        setBreadcrumb([
            'stocks' => 'Stocks',
            '#' => $slug
        ]);
        setTitle($stock['name'].':'.$stock['full_stock_name'] .'| Tin tức và Dữ Liệu');
        loadCss(['stocks/view.css']);
        loadJs(['stocks/view.js']);
        return view('stocks/view', ['data' => $data, 'stockinfo' => $stock, 'c_data' => json_encode($datas)]);
    }
}
