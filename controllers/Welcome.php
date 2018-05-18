<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /*
          CI  框架内置分页
      */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination'); //系统的library
        $this->load->model('welcome_model','welcome');    //调数据库数据
        $this->load->helper('url');       //系统的帮助类
    }
    function index()
    {
        //总记录数
        $date=$this->welcome->gettotal();
        $number=$date[0]->total;

        $config['base_url'] = site_url('http://localhost:1111/welcome/'); //路径
        $config['total_rows'] = $number;  //配置记录总条数
        $config['per_page'] = 2; //配置每页显示的记录数

        //如果你希望在整个分页周围围绕一些标签，你可以通过下面的两种方法：
        //      $config['first_tag_open'] = '<div>';
        //        $config['first_tag_close'] = '</div>';
        $config['uri_segment'] = 3;     //指定第几参数为分页页数(默认是3 这个可不写)
        $config['next_link'] = '下一页';
        $config['prev_link'] = '上一页';
        $config['last_link'] = '末页';
        $config['first_link'] = '首页';
        //配置分页导航当前页两边显示的条数
        $config['num_links'] = 3;
        //配置偏移量在url中的位置
        $config['cur_page'] = $this->uri->segment(3);
        //配置分页类

        $tab['table']=$this->welcome->get_books($config ['per_page'], $this->uri->segment(3));//当前页显示的数据

        $this->pagination->initialize($config);
        $this->load->view('news/index',$tab);     //调页面  传数据
    }
}
