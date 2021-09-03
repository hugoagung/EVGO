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
            <h6 class="m-0 font-weight-bold text-primary">Data Barang Keluar</h6>
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
                                        <th>Harga barang</th>
                                        <th>Total</th>
                                        <th>Keterangan</th>
                                        <th class="bjir">option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;

                                    foreach ($Barang_keluar as $bm) :
                                        // asu2 kenapa rap rap rap rap
                                        // gua ngupil
                                        // masih ada saos
                                        // anjir idung gua pedes ASWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW ADA ADA AJA ASWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWwkwkwkwkwkwkwkwkwkwk 
                                        // kok bisa asw. ini nyisa dikit saosnya
                                        // pantesan kok pedes2
                                        // pas diliat, eh masih ada saos BJIR SUDAH Gilla KWKWKWKWK heran 
                                        // eh rap gw mau nanya dah itu fungsi dari $no apaan, $no = variabel no isinya 1

                                        // kal ofory

                                    ?>

                                        <tr>
                                            <td>
                                                <?= $no++; ?>
                                                <!-- di sini variabel nonya diincrement (ditambah 1 tiap loop asu) -->
                                            </td>
                                            <td>
                                                <?= $bm['tanggal_keluar']; ?>
                                            </td>
                                            <td>
                                                <?= $bm['nama_barang_stok']; ?>
                                            </td>
                                            <td>
                                                <?= $bm['kategori_stok']; ?>
                                            </td>
                                            <td>
                                                <?= $bm['jumlah_keluar']; ?>
                                            </td>
                                            <td>
                                                Rp. <?= number_format($bm['harga_stok'], 0, ',', '.'); ?>
                                            </td>
                                            <td>
                                                Rp. <?= number_format($bm['jumlah_keluar'] *  $bm['harga_stok'], 0, ',', '.'); ?>
                                            </td>

                                            <td>
                                                <?= $bm['keterangan_keluar']; ?>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal-<?= $bm['id_keluar']; ?>">update</button>
                                                <button type="button " data-toggle="modal" data-target="#delete_modal<?= $bm['id_keluar']; ?>" class="btn btn-danger">delete</button>

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

<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Tambah Barang Keluar</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('admin/tambah_barang_keluar') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Barang</label>
                        <select name="id_barang" class="form-control">
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

<!-- update modal -->
<?php foreach ($Barang_keluar as $bm) : ?>
    <div class="modal fade" id="updateModal-<?= $bm['id_keluar'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Ubah Barang Keluar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/update_barang_keluar') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $bm['id_keluar'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Barang</label>
                            <select name="id_barang" class="form-control">
                                <?php foreach ($barang as $brg) : ?>
                                    <option value="<?= $brg['id_stok'] ?>" <?php if ($brg['id_stok'] == $bm['id_barang_keluar']) {
                                                                                echo 'selected';
                                                                            } ?>><?= $brg['nama_barang_stok'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="text" class="form-control" name='jumlah' value='<?= $bm['jumlah_keluar'] ?>' />
                        </div>

                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"><?= $bm['keterangan_keluar'] ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($Barang_keluar as $bm) : ?>
    <div class="modal fade" id="delete_modal<?= $bm['id_keluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('/admin/hapus_Barang_keluar/') . $bm['id_keluar']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>