<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function autenticar()
    {
        $this->load->model("Usuarios_model");
        $email = $this->input->post("email");
        $senha = md5($this->input->post("senha"));
        $usuario = $this->Usuarios_model->buscaPorEmailESenha($email, $senha);
        if ($usuario) {
            $dados = array("mensagem" => "Logado com sucesso");
            $this->session->set_userdata("usuario_logado", $usuario);
        } else {
            $dados = array("mensagem" => "Usuário ou senha inválida.");
        }

        $this->load->view('login/autenticar', $dados);
    }

    public function logout()
    {
        $this->session->unset_userdata("usuario_logado");
        $this->load->view('login/logout');
    }
}