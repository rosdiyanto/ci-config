<?php 
public function delete($id)
{
	$this->db->db_debug = false;
	if(!@$this->M_domain->delete($id)){
		$error = $this->db->error();
		if ($error['code'] == 1451) {
			$this->session->set_flashdata('warning', 'Maaf Data tidak bisa dihapus karena berelasi dengan Data lain.');
		}else{
			$this->session->set_flashdata('success', 'Anda Berhasil Menghapus Data Domain');
		}
	}
	redirect('domain','refresh');
}
?>
