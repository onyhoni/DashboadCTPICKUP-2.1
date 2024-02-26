$(document).ready(function () {
    // tiket
    $('#modal-report').modal('show');

    $('#example').DataTable();

    //Report

    Report = $('#report').DataTable({
        paging: true,
        pageLength: 15, // Set the number of rows per page to 100
        scrollY: 600,
        scrollX: true,
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
    });

    $('#take').on('click', function () {
        if (confirm('Apakah Yakin Tiket diambil')) {
            var id = [];

            $(':checkbox:checked').each(function (i) {
                id[i] = $(this).val();
            });

            console.log(id);

            if (id.length === 0) {
                //tell you if the array is empty
                alert('Belum Ada yang Terchecklist...');
            } else {
                $.ajax({
                    url: 'http://localhost:8080/tiket/take',
                    method: 'POST',
                    data: { id: id },
                    success: function () {
                        alert(' Ticket Berhasil Diambil');
                        window.location.href = '';
                    },
                });
            }
        } else {
            return false;
        }
    });

    // Tombol-Closed
    $('#closeAction').on('click', function () {
        var id = [];
        const pesan = $('#pesan-close').val();

        $(':checkbox:checked').each(function (i) {
            id[i] = $(this).val();
        });

        console.log(id);
        console.log(pesan);

        if (id.length === 0) {
            //tell you if the array is empty
            alert('Belum Ada yang Terchecklist...');
        } else {
            $.ajax({
                url: 'http://localhost:8080/tiket/close',
                method: 'POST',
                data: { id: id, pesan: pesan },
                success: function () {
                    alert(' Ticket Berhasil Ditutup');
                    window.location.href = '';
                },
            });
        }
    });

    // Tombol-Delete
    $('#delete').on('click', function () {
        if (confirm('Apakah yakin tiket dihapus')) {
            var id = [];

            $(':checkbox:checked').each(function (i) {
                id[i] = $(this).val();
            });

            console.log(id);

            if (id.length === 0) {
                //tell you if the array is empty
                alert('Belum Ada yang Terchecklist...');
            } else {
                $.ajax({
                    url: 'http://localhost:8080/tiket/delete',
                    method: 'POST',
                    data: { id: id },
                    success: function () {
                        alert(' Ticket Berhasil dihapus');
                        window.location.href = '';
                    },
                });
            }
        } else {
            return false;
        }
    });

    // Edit data

    $('#tombolCariData').on('click', function () {
        let value = $('#cariData').val();
        $.ajax({
            url: 'http://localhost:8080/dataedit',
            type: 'post',
            dataType: 'json',
            data: { id: value },
            success: function (data) {
                console.log(data);
                $('#noTicket').val(data.tiket_id);
                $('#tag').val(data.case_id);
                $('#priorty').val(data.urgency);
                $('#keteranganTicket').val(data.desc);
                $('#awb').val(data.awb);
                $('#noOrder').val(data.no_order);
                $('#namaPic').val(data.pic_name);
                $('#account').val(data.account);
                $('#origin').val(data.origin);
                $('#regional').val(data.regional);
                $('#namaKota').val(data.city);
                $('#customerName').val(data.customer_name);
                $('#sellerName').val(data.seller_name);
                $('#merchantId').val(data.merchant_id);
                $('#sellerAddress').val(data.seller_address);
                $('#sellerPhone').val(data.seller_phone);
                $('#destinasi').val(data.destinasi);
                $('#service').val(data.service);
                $('#intruksi').val(data.intruksi);
                $('#insValue').val(data.ins_value);
                $('#codFlag').val(data.cod_flag);
                $('#codAmount').val(data.cod_amount);
                $('#armada').val(data.armada);
                $('#modulEntry').val(data.modul_entry);
                $('#keterangan').val(data.desc_good);
                $('#qty').val(data.qty);
                $('#weight').val(data.weight);
            },
        });
    });

    $('.tombol-notif').on('click', function () {
        const id = $(this).data('id');
        const tiket = $(this).data('tiket');

        $.ajax({
            url: 'http://localhost:8080/isread/store',
            data: { id: id, tiket: tiket },
            success: function () {
                window.location.href = 'http://localhost:8080/tiket/' + tiket;
            },
        });
    });

    $('.table').on('change', '#check-all', function () {
        const status = $('.table .status');
        const box = $('.table .check');

        const boxAll = document.querySelector('.table #check-all');

        if (boxAll.checked == true) {
            for (let i = 0; i < status.length; i++) {
                const element = status[i].innerHTML;
                if (element !== 'CLOSE') {
                    box[i].checked = true;
                }
            }
        } else {
            for (let i = 0; i < status.length; i++) {
                box[i].checked = false;
            }
        }
    });

    // Created Log Book

    const dropDown = () => {
        let issue = $('#issue').val();
        let oldSubType = $('#sub_type_old').val();

        $.ajax({
            url: 'http://localhost:8080/log/getSubType', // File PHP untuk mengambil kategori dari database
            dataType: 'json',
            data: {
                id: issue ? issue : 1,
            },
            success: function (data) {
                var options = '';
                options += '<option value=""><------ Sub Type -----></option>';
                for (var i = 0; i < data.length; i++) {
                    options +=
                        data[i].id == oldSubType
                            ? '<option selected value="' +
                              data[i].id +
                              '">' +
                              data[i].name +
                              '</option>'
                            : '<option value="' +
                              data[i].id +
                              '">' +
                              data[i].name +
                              '</option>';
                }
                $('#sub_type').html(options);
            },
        });
    };

    const dropDownDescription = () => {
        let subType = $('#sub_type').val();
        let oldDescription = $('#description_old').val();
        let oldSubType = $('#sub_type_old').val();

        $.ajax({
            url: 'http://localhost:8080/log/getDesc', // File PHP untuk mengambil kategori dari database
            dataType: 'json',
            data: {
                id: subType ? subType : oldSubType,
            },
            success: function (data) {
                var options = '';
                options +=
                    '<option value=""><------ Description -----></option>';
                for (var i = 0; i < data.length; i++) {
                    options +=
                        data[i].id == oldDescription
                            ? '<option selected value="' +
                              data[i].id +
                              '">' +
                              data[i].name +
                              '</option>'
                            : '<option value="' +
                              data[i].id +
                              '">' +
                              data[i].name +
                              '</option>';
                }
                $('#description').html(options);
            },
        });
    };

    const dropDownImpact = () => {
        let impact = $('#description').val();
        let oldDescription = $('#description_old').val();

        $.ajax({
            url: 'http://localhost:8080/log/getImpact', // File PHP untuk mengambil kategori dari database
            dataType: 'json',
            data: {
                id: impact ? impact : oldDescription,
            },
            success: function (data) {
                var options = '<option value=""><------ Impact -----></option>';
                for (var i = 0; i < data.length; i++) {
                    options = '';
                    options +=
                        '<option value="' +
                        data[i].id +
                        '">' +
                        data[i].name +
                        '</option>';
                }
                $('#impact').html(options);
            },
        });
    };

    dropDown();
    dropDownDescription();
    dropDownImpact();

    $('#issue').on('change', () => dropDown());

    $('#sub_type').on('change', () => dropDownDescription());

    $('#description').on('change', () => dropDownImpact());
});
