<?php
if (get('id') AND is_numeric(get('id'))) { // cek apakah id tersedia dan id berisi angka atau tidak
    $id = escape(get('id'));
} else { // jika tidak sesuai
    flashdata(['alert' => 'danger', 'title' => 'Gagal !', 'msg' => 'Parameter tidak sesuai!.']);
    exit(redirect(base_url('mahasiswa')));
}
if (is_method('post')) {
    $validation = check_input($_POST, [
        'nim', 'nama', 'alamat', 'no_telepon', 'jenis_kelamin', 'agama'
    ]);
    if ($validation == false) {
        flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.']);
    } else {
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
        $input = [
            'nim' => escape(post('nim')), 
            'nama' => escape(post('nama')), 
            'alamat' => escape(post('alamat')), 
            'no_telepon' => escape(post('no_telepon')), 
            'jenis_kelamin' => escape(post('jenis_kelamin')), 
            'agama' => escape(post('agama'))
        ];
        if (check_empty($input) == true) {
            flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.']);
        } else {
            if ($db->updateById('mahasiswa', $input, $id)) {
                flashdata(['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Mahasiswa ' .$data_mahasiswa['nama']. ' berhasil di ubah.']);
                exit(redirect(base_url('mahasiswa')));
            } else {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi kesalahan.']);
            }
        }
    }
}
?>