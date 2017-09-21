<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Produtos extends CI_Controller {

    public function index()
    {
        $this->output->enable_profiler(TRUE);
        $this->load->model("produtos_model");
        $produtos = $this->produtos_model->buscaTodos();

        $dados = array("produtos" => $produtos);
        $this->load->helper(array("currency"));
        $this->load->view("produtos/index.php", $dados);
    }

    public function formulario() {
        $this->load->view("produtos/formulario");
    }

    public function novoUsuario() {
        $this->load->view("usuarios/novo");
    }

    public function novo() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("nome", "nome", "required|min_length[5]|callback_nao_tenha_a_palavra_melhor");
        $this->form_validation->set_rules("preco","preco", "required");
        $this->form_validation->set_rules("descricao", "descricao", "required|min_length[10]");
        $this->form_validation->set_error_delimiters("<p class='alert alert-danger', </p>");
        $sucesso = $this->form_validation->run();
        if ($sucesso) {
            $usuarioLogado = $this->session->userdata("usuario_logado");
            $produto = array(
                "nome" => $this->input->post("nome"),
                "descricao" => $this->input->post("descricao"),
                "preco" => $this->input->post("preco"),
                "usuario_id" => $usuarioLogado["id"]
            );
            $this->load->model("produtos_model");
            $this->produtos_model->salva($produto);
            $this->session->set_flashdata("success", "Produto salvo com sucesso");
            redirect("/");
        }else {
            $this->load->view("produtos/formulario");
            }
        }

    public function mostra($id){
        //$id = $this->input->get("id");
        $this->load->model("produtos_model");
        $produto=$this->produtos_model->busca($id);
        $this->load->helper("typography");
        $dados = array("produto"=>$produto);
        $this->load->view("produtos/mostra", $dados);
    }

    public function nao_tenha_a_palavra_melhor($nome) {
        $posicao = strpos($nome, "melhor");
        if($posicao !== FALSE) {
            $this->form_validation->set_message("nao_tenha_a_palavra_melhor", "O campo '%s' não pode conter a palavra 'melhor'");
            return FALSE;
        } else {
            return TRUE;
        }
    }

}