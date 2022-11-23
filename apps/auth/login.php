<?php
if (is_login()) exit(redirect(base_url()));
if (is_method('post')) {
    $validation = check_input($_POST, [
        'username', 'password'
    ]);
	if ($validation == false) {
		flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.']);
	} else {
		$input = [
            'username' => escape(post('username')),
			'password' => escape(post('password')),
        ];
		if (check_empty($input) == true) {
			flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.']);
		} else {
            $user = $db->query([
                'select' => 'id, username, password',
                'table' => 'users',
                'where' => 'username = "' . $input['username'] .'"',
                'first' => true
            ]);
			if ($user['count'] == 1) {
				if (password_verify($input['password'], $user['rows']['password']) == true) {
                    $_SESSION['login'] = true;
					$_SESSION['user']['id'] = $user['rows']['id'];
					flashdata(['alert' => 'success', 'title' => 'Berhasil masuk!', 'msg' => 'Selamat datang '.$user['rows']['username'].'!']);
					exit(redirect(base_url()));
				} else {
					flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username atau password salah.']);
				}
			} else {
				flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Pengguna tidak ditemukan.']);
			}
		}
	}
}