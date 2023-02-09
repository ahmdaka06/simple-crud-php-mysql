<?php
require_once '../init.php';
if(user() == false) exit(redirect(base_base_url('auth/logout')));

include '../apps/mahasiswa/edit.php';
if (get('id') AND is_numeric(get('id'))) { // cek apakah id tersedia dan id berisi angka atau tidak
    $id = escape(get('id'));
} else { // jika tidak sesuai
    flashdata(['alert' => 'danger', 'title' => 'Gagal !', 'msg' => 'Parameter tidak sesuai!.']);
    exit(redirect(base_url('mahasiswa')));
}
$query_mahasiswa = $db->query([
    'select' => '*',
    'table' => 'mahasiswa',
    'where' => 'id = "' . $id .'"',
    'first' => true
]);
if ($query_mahasiswa['count'] == 0) { // cek apakah data tersedia
    flashdata(['alert' => 'danger', 'title' => 'Gagal !', 'msg' => 'Data mahasiswa tidak di temukan!.']);
    exit(redirect(base_url('mahasiswa')));
}
$data_mahasiswa = $query_mahasiswa['rows'];
set_page('Edit Mahasiswa ' . $data_mahasiswa['nim'] );

include '../layouts/primary.php';
?>
<div class="p-2 mb-4 bg-light shadow rounded-3">
    <div class="container-fluid">
        <h2 class="display-5 fw-bold fs-4 mt-4">Edit Data Mahasiswa <?= $data_mahasiswa['nama'] ?></h2>
        <div class="row">
            <div class="col-md-12">
                <a href="<?= base_url('mahasiswa') ?>" class="btn btn-md btn-success my-3">Kembali</a>
            </div>
            <div class="col-md-12 mb-5">
                <div class="card shadow py-2">
                    <div class="card-body">
                        <hr>
                        <form action="" method="POST" class="mb-5">
                            <div class="form-group mt-2">
                                <label for="">NIM</label>
                                <input type="number" class="form-control" name="nim" placeholder="NIM" value="<?= $data_mahasiswa['nim'] ?>" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">NAMA</label>
                                <input type="text" class="form-control" name="nama" placeholder="NAMA" value="<?= $data_mahasiswa['nama'] ?>" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">ALAMAT</label>
                                <textarea name="alamat" class="form-control" cols="2" rows="2" placeholder="ALAMAT" required><?= $data_mahasiswa['alamat'] ?></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">NO TELEPON</label>
                                <input type="number" class="form-control" name="no_telepon" placeholder="NO TELEPON" value="<?= $data_mahasiswa['no_telepon'] ?>" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Jenis Kelamin</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="pria" <?= ($data_mahasiswa['jenis_kelamin'] == 'pria') ? 'checked' : '' ?> id="pria" required>
                                    <label class="form-check-label" for="pria">
                                       Pria
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="wanita" id="wanita" <?= ($data_mahasiswa['jenis_kelamin'] == 'wanita') ? 'checked' : '' ?> required>
                                    <label class="form-check-label" for="wanita">
                                       Wanita
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">AGAMA</label>
                                <select name="agama" class="form-control" required>
                                    <option value=""> - Pilih Salah Satu - </option>
                                    <?php foreach (LIST_AGAMA as $key => $value) { ?>
                                        <option value="<?= strtolower($value) ?>" <?= ($value == $data_mahasiswa['agama']) ? 'selected' : '' ?>><?= strtoupper($value) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mt-2 text-center">
                                <button class="btn btn-success"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../layouts/footer.php'; ?>