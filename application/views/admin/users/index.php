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
            <h6 class="m-0 font-weight-bold text-primary">Data Manajemem Akun</h6>
        </div>
        <div class="card-header py-3">
            <a href="<?= base_url('admin/tambah_user') ?>" class="btn btn-primary">Tambah Data</a>
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
                                            Poto
                                        </th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;

                                    foreach ($users as $user) :

                                    ?>

                                        <tr>
                                            <td>
                                                <?= $no++; ?>
                                            </td>
                                            <td>
                                                <img src="<?= base_url('assets/img/profile/' . $user['image_admin']); ?>" width="100" height="100" />
                                            </td>
                                            <td>
                                                <?= $user['name_admin']; ?>
                                            </td>
                                            <td>
                                                <?= $user['email_admin']; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/update_user/' . $user['id_admin']) ?>" class=" btn btn-primary">Update</a>
                                                <button type="button" data-toggle="modal" data-target="#delete_modal<?= $user['id_admin']; ?>" class="btn btn-danger">Delete</button>
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


<?php foreach ($users as $bm) : ?>
    <div class="modal fade" id="delete_modal<?= $bm['id_admin']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Hapus data <?= $bm['name_admin']; ?>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('/admin/hapus_users/') . $bm['id_admin']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>