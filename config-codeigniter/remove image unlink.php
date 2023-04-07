<?php

public function delete($id)
	{
		$data = $this->M_pegawai->get_by_id($id)->row();
		$img =  $data->foto;
		$path_img = FCPATH.'/uploads/pegawai/';
		@unlink($path_img.$img);
		$this->M_pegawai->delete($id);
		redirect('pegawai','refresh');
	}
