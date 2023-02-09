<?php
if (is_method('post')) {
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);
     
        if('csv' == $extension) $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        else $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
 
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
 
        $sheet_data = $spreadsheet->getActiveSheet()->toArray();
         
        if (!empty($sheet_data)) {
            for ($i = 3; $i < count($sheet_data); $i++) {
                // exit('<pre>'.print_r($sheet_data[$i]).'</pre>');
                $data = [
                    'nim' => $sheet_data[$i][1], 
                    'nama' => $sheet_data[$i][2], 
                    'jenis_kelamin' => (in_array(strtolower($sheet_data[$i][3]), ['laki - laki', 'pria', 'l'])) ? 'pria' : 'wanita', 
                    'no_telepon' => $sheet_data[$i][4], 
                    'agama' => strtolower($sheet_data[$i][5]),
                    'alamat' => $sheet_data[$i][6], 
                ];
                if (check_empty($data) == true || !in_array($data['agama'], LIST_AGAMA)) {
                    exit(print_r($sheet_data[$i]));
                    continue;
                } else {
                    if ($db->insert('mahasiswa', $data)) {
                        flashdata(['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data mahasiswa berhasil di import.']);
                        exit(redirect(base_url('mahasiswa')));
                    } else {
                        flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi kesalahan.']);
                        exit(redirect(base_url('mahasiswa')));
                    }
                }
            }
        } else {
            flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data yang di import tidak sesuai.']);
            exit(redirect(base_url('mahasiswa')));
        }
    } else {
        flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data yang di import tidak sesuai.']);
        exit(redirect(base_url('mahasiswa')));
    }
}
?>