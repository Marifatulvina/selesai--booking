$isibooking = [ 'id_booking' => 
$this->ModelBooking-
>kodeOtomatis('booking', 'id_booking'), 
'tgl_booking' => date('Y-m-d H:m:s'), 
'batas_ambil' => date('Y-m-d', 
strtotime('+2 days', strtotime($tglsekarang))), 'id_user' => $where 
]; 
//menyimpan ke tabel booking dan detail booking, dan mengosongkan tabel temporari 
$this->ModelBooking->insertData('booking', $isibooking); 
$this->ModelBooking->simpanDetail($where); 
$this->ModelBooking->kosongkanData('temp'); 
redirect(base_url() . 'booking/info'); 
}
$this->db->query("UPDATE buku, temp SET buku.dibooking=buku.dibooking+1, buku.stok=buku.stok-1 WHERE buku.id=temp.id_buku");
$this->ModelBooking->insertData('booking', $isibooking); 
$this->ModelBooking->simpanDetail($where); 
$this->ModelBooking->kosongkanData('temp'); 

redirect(base_url() . 'booking/info');

public function info() 
{
$where = $this->session->userdata('id_user');
$data['user'] = $this->session->userdata('nama');
$data['judul'] = "Selesai Booking";
$data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();

$data['items'] = $this->db-
>query("select*from booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id and bo.id_user='$where'")->result_array();

$this->load->view('templates/templates-user/header', $data);
$this->load->view('booking/info-booking', $data);
$this->load->view('templates/templates-user/modal');
$this->load->view('templates/templates-user/footer');
}

