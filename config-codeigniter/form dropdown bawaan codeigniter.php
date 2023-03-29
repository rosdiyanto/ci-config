public function cek()
{
    $kategori = $this->M_kategori->get_kategori()->result();
    foreach ($kategori as $row) {
        $data['kategori'][$row->category_id] = $row->category_name;
    }
    $datat['buku'] = $this->M_buku->get_id(14)->row();
    echo "<pre>";
    print_r ($data);
    echo "</pre>";		
    
    echo "<pre>";
    print_r ($datat);
    echo "</pre>";
    
    echo "<pre>";
    print_r ($datat['buku']->category_id);
    echo "</pre>";
    
    echo "<pre>";
    print_r ($data['kategori']);
    echo "</pre>";

    $datanya = array('Y' => 'enable', 'N' => 'disable' );
    $nilainya = 'Y';
    
    echo "<pre>";
    print_r ($datanya);
    echo "</pre>";

    echo form_dropdown('status', $datanya, $nilainya,'class="form-control" required');
    echo form_dropdown('category_id', $data['kategori'], $datat['buku']->category_id,'class="form-control" required');
}
