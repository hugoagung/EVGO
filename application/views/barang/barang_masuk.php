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
            <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
        </div>
        <div class="card-header py-3">
            <button type="button" data-toggle="modal" data-target="#tambahModal" class=" btn btn-primary">Tambah Data</button>
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
                                        <th>Keterangan</th>
                                        <th class="bjir">option</th>

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
                                                <!-- di sini variabel nonya diincrement (ditambah 1 tiap loop asu) -->
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
                                                <?= $bm['keterangan_masuk']; ?>
                                            </td>


                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal-<?= $bm['id_masuk']; ?>">update</button>
                                                <button type="button" data-toggle="modal" data-target="#delete_modal<?= $bm['id_masuk']; ?>" class="btn btn-danger">delete</button>

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


<!-- Tambah Barang Masuk -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Tambah Barang Mask</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('user/tambah_barang_masuk') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Barang</label>
                        <select name="id_barang" class="form-control" required>
                            <?php foreach ($barang as $brg) : ?>
                                <option value="<?= $brg['id_stok'] ?>"><?= $brg['nama_barang_stok'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="text" class="form-control" name='jumlah' required />
                    </div>

                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php foreach ($Barang_masuk as $bm) : ?>
    <div class="modal fade" id="updateModal-<?= $bm['id_masuk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Tambah Barang Masuk</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= base_url('user/update_barang_masuk') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $bm['id_masuk'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Barang</label>
                            <select name="id_barang" class="form-control">
                                <?php foreach ($barang as $brg) : ?>
                                    <option value="<?= $brg['id_stok'] ?>" <?php if ($brg['id_stok'] == $bm['id_barang_masuk']) {
                                                                                echo 'selected';
                                                                            } ?>><?= $brg['nama_barang_stok'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="text" class="form-control" name='jumlah' value='<?= $bm['jumlah_masuk'] ?>' />
                        </div>

                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"><?= $bm['keterangan_masuk'] ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($Barang_masuk as $bm) : ?>
    <div class="modal fade" id="delete_modal<?= $bm['id_masuk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Hapus data <?= $bm['nama_barang_stok']; ?>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('/user/hapus_Barang_masuk/') . $bm['id_masuk']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>