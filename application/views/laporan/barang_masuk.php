<div class="container-fluid">
    <!-- Pesan -->
    <?php if ($this->session->flashdata('sukses')) { ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('sukses') ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $this->session->flashdata('eror') ?>
        </div>
    <?php } ?>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            tanggal
                                        </th>
                                        <th>nama barang</th>
                                        <th>kategori</th>
                                        <th>jumlah</th>
                                        <th>Harga barang</th>
                                        <th>Total</th>
                                        <th>Keterangan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;

                                    foreach ($Barang_masuk as $bm) :
                                    ?>

                                        <tr>
                                            <td>
                                                <?= $no++; ?>
                                            </td>
                                            <td>
                                                <?= $bm['tanggal_masuk']; ?>
                                            </td>
                                            <td>
                                                <?= $bm['nama_barang_stok']; ?>
                                            </td>
                                            <td>
                                                <?= $bm['kategori_stok']; ?>
                                            </td>
                                            <td>
                                                <?= $bm['jumlah_masuk']; ?>
                                            </td>
                                            <td>
                                                Rp. <?= number_format($bm['harga_stok'], 0, ',', '.'); ?>
                                            </td>
                                            <td>
                                                Rp. <?= number_format($bm['jumlah_masuk'] *  $bm['harga_stok'], 0, ',', '.'); ?>
                                            </td>
                                            <td>
                                                <?= $bm['keterangan_masuk']; ?>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>