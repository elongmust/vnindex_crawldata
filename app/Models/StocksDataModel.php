<?php

namespace App\Models;

use CodeIgniter\Model;
require_once('simple_html_dom.php');
require_once('function.php');
use simple_dom\simple_html_dom;


class StocksDataModel extends Model {
    protected $table = 'stocks_data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['stock_name','date','gia_dieu_chinh', 'gia_dong_cua',
     'gia_binh_quan', 'thay_doi', 'khoi_luong_gd', 'gia_tri_gd',
    'khoi_luong_tt', 'gia_tri_tt', 'gia_tham_chieu', 'gia_mo_cua', 'gia_cao_nhat', 'gia_thap_nhat'];

    public function crawlStockData($stock_name, $exchange_name = 'HOSE')
    {
        $sLink = 'https://s.cafef.vn/Lich-su-giao-dich-AAA-1.chn';
        $header = array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36'
        );

        $body = [
            'ctl00$ContentPlaceHolder1$scriptmanager' => 'ctl00$ContentPlaceHolder1$ctl03$panelAjax|ctl00$ContentPlaceHolder1$ctl03$pager2',
            'ctl00$ContentPlaceHolder1$ctl03$txtKeyword' => $stock_name,
            '__EVENTTARGET' => 'ctl00$ContentPlaceHolder1$ctl03$pager2',
        ];

        $dom = new simple_html_dom(null, true, true, 'UTF-8', true, '\r\n', ' ');
        $current_page = 1;
        $isOk = 1;
        // $data = [];

        do {
            $body['__EVENTARGUMENT'] = $current_page;
            $contents = post($sLink, $body, $header);
            $data = $dom->load($contents, true, true);


            if ($exchange_name == 'HOSE') {
                $div = 'table#GirdTable2 tr[id]';
                $page_div = 'tr#ctl00_ContentPlaceHolder1_ctl03_rptData2_ctl01_itemTR';
            } else {
                $div = 'table#GirdTable tr[id]';
                $page_div = 'tr#ctl00_ContentPlaceHolder1_ctl03_rptData_ctl01_itemTR';
            }

            foreach ($data->find($div) as $element) {
                $tmp_date = getStockValueFromDivString($element->childNodes(0)->__toString());
                $tmp = explode('/', $tmp_date);
                $timestamp = $tmp[2] . '-' . $tmp[1] . '-' . $tmp[0];
                $ck_date =  date("Y-m-d", strtotime($timestamp));
                if ($exchange_name == 'UPCOM') {
                    $insert_data = [
                        'stock_name' => $stock_name,
                        'date' => $ck_date,
                        'gia_dieu_chinh' => getStockValueFromDivString($element->childNodes(1)->__toString()),
                        'gia_dong_cua' => getStockValueFromDivString($element->childNodes(2)->__toString()),
                        'gia_binh_quan' => getStockValueFromDivString($element->childNodes(3)->__toString()),
                        'thay_doi' => preg_replace("/(<([^>]+)>)/i", "", $element->childNodes(4)->__toString()),
                        'khoi_luong_gd' => getStockValueFromDivString($element->childNodes(6)->__toString()),
                        'gia_tri_gd' => getStockValueFromDivString($element->childNodes(7)->__toString()),
                        'khoi_luong_tt' => getStockValueFromDivString($element->childNodes(8)->__toString()),
                        'gia_tri_tt' => getStockValueFromDivString($element->childNodes(9)->__toString()),
                        'gia_tham_chieu' => getStockValueFromDivString($element->childNodes(10)->__toString()),
                        'gia_mo_cua' => getStockValueFromDivString($element->childNodes(11)->__toString()),
                        'gia_cao_nhat' => getStockValueFromDivString($element->childNodes(12)->__toString()),
                        'gia_thap_nhat' => getStockValueFromDivString($element->childNodes(13)->__toString()),
                    ];
                } elseif ($exchange_name == 'HNX') {
                    $insert_data = [
                        'stock_name' => $stock_name,
                        'date' => $ck_date,
                        'gia_dieu_chinh' => getStockValueFromDivString($element->childNodes(1)->__toString()),
                        'gia_dong_cua' => getStockValueFromDivString($element->childNodes(2)->__toString()),
                        'gia_binh_quan' => 0,
                        'thay_doi' =>  preg_replace("/(<([^>]+)>)/i", "", $element->childNodes(3)->__toString()),
                        'khoi_luong_gd' => getStockValueFromDivString($element->childNodes(5)->__toString()),
                        'gia_tri_gd' => getStockValueFromDivString($element->childNodes(6)->__toString()),
                        'khoi_luong_tt' => getStockValueFromDivString($element->childNodes(7)->__toString()),
                        'gia_tri_tt' => getStockValueFromDivString($element->childNodes(8)->__toString()),
                        'gia_tham_chieu' => getStockValueFromDivString($element->childNodes(9)->__toString()),
                        'gia_mo_cua' => getStockValueFromDivString($element->childNodes(10)->__toString()),
                        'gia_cao_nhat' => getStockValueFromDivString($element->childNodes(11)->__toString()),
                        'gia_thap_nhat' => getStockValueFromDivString($element->childNodes(12)->__toString()),
                    ];
                } elseif ($exchange_name == 'HOSE') {
                    $insert_data = [
                        'stock_name' => $stock_name,
                        'date' => $ck_date,
                        'gia_dieu_chinh' => getStockValueFromDivString($element->childNodes(1)->__toString()),
                        'gia_dong_cua' => getStockValueFromDivString($element->childNodes(2)->__toString()),
                        'gia_binh_quan' => 0,
                        'thay_doi' =>  preg_replace("/(<([^>]+)>)/i", "", $element->childNodes(3)->__toString()),
                        'khoi_luong_gd' => getStockValueFromDivString($element->childNodes(5)->__toString()),
                        'gia_tri_gd' => getStockValueFromDivString($element->childNodes(6)->__toString()),
                        'khoi_luong_tt' => getStockValueFromDivString($element->childNodes(7)->__toString()),
                        'gia_tri_tt' => getStockValueFromDivString($element->childNodes(8)->__toString()),
                        'gia_tham_chieu' => 0,
                        'gia_mo_cua' => getStockValueFromDivString($element->childNodes(9)->__toString()),
                        'gia_cao_nhat' => getStockValueFromDivString($element->childNodes(10)->__toString()),
                        'gia_thap_nhat' => getStockValueFromDivString($element->childNodes(11)->__toString()),
                    ];
                }
                
            // $stockDataModel = model(StocksDataModel::class);
                $this->save($insert_data);

                if (isset($ck_date)) { // update last crawl 

                }

                // echo $element . '<br/>';
            }

            $isOk = $data->find($page_div);
            $current_page++;
        } while (sizeof($isOk));
        // return $data;
    }

}
