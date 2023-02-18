<?php

namespace App\Models;

use CodeIgniter\Model;

require_once('simple_html_dom.php');
require_once('function.php');

use simple_dom\simple_html_dom;


class IndexsDataModel extends Model
{
    protected $table = 'stocks_indexs_data';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'date', 'price', 'open',
        'hight', 'low', 'value', 'changed'
    ];

    public function crawlIndexData($index_name)
    {
        $sGlobalLink = 'https://www.investing.com/indices/us-30-historical-data';
    }

}