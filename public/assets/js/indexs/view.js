function crawlData($index_name) {
    var csrfName = $("#csrf_token").text();
    var csrfHash = $("#csrf_hash").text(); 

    var dataJson = { 
        [csrfName]: csrfHash, // adding csrf here
        index_name: $index_name 
      };
    $.ajax({
        url: 'http://localhost:8080/idx-crawl/',
        type: 'post',
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        data: dataJson, //lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
        datatype: 'json', // định dạng dữ liệu trả về là json
        success: function (data) { //kết quả trả về từ server nếu gửi thành công
            alert(data);
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