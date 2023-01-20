<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<main id="main" class="main">
    <?php if (session('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Edit | Dashboard</h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Masukan No ticket ..." name="cariData" id="cariData" autocomplete="off">
                        <button class="btn btn-primary" type="button" id="tombolCariData" name="tombolCariData" data-bs-toggle="modal" data-bs-target="#editData">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <form action="/update" method="post">
        <?php csrf_field(); ?>
        <div class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="noTicket" name="noTicket">
                        <div class="mb-3">
                            <label for="tag" class="form-label">Case</label>
                            <select class="form-select" id="tag" name="case">
                                <?php foreach ($cases as $case) : ?>
                                    <option value="<?= $case['id'] ?>"><?= $case['case'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea type="textarea" class="form-control" id="keteranganTicket" name="keteranganTicket" style="height: 100px"> </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="priorty" class="form-label">Priorty</label>
                            <select class="form-select" id="priorty" name="urgency">
                                <option value="VERY HIGH">VERY HIGH</option>
                                <option value="HIGH">HIGH</option>
                                <option value="MEDIUM">MEDIUM</option>
                                <option value="LOW">LOW</option>
                            </select>
                            <div class="mb-3">
                                <label for="awb" class="form-label">Awb</label>
                                <input type="text" class="form-control" id="awb" name="awb">
                            </div>
                            <div class="mb-3">
                                <label for="noOrder" class="form-label">No Order</label>
                                <input type="text" class="form-control" id="noOrder" name="no_order">
                            </div>
                            <div class="mb-3">
                                <label for="namaPic" class="form-label">Nama PIC</label>
                                <input type="text" class="form-control" id="namaPic" name="nama_pic">
                            </div>

                            <div class="mb-3">
                                <label for="account" class="form-label">Account</label>
                                <input type="text" class="form-control" id="account" name="account">
                            </div>

                            <div class="mb-3">
                                <label for="origin" class="form-label">Origin</label>
                                <input type="text" class="form-control" id="origin" name="origin">
                            </div>

                            <div class="mb-3">
                                <label for="regional" class="form-label">Regional</label>
                                <select class="form-select" aria-label="Default select example" id="regional" name="regional">
                                    <option value="JTBNN">JTBNN</option>
                                    <option value="JATENG">JATENG</option>
                                    <option value="BDTBCC">BDTBCC</option>
                                    <option value="JAKARTA">JAKARTA</option>
                                    <option value="KALIMANTAN">KALIMANTAN</option>
                                    <option value="SULPA">SULPA</option>
                                    <option value="SUMBAGUT">SUMBAGUT</option>
                                    <option value="SUMBAGSEL">SUMBAGSEL</option>
                                    <option value="JABAR">JABAR</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="namaKota" class="form-label">City</label>
                                <input type="text" class="form-control" id="namaKota" name="nama_kota">
                            </div>

                            <div class="mb-3">
                                <label for="customerName" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customerName" name="customer_name">
                            </div>

                            <div class="mb-3">
                                <label for="sellerName" class="form-label">Seller Name</label>
                                <input type="text" class="form-control" id="sellerName" name="seller_name">
                            </div>

                            <div class="mb-3">
                                <label for="merchantId" class="form-label">Merchant ID</label>
                                <input type="text" class="form-control" id="merchantId" name="merchant_id">
                            </div>
                            <div class="mb-3">
                                <label for="sellerAddress" class="form-label">Seller Address</label>
                                <input type="text" class="form-control" id="sellerAddress" name="seller_address">
                            </div>

                            <div class="mb-3">
                                <label for="sellerPhone" class="form-label">Seller Phone</label>
                                <input type="text" class="form-control" id="sellerPhone" name="seller_phone">
                            </div>

                            <div class="mb-3">
                                <label for="destinasi" class="form-label">Destinasi</label>
                                <input type="text" class="form-control" id="destinasi" name="destinasi">
                            </div>

                            <div class="mb-3">
                                <label for="service" class="form-label">Service</label>
                                <input type="text" class="form-control" id="service" name="service">
                            </div>

                            <div class="mb-3">
                                <label for="intruksi" class="form-label">Intruksi</label>
                                <input type="text" class="form-control" id="intruksi" name="intruksi">
                            </div>

                            <div class="mb-3">
                                <label for="insValue" class="form-label">Ins Value</label>
                                <input type="text" class="form-control" id="insValue" name="ins_value">
                            </div>

                            <div class="mb-3">
                                <label for="codFlag" class="form-label">Cod Flag</label>
                                <input type="text" class="form-control" id="codFlag" name="cod_flag">
                            </div>

                            <div class="mb-3">
                                <label for="codAmount" class="form-label">Cod Amount</label>
                                <input type="text" class="form-control" id="codAmount" name="cod_amount">
                            </div>

                            <div class="mb-3">
                                <label for="armada" class="form-label">Armada</label>
                                <input type="text" class="form-control" id="armada" name="armada">
                            </div>

                            <div class="mb-3">
                                <label for="modulEntry" class="form-label">Modul Entry</label>
                                <input type="text" class="form-control" id="modulEntry" name="modul_entry">
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="desc">
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="text" class="form-control" id="qty" name="qty">
                            </div>

                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight</label>
                                <input type="text" class="form-control" id="weight" name="weight">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    <!-- EndModal -->

</main><!-- End #main -->

<?= $this->endSection(); ?>
