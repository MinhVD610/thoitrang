$(document).ready(function () {
  let IDCategory = 0;
  apiListBill();

  //tìm kiếm
  $(".events_search").keyup(function () {
    apiListBill(IDCategory);
  });

  function apiListBill(IDCategory) {
    let keyword = $(".events_search").val();
    
    $.post("./Histories/apiListBill", { keyword: keyword, IDCategory:IDCategory }, function (data) {
      let obj = JSON.parse(data);
      let result = "";
      obj.forEach((element) => {
        result += "<tr>" + "<td>" + element.ID + "</td>" + "<td>" + element.hoTen + "</td>" + "<td>" + element.tenSP + "</td>" + "<td class='events-description'>" + element.soLuong + "</td>" + "<td>" + changedPrice(element.total - 0) + "</td>" + "<td>" + element.ngayBan + "</td>" + "<td class='card-customer__item--action'>" + "<i class='fa-solid fa-trash event--delete' data-idbills='" + element.ID + "'></i>" + "</td>" + "</tr>";
      });

      $(".list-bills").html(result);

      $(".event--delete").click(function () {
        let ID = $(this).attr("data-idbills");

        $.post("./Histories/removeBill", { ID: ID }, function () {
          apiListBill();
        });
      });
    });
  }

  //load categories product
  categories();
  function categories(){
    $.post("../SanPham/getCategories", function (data) {

      var obj = JSON.parse(data);

      var html = `<option value='0'>Tất cả</option>`;
      
      obj.forEach(p => {
        html += `<option value=`+p.ID+`>`+p.tenTL+`</option>`;
      })

      $('.categories__product').html(html);
    })
  }

  $('.categories__product').change(function(){
    IDCategory = $(this).val();
    console.log(IDCategory);
    apiListBill(IDCategory);
  })

  //export data renevue to excel
  $('.export--revenue').click(function() {
    $.post("./Histories/apiListBill", { keyword: null }, function (data) {
      let table = document.getElementsByTagName("table");
      TableToExcel.convert(table[0], {
          name: `ReportRenevue.xlsx`,
          sheet: {
              name: 'Renevue'
          }
      });
    });
  })

  //định giá tiền VNĐ
  function changedPrice(price) {
    var priceChanged = price.toLocaleString("vi-VN", {
      style: "currency",
      currency: "VND",
    });

    return priceChanged;
  }
});
