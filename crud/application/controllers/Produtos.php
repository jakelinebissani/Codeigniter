<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  produtos_model
 */
class Produtos extends CI_Controller
{


    public function index()
    {
        $this->output->enable_profiler(TRUE);
        $this->load->model("Produtos_model");

        $produtos = $this->Produtos_model->buscaTodos();

        $dados = array("produtos" => $produtos);
        $this->load->helper(array("url","currency","form"));;
        $this->load->view("produtos/index.php", $dados);
    }
}