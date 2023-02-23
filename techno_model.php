<?php
class techno_model extends CI_Model{
    public function load_products($item){
        return $this->db->query("SELECT * FROM products WHERE ptype=?",$item)->result_array();
    }
    public function select_item($post1){
        if($post1[0]['ptype'] == "CPU"){
            $this->session->set_userdata('CPU',$post1);
        } elseif($post1[0]['ptype'] == "CPU_cooler"){
            $this->session->set_userdata('CPU_cooler',$post1);
        } elseif($post1[0]['ptype'] == "motherboard"){
            $this->session->set_userdata('motherboard',$post1);
        } elseif($post1[0]['ptype'] == "RAM"){
            $this->session->set_userdata('RAM',$post1);
        } elseif($post1[0]['ptype'] == "storage"){
            $this->session->set_userdata('storage',$post1);
        } elseif($post1[0]['ptype'] == "video_card"){
            $this->session->set_userdata('video_card',$post1);
        } elseif($post1[0]['ptype'] == "power_supply"){
            $this->session->set_userdata('power_supply',$post1);
        } elseif($post1[0]['ptype'] == "case"){
            $this->session->set_userdata('case',$post1);
        }
    }
    public function remove_item($ditem){
        if($ditem == 'CPU'){
            $this->session->unset_userdata('CPU');
        }elseif($ditem == 'CPU_cooler'){
            $this->session->unset_userdata('CPU_cooler');
        }elseif($ditem == 'motherboard'){
            $this->session->unset_userdata('motherboard');
        }elseif($ditem == 'RAM'){
            $this->session->unset_userdata('RAM');
        }elseif($ditem == 'storage'){
            $this->session->unset_userdata('storage');
        }elseif($ditem == 'video_card'){
            $this->session->unset_userdata('video_card');
        }elseif($ditem == 'power_supply'){
            $this->session->unset_userdata('power_supply');
        }elseif($ditem == 'case'){
            $this->session->unset_userdata('case');
        }
    }
    public function sort_items(){
        
    }
}
?>