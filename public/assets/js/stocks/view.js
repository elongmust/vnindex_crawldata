
function crawlData($stock_id) {
    $("#loading").show();
    var csrfName = $("#csrf_token").text();
    var csrfHash = $("#csrf_hash").text(); 

    var dataJson = { 
        [csrfName]: csrfHash, // adding csrf here
        stock_id: $stock_id 
      };
    $.ajax({
        url: 'http://localhost:8080/crawl/',
        type: 'post',
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        data: dataJson, //lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
        datatype: 'json', // định dạng dữ liệu trả về là json
        success: function (data) { //kết quả trả về từ server nếu gửi thành công
            location.reload();
        }, error: function (e) {
            var array = Object.keys(e)
                .map(function(key) {
                    return obj[key];
                });
            alert(array);
        }
    });
}