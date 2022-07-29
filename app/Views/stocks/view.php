
<script type="text/javascript" src="https://unpkg.com/lightweight-charts@1.0.0-rc.3/dist/lightweight-charts.standalone.production.js"></script>

<div id="stock_info">
    <h2><?= $stockinfo['full_stock_name']?></h2>
    <img src="<?=$stockinfo['logo_img_path']?>" />
    <div class="info"><?= $stockinfo['stock_desc']?></div>
    <div class="bonus_log"><?= $stockinfo['log_bonus']?></div>
</div>

<div id="chart"></div>
<table>
    <thead>
        <tr>
            <td>Ngày</td>
            <td>Giá điều chỉnh</td>
            <td>Giá đóng cửa</td>
            <td>Giá bình quân</td>
            <td>Thay đổi (+/-%)</td>
            <td>KL khớp lệnh</td>
            <td>GT khớp lệnh</td>
            <td>GL thỏa thuân</td>
            <td>GT thỏa thuận</td>
            <td>Giá TC</td>
            <td>Giá mở cửa</td>
            <td>Giá cao nhất</td>
            <td>Giá thấp nhất</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data['stocks'] as $stock) : ?>
                <tr>
                    <td><?= $stock['date']?></td>
                    <td><?= $stock['gia_dieu_chinh']?></td>
                    <td><?= $stock['gia_dong_cua']?></td>
                    <td><?= $stock['gia_binh_quan']?></td>
                    <td><?= $stock['thay_doi']?></td>
                    <td><?= $stock['khoi_luong_gd']?></td>
                    <td><?= $stock['gia_tri_gd']?></td>
                    <td><?= $stock['khoi_luong_tt']?></td>
                    <td><?= $stock['gia_tri_tt']?></td>
                    <td><?= $stock['gia_tham_chieu']?></td>
                    <td><?= $stock['gia_mo_cua']?></td>
                    <td><?= $stock['gia_cao_nhat']?></td>
                    <td><?= $stock['gia_thap_nhat']?></td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<?= $data['pager']->links() ?>

<script type="text/javascript">
        var chart = LightweightCharts.createChart(document.getElementById("chart"), {
            width: 1200,
            height: 600
        });
        var lineSeries = chart.addLineSeries();
        lineSeries.setData(<?= $c_data ?>);
        chart.timeScale().fitContent();
    </script>