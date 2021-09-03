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
      <h6 class="m-0 font-weight-bold text-primary">Data Stok Barang</h6>
    </div>
    <div class="card-header py-3">
      <button type="button" data-toggle="modal" data-target="#tambah_modal" class=" btn btn-primary">Tambah Data</button>
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
                      Nama Barang
                    </th>
                    <th>Kategori</th>
                    <th>Stock</th>
                    <th>Harga</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;

                  foreach ($Stok_barang as $bm) :
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
                        <?= $bm['nama_barang_stok']; ?>
                      </td>
                      <td>
                        <?= $bm['kategori_stok']; ?>
                      </td>
                      <td>
                        <?= $bm['stok']; ?>
                      </td>
                      <td>
                        Rp. <?= number_format($bm['harga_stok'], 0, ',', '.'); ?>
                      </td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#update_modal<?= $bm['id_stok']; ?>" class=" btn btn-primary">Update</button>
                        <button type="button" data-toggle="modal" data-target="#delete_modal<?= $bm['id_stok']; ?>" class="btn btn-danger">Delete</button>
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


  <!-- Modal Tambah Data -->
  <div class="modal fade" id="tambah_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="<?= base_url('admin/tambah_stok_barang'); ?>" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Tambah Data</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <label>Nama Barang</label>
              <input class="form-control" type="text" name="nama_barang" required />
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <input class="form-control" type="text" name="kategori" required />
            </div>
            <div class="form-group">
              <label>Stok</label>
              <input class="form-control" type="number" name="stok" required />
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control" type="number" name="harga" required />
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

  <!-- Modal Update Data -->
  <?php foreach ($Stok_barang as $bm) : ?>
    <div class="modal fade" id="update_modal<?= $bm['id_stok']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= base_url('admin/update_stok_barang'); ?>" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Update Data</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" value="<?= $bm['id_stok']; ?>">

              <div class="form-group">
                <label>Nama Barang</label>
                <input class="form-control" type="text" name="nama_barang" value="<?= $bm['nama_barang_stok']; ?>" />
              </div>
              <div class=" form-group">
                <label>Kategori</label>
                <input class="form-control" type="text" name="kategori" value="<?= $bm['kategori_stok']; ?>" />
              </div>
              <div class=" form-group">
                <label>Stok</label>
                <input class="form-control" type="number" name="stok" value="<?= $bm['stok']; ?>" />
              </div>
              <div class="form-group">
                <label>Harga</label>
                <input class="form-control" type="number" name="harga" value="<?= $bm['harga_stok']; ?>" />
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

  <?php foreach ($Stok_barang as $bm) : ?>
    <div class="modal fade" id="delete_modal<?= $bm['id_stok']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <a class="btn btn-primary" href="<?= base_url('/admin/hapus_stok_barang/') . $bm['id_stok']; ?>">Hapus</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>