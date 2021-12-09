<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//get_instance()->load->helper('constant');
$this->load->view('layout/header');
$this->load->view('layout/leftmenu');
$this->load->view($main_content);
$this->load->view('layout/footer');
?>
