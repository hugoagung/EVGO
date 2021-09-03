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
      <h6 class="m-0 font-weight-bold text-primary">Data Barang Keluar</h6>
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
                        <?= $bm['nama_barang']; ?>
                      </td>
                      <td>
                        <?= $bm['kategori']; ?>
                      </td>
                      <td>
                        <?= $bm['stok']; ?>
                      </td>
                      <td>
                        <?= $bm['harga']; ?>
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