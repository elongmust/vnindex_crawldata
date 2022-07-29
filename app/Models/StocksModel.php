<?php

namespace App\Models;

use CodeIgniter\Model;
// use Sunra\PhpSimple\HtmlDomParser;
// use simplehtmldom_1_5\simple_html_dom;

require_once('simple_html_dom.php');
require_once('function.php');
use simple_dom\simple_html_dom;


class StocksModel extends Model
{
    

    protected $table = 'stocks';
    // protected $primaryKey = 'name';
    protected $allowedFields = ['name', 'exchange_name', 'full_stock_name', 'exchange_name', 'stock_desc', 'log_bonus', 'last_crawl', 'logo_img_path'];

    

    public function addStock($exchange_name, $stock_name)
    {
        // $exchange_name  = strtolower($exchange_name);
        // $stock_name = strtolower($stock_name);
        $link = 'https://s.cafef.vn/' . $exchange_name . '/' . $stock_name . '-xxx.chn';
        $header = [];
        $contents = get($link, $header);

        $dom = new simple_html_dom(null, true, true, 'UTF-8', true, '\r\n', ' ');
        $data = $dom->load($contents, true, true);

        $full_stock_name = preg_replace("/(<([^>]+)>)/i", "", $data->find('#namebox', 0));
        $stock_desc = $data->find('.companyIntro', 0)->innertext;
        $logo_img_path = $data->find('.avartar img', 0)->src;
        $log_bonus = $data->find('.dltl-other .view-more-btn .tooltip .middle', 0)->innertext;

        $update_data = [
            'name' => $stock_name,
            'exchange_name' => $exchange_name,
            'full_stock_name' => $full_stock_name,
            'stock_desc' => $stock_desc,
            'logo_img_path' => $logo_img_path,
            'log_bonus' => $log_bonus
        ];

        $this->save($update_data);
    }
}
