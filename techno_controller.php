<?php
class techno_controller extends CI_Controller{
    public function __construct()
    {
        CI_Controller::__construct();
        $this->load->model('techno_model');
    }
    public function index(){
        $view_data['sdata']=array('CPU'=>$this->session->userdata('CPU'),'CPU_cooler'=>$this->session->userdata('CPU_cooler'),'motherboard'=>$this->session->userdata('motherboard'),'RAM'=>$this->session->userdata('RAM'),'storage'=>$this->session->userdata('storage'),'video_card'=>$this->session->userdata('video_card'),'power_supply'=>$this->session->userdata('power_supply'),'case'=>$this->session->userdata('case'));
        var_dump($view_data);
        $this->load->view('main',$view_data);
    }
    public function products(){;
        $pitem=$this->input->post('part_item');
        var_dump($pitem);
        $view_data2['data']=$this->techno_model->load_products($pitem);
        $this->load->view('products',$view_data2);
    }
    public function item(){
        $post1= $this->input->post('item_select');
        $this->techno_model->select_item($post1);
        $this->index();
    }
    public function del_item(){
        $ditem=$this->input->post('delitem');
        $this->techno_model->remove_item($ditem);
        $this->index();
    }
}
?>