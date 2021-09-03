<div class="container-fluid">
  <!-- Pesan -->
  <?php if ($this->session->flashdata('sukses')) { ?>
    <div class="alert alert-success" role="alert">
      <?= $this->session->flashdata('sukses') ?>
    </div>
  <?php } ?>

  <?php if ($this->session->flashdata('eror')) { ?>
    <div class="alert alert-success" role="alert">
      <?= $this->session->flashdata('eror') ?>
    </div>
  <?php } ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Catatan</h6>
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
                    <th>nama</th>
                    <th>kategori</th>
                    <th>Keterangan</th>
                    <th>opsi</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;

                  foreach ($ambil_catatan as $ac) :

                  ?>

                    <tr>
                      <td>
                        <?= $no++; ?>
                        <!-- di sini variabel nonya diincrement (ditambah 1 tiap loop asu) -->
                      </td>

                      <td>
                        <?= $ac['nama_catatan']; ?>
                      </td>
                      <td>
                        <?= $ac['kategori_catatan']; ?>
                      </td>
                      <td>
                        <?= $ac['keterangan_catatan']; ?>
                      </td>

                      <td>
                        <button type="button" data-toggle="modal" data-target="#update_modal<?= $ac['id_catatan']; ?>" class="btn btn-primary">update</button>
                        <button type="button " data-toggle="modal" data-target="#delete_modal<?= $ac['id_catatan']; ?>" class="btn btn-danger">delete</button>

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
</div>
<!-- Modal Update Data -->
<?php foreach ($ambil_catatan as $ac) : ?>
  <div class="modal fade" id="update_modal<?= $ac['id_catatan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="<?= base_url('admin/update_catatan'); ?>" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Update Data</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" value="<?= $ac['id_catatan']; ?>">

            <div class="form-group">
              <label>Nama</label>
              <input class="form-control" type="text" name="nama" value="<?= $ac['nama_catatan']; ?>" required />
            </div>
            <div class=" form-group">
              <label>Kategori</label>
              <input class="form-control" type="text" name="kategori" value="<?= $ac['kategori_catatan']; ?>" required />
            </div>
            <div class=" form-group">
              <label>Keterangan</label>

              <textarea name="keterangan" cols="30" rows="10" class="form-control" required><?= $ac['keterangan_catatan'] ?></textarea>
            </div>


          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<?php foreach ($ambil_catatan as $ac) : ?>
  <div class="modal fade" id="delete_modal<?= $ac['id_catatan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="<?= base_url('admin/hapus_catatan') ?>" method="post">
        <input type="hidden" name="id" value="<?= $ac['id_catatan']; ?>">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Hapus data <?= $ac['nama_catatan']; ?>?
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Hapus</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php endforeach; ?>


<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url('admin/tambah_catatan'); ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Tambah Data</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label>Nama</label>
            <input class="form-control" type="text" name="nama" />
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <input class="form-control" type="text" name="kategori" />
          </div>
          <div class="form-group">
            <label>keterangan</label>
            <textarea name="keterangan" cols="30" rows="10" class="form-control"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>