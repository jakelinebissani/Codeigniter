<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendas extends CI_Controller {
    public function nova() {
        $this->load->model(array("vendas_model"));
        $this->load->helper(array("date"));
        $usuario = $this->session->userdata("usuario_logado");

        $venda = array(
            "produto_id" => $this->input->post("produto_id"),
            "comprador_id" => $usuario["id"],
            "data_de_entrega" => dataPtBrParaMysql($this->input->post("data_de_entrega"))
        );

        $this->vendas_model->salva($venda);
        $this->session->set_flashdata("success", "Pedido de compra efetuado com sucesso");
        redirect("/");
    }
}