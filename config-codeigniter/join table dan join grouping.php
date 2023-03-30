<?php
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
