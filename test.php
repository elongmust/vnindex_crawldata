<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function myTest() {
static $x = 0;
echo $x;
$x++;
}myTest();
myTest();
myTest();

/**
 * We just want to hash our password using the current DEFAULT algorithm.
 * This is presently BCRYPT, and will produce a 60 character result.
 *
 * Beware that DEFAULT may change over time, so you would want to prepare
 * By allowing your storage to expand past 60 characters (255 would be good)
 */
// echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
die();


// $time = "15/01/2022";
// $tmp = explode('/', $time);
// $timestamp = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
// $d = date('Y-m-d H:i:s', strtotime($timestamp));
// // die(var_dump($d));


// function getStockValueFromDivString($str) {
//     $str = preg_replace("/<\/?td[^>]*\><\/?span[^>]*\>/i", "", $str);
//     $str = str_replace('&nbsp;', '', $str);

//     return $str;
// }


// $str = '<td class="Item_ChangePrice"><span class="Index_Up">1.40 (2.57 %)</span></td>';
// $str2 = '<td class="Item_ChangePrice">1.40 (2.57 %)</td>';
// $str3 = '<span class="Index_Up">1.40 (2.57 %)</span>';
// $htmlstr =  getStockValueFromDivString($str2);
// echo html_entity_decode($htmlstr, ENT_NOQUOTES, 'UTF-8');

require('./simple_html_dom.php');
require('./function.php');

function updateInfomation($exchange_name, $stock_name) {
    $exchange_name  = strtolower($exchange_name);
    $stock_name = strtolower($stock_name);
    $link = 'https://s.cafef.vn/'.$exchange_name.'/'.$stock_name.'-xxx.chn';
    $header = [];
    $contents = get($link, $header);

    $dom = new simple_html_dom(null, true, true, 'UTF-8', true, '\r\n', ' ');
    $data = $dom->load($contents, true, true);
    
    $full_stock_name = preg_replace("/(<([^>]+)>)/i", "", $data->find('#namebox', 0));
    $stock_desc = $data->find('.logo_intro .companyIntro', 0)->innertext;
    $logo_img_path = $data->find('.avartar img', 0)->src;
    $log_bonus = $data->find('.dltl-other .tt .tooltip .middle', 0)->innertext;
    die(var_dump($log_bonus));

    $update_data = [
        'full_stock_name' => $full_stock_name,
        'stock_desc' => $stock_desc,
        'logo_img_path' => $logo_img_path
    ];

    die(var_dump($stock_desc));


}

updateInfomation('hose', 'hhv');


function getDataHoseStocks($sLink = '', $stock)
{
    $header = array(
        'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
        'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36'
    );

    $body = [
        'ctl00$ContentPlaceHolder1$scriptmanager' => 'ctl00$ContentPlaceHolder1$ctl03$panelAjax|ctl00$ContentPlaceHolder1$ctl03$pager2',
        'ctl00$ContentPlaceHolder1$ctl03$txtKeyword' => $stock,
        '__EVENTTARGET' => 'ctl00$ContentPlaceHolder1$ctl03$pager2',

    ];
    $dom = new simple_html_dom(null, true, true, 'UTF-8', true, '\r\n', ' ');
    $current_page = 1;
    $isOk = 1;
    do {
        $body['__EVENTARGUMENT'] = $current_page;
        $contents = post($sLink, $body, $header);
        $data = $dom->load($contents, true, true);


        foreach ($data->find('table#GirdTable2 tr[id]') as $element) {
            echo $element . '<br/>';
        }

        $isOk = $data->find('tr#ctl00_ContentPlaceHolder1_ctl03_rptData2_ctl01_itemTR');
        $current_page++;
    } while (sizeof($isOk));
}

function getDataHnxStocks($sLink = '', $stock)
{

    $header = array(
        'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
        'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36'
    );

    $body = [
        'ctl00$ContentPlaceHolder1$scriptmanager' => 'ctl00$ContentPlaceHolder1$ctl03$panelAjax|ctl00$ContentPlaceHolder1$ctl03$pager2',
        'ctl00$ContentPlaceHolder1$ctl03$txtKeyword' => $stock,
        '__EVENTTARGET' => 'ctl00$ContentPlaceHolder1$ctl03$pager2',

    ];
    $dom = new simple_html_dom(null, true, true, 'UTF-8', true, '\r\n', ' ');
    $current_page = 1;
    $isOk = 1;
    do {
        $body['__EVENTARGUMENT'] = $current_page;
        $contents = post($sLink, $body, $header);
        $data = $dom->load($contents, true, true);


        foreach ($data->find('table#GirdTable tr[id]') as $element) {
            echo $element . '<br/>';
        }

        $isOk = $data->find('tr#ctl00_ContentPlaceHolder1_ctl03_rptData_ctl01_itemTR');
        $current_page++;
    } while (sizeof($isOk));

}

function getDataUpcomStocks($sLink = '', $stock)
{
    $header = array(
        'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
        'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36'
    );

    $body = [
        'ctl00$ContentPlaceHolder1$scriptmanager' => 'ctl00$ContentPlaceHolder1$ctl03$panelAjax|ctl00$ContentPlaceHolder1$ctl03$pager2',
        'ctl00$ContentPlaceHolder1$ctl03$txtKeyword' => $stock,
        '__EVENTTARGET' => 'ctl00$ContentPlaceHolder1$ctl03$pager2',

    ];
    $dom = new simple_html_dom(null, true, true, 'UTF-8', true, '\r\n', ' ');
    $current_page = 1;
    $isOk = 1;
    do {
        $body['__EVENTARGUMENT'] = $current_page;
        $contents = post($sLink, $body, $header);
        $data = $dom->load($contents, true, true);


        foreach ($data->find('table#GirdTable tr[id]') as $element) {
            echo $element . '<br/>';
        }

        $isOk = $data->find('tr#ctl00_ContentPlaceHolder1_ctl03_rptData_ctl01_itemTR');
        $current_page++;
    } while (sizeof($isOk));
}



$sLink = 'https://s.cafef.vn/Lich-su-giao-dich-AAA-1.chn';
getDataHnxStocks($sLink, 'KHS');
// getDataHoseStocks($sLink, 'VNM');
// getDataUpcomStocks($sLink, 'VTP');







// $body = [
//     'ctl00$ContentPlaceHolder1$scriptmanager' => 'ctl00$ContentPlaceHolder1$ctl03$panelAjax|ctl00$ContentPlaceHolder1$ctl03$pager2',
//     'ctl00$ContentPlaceHolder1$ctl03$txtKeyword' => 'VNM',
//     '__EVENTTARGET' => 'ctl00$ContentPlaceHolder1$ctl03$pager2',

// ];
// $header = array(
//     'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
//     'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36'
// );

// $dom = new simple_html_dom(null, true, true, 'UTF-8', true, '\r\n', ' ');

// $current_page = 1;
// $isOk = 1;
// do {
//     $body['__EVENTARGUMENT'] = $current_page;
//     $contents = post($sLink, $body, $header);
//     $data = $dom->load($contents, true, true);


//     foreach ($data->find('table#GirdTable tr[id]') as $element) {
//         echo $element . '<br/>';
//     }

//     $isOk = $data->find('tr#ctl00_ContentPlaceHolder1_ctl03_rptData2_ctl01_itemTR');
//     $current_page++;
// } while (sizeof($isOk));


// $contents = post($sLink, $data, $header);
// $html = $dom->load($contents, true, true);
// $a = $html->find('table.CafeF_Paging tr a');
// $tmp_total_page = sizeof($a);

// if

// foreach($html->find('table#GirdTable tr[id]') as $element) {
//     echo $element.'<br>';
// }
// die();
// // die(var_dump($html));


// $html = file_get_html($sLink, false, null, 0);
// foreach ($html->find('img') as $element) {
//     echo '<img src="' . $element->src . '" /><br>';
// }
