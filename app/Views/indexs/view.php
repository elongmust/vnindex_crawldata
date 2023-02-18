<div class="st_log">
        <span class="txt_dt"> Dữ Liệu Lịch Sử </span>
        <a href="#" class="btn btn-success" onclick="crawlData('<?= esc($data['name']) ?>');">Crawl Data</a>
    </div>


<div style="display: none;">
    <div id="csrf_token"><?= csrf_token() ?></div>
    <div id="csrf_hash"><?= csrf_hash() ?></div>
</div>