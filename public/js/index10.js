$(document).ready(function () {
  // tiket
  $("#modal-report").modal("show");

  $('#example').DataTable();

  //Report

  Report = $("#report").DataTable({
    paging: false,
    scrollY: 600,
    scrollX: true,
    dom: "Bfrtip",
    buttons: ["copy", "csv", "excel", "pdf", "print"],
  });


  $("#take").on("click", function () {
    if (confirm("Apakah Yakin Tiket diambil")) {
      var id = [];

      $(":checkbox:checked").each(function (i) {
        id[i] = $(this).val();
      });

      console.log(id);

      if (id.length === 0) {
        //tell you if the array is empty
        alert("Belum Ada yang Terchecklist...");
      } else {
        $.ajax({
          url: "http://localhost:8080/tiket/take",
          method: "POST",
          data: { id: id },
          success: function () {
            alert(" Ticket Berhasil Diambil");
            window.location.href = "";
          },
        });
      }
    } else {
      return false;
    }
  });

  // Tombol-Closed
  $("#closeAction").on("click", function () {
    var id = [];
    const pesan = $("#pesan-close").val();

    $(":checkbox:checked").each(function (i) {
      id[i] = $(this).val();
    });

    console.log(id);
    console.log(pesan);

    if (id.length === 0) {
      //tell you if the array is empty
      alert("Belum Ada yang Terchecklist...");
    } else {
      $.ajax({
        url: "http://localhost:8080/tiket/close",
        method: "POST",
        data: { id: id, pesan: pesan },
        success: function () {
          alert(" Ticket Berhasil Ditutup");
          window.location.href = "";
        },
      });
    }
  });

  // Tombol-Delete
  $("#delete").on("click", function () {
    if (confirm("Apakah yakin tiket dihapus")) {
      var id = [];

      $(":checkbox:checked").each(function (i) {
        id[i] = $(this).val();
      });

      console.log(id);

      if (id.length === 0) {
        //tell you if the array is empty
        alert("Belum Ada yang Terchecklist...");
      } else {
        $.ajax({
          url: "http://localhost:8080/tiket/delete",
          method: "POST",
          data: { id: id },
          success: function () {
            alert(" Ticket Berhasil dihapus");
            window.location.href = "";
          },
        });
      }
    } else {
      return false;
    }
  });

  // Edit data

  $("#tombolCariData").on("click", function () {
    let value = $("#cariData").val();
    $.ajax({
      url: "http://localhost:8080/dataedit",
      type: "post",
      dataType: "json",
      data: { id: value },
      success: function (data) {
        console.log(data);
        $("#noTicket").val(data.tiket_id);
        $("#tag").val(data.case_id);
        $("#priorty").val(data.urgency);
        $("#keteranganTicket").val(data.desc);
        $("#awb").val(data.awb);
        $("#noOrder").val(data.no_order);
        $("#namaPic").val(data.pic_name);
        $("#account").val(data.account);
        $("#origin").val(data.origin);
        $("#regional").val(data.regional);
        $("#namaKota").val(data.city);
        $("#customerName").val(data.customer_name);
        $("#sellerName").val(data.seller_name);
        $("#merchantId").val(data.merchant_id);
        $("#sellerAddress").val(data.seller_address);
        $("#sellerPhone").val(data.seller_phone);
        $("#destinasi").val(data.destinasi);
        $("#service").val(data.service);
        $("#intruksi").val(data.intruksi);
        $("#insValue").val(data.ins_value);
        $("#codFlag").val(data.cod_flag);
        $("#codAmount").val(data.cod_amount);
        $("#armada").val(data.armada);
        $("#modulEntry").val(data.modul_entry);
        $("#keterangan").val(data.desc_good);
        $("#qty").val(data.qty);
        $("#weight").val(data.weight);
      },
    });
  });


  $(".tombol-notif").on("click", function () {
    const id = $(this).data("id");
    const tiket = $(this).data("tiket");

    $.ajax({
      url: "http://localhost:8080/isread/store",
      data: { id: id, tiket: tiket },
      success: function () {
        window.location.href = "http://localhost:8080/tiket/" + tiket;
      },
    });
  });

  $(".table").on("change", "#check-all", function () {
    const status = $(".table .status");
    const box = $(".table .check");

    const boxAll = document.querySelector(".table #check-all");

    if (boxAll.checked == true) {
      for (let i = 0; i < status.length; i++) {
        const element = status[i].innerHTML;
        if (element !== "CLOSE") {
          box[i].checked = true;
        }
      }
    } else {
      for (let i = 0; i < status.length; i++) {
        box[i].checked = false;
      }
    }
  });
});
