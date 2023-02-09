<?php
if (is_login()) exit(redirect(base_url()));
if (is_method('post')) {
    $validation = check_input($_POST, [
        'name', 'username', 'password'
    ]);
	if ($validation == false) {
		flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.']);
	} else {
		$input = [
            'name' => escape(post('name')),
            'username' => escape(post('username')),
			'password' => password_hash(escape(post('password')), PASSWORD_DEFAULT),
        ];
		if (check_empty($input) == true) {
			flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.']);
		} else {
            $check_username = $db->query([
                'select' => 'id',
                'table' => 'users',
                'where' => 'username = "' . $input['username'] .'"',
                'first' => true
            ]);
            if ($check_username['count']) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username telah digunakan.']);
            } else {
                if ($db->insert('users', $input)) {
                    flashdata(['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Pendaftaran pengguna baru berhasil di lakukan.']);
                    exit(redirect(base_url()));
                } else {
                    flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi kesalahan.']);
                }
            }
		}
	}
}