<?php
if (is_method('post')) {
    $validation = check_input($_POST, [
        'nim', 'nama', 'alamat', 'no_telepon', 'jenis_kelamin', 'agama'
    ]);
    if ($validation == false) {
        flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.']);
    } else {
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
            $check_nim = $db->query([
                'select' => 'id',
                'table' => 'mahasiswa',
                'where' => 'nim = "' . $input['nim'] .'"',
                'first' => true
            ]);
            if ($check_nim['count']) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'NIM telah terdaftar.']);
            } else {
                if ($db->insert('mahasiswa', $input)) {
                    flashdata(['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Mahasiswa baru berhasil di tambahkan.']);
                    exit(redirect(base_url('mahasiswa.tambah')));
                } else {
                    flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi kesalahan.']);
                }
            }
        }
    }
}
?>