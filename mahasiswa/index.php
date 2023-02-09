<?php
require_once '../init.php';
if(user() == false) exit(redirect(base_url('auth/logout')));
set_page('Dashboard');
include '../layouts/primary.php';
include '../apps/mahasiswa/import.php';
if (get('action') AND get('action') == 'delete') {
    if (get('id') AND is_numeric(get('id'))) {
        $query_mahasiswa = $db->query([
            'select' => '*',
            'table' => 'mahasiswa',
            'where' => 'id = "' . escape(get('id')) .'"',
            'first' => true
        ]);
        if ($query_mahasiswa['count'] == 0) { // cek apakah data tersedia
            flashdata(['alert' => 'danger', 'title' => 'Gagal !', 'msg' => 'Data mahasiswa tidak di temukan!.']);
            exit(redirect(base_url('mahasiswa')));
        }
        if ($db->deleteById('mahasiswa', escape(get('id')))) {
            flashdata(['alert' => 'success', 'title' => 'Berhasil !', 'msg' => 'Berhasil menghapus data mahasiswa ' . $query_mahasiswa['rows']['nama'] . '!.']);
            exit(redirect(base_url('mahasiswa')));
        } else {
            flashdata(['alert' => 'danger', 'title' => 'Gagal !', 'msg' => 'Gagal menghapus data mahasiswa!.']);
        }
    }
}
?>
<div class="row">
    <div class="row ">
        <div class="col-md-12">
            <?= alert() ?>
        </div>
    </div>
    <div class="col-md-12">
        <a href="<?= base_url('mahasiswa.tambah') ?>" class="btn btn-md btn-success mb-3">Tambah</a>
        <a href="<?= base_url('mahasiswa.export') ?>" class="btn btn-md btn-success mb-3">Export Excel</a>
        <a href="javascript:;" class="btn btn-md btn-success mb-3" data-bs-toggle="modal" data-bs-target="#importModal">Import Excel</a>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <a href="<?= site_url('sample/excel/data-mahasiswa.xlsx') ?>">Download Format</a>
                        <div class="form-group">
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="import" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-nowrap">
                <thead>
                    <tr class="bg-success">
                        <th width="150" scope="col">NIM</th>
                        <th width="350" scope="col">NAMA MAHASISWA</th>
                        <th width="300" scope="col">ALAMAT</th>
                        <th width="250" colspan="2" scope="col" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        $tables = $db->query([
                            'select' => '*',
                            'table' => 'mahasiswa'
                        ]);
                    ?>
                    <?php 
                        if ($tables['count'] == 0){ 
                    ?>
                    <tr>
                        <td colspan="4" class="text-center">Data masih kosong...</td>
                    </tr>
                    <?php } ?>
                    <?php foreach($tables['rows'] as $key => $value) {  ?>
                    
                    <tr>
                        <td><?= $value['nim'] ?></td>
                        <td><?= $value['nama'] ?></td>
                        <td><?= $value['alamat'] ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('mahasiswa.edit?id=' . $value['id']) ?>"
                                class="btn btn-md btn-warning mb-1 text-decoration-none">Edit</a>
                            <a href="<?= base_url('mahasiswa.index?action=delete&id=' . $value['id']) ?>"
                                onclick="return confirm('Apakah anda yakin akan menghapus data dari <?= $data['nama'] ?>?')"
                                class="btn btn-md btn-danger mb-1 text-decoration-none">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../layouts/footer.php'; ?>