<?php

public function gabung()
{
    // cara kerja
    // yaitu menampilkan seluruh data dari tabel left (tbl_pemberhentian atau a) besetda jumlah rows pada table a
    // dan menggabungkan ke tabel right (tbl_pegawai atau b)
    // dimana primary key di tbl a dan foreignkey di table b
    $this->db->select('a.id, b.nip, b.nama, b.gender, a.jenis_pemberhentian, b.jabatan, a.tgl_usulan, a.status');
    $this->db->from('tbl_pemberhentian as a');
    $this->db->join('tbl_pegawai as b', 'a.id_pegawai = b.id', 'left');
    $this->db->order_by('a.id', 'desc');
    return $this->db->get();
}

public function join($id)
{
    $this->db->select('tbl_slider.id, img');
    $this->db->from('tbl_slider');
    $this->db->join('tbl_domain', 'tbl_domain.id = tbl_slider.domain_id', 'left');
    $this->db->where('tbl_domain.id', $id);
    return $this->db->get();
}

public function join_group()
{
    $this->db->select('tbl_domain.id,tbl_domain.domain,Count(tbl_slider.img) AS count,tbl_slider.img');
    $this->db->from('tbl_slider');
    $this->db->join('tbl_domain', 'tbl_domain.id = tbl_slider.domain_id', 'right');
    $this->db->group_by('tbl_domain.id');
    return $this->db->get();
}
