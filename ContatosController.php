<?php

class ContatosController extends Controller
{

    /**
     * Lista os contatos
     */
    public function listar()
    {
        $contatos = Contato::all();
        return $this->view('grade', ['contatos' => $contatos]);
    }

    /**
     * Mostrar formulario para criar um novo contato
     */
    public function criar()
    {
        return $this->view('form');
    }

    /**
     * Mostrar formulário para editar um contato
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $contato = Contato::find($id);

        return $this->view('form', ['contato' => $contato]);
    }
    
    /**
     * Salvar o contato submetido pelo formulário
     */
    public function salvar()
    {
        $contato           = new Contato;
        $contato->nome     = $this->request->nome;
        $contato->telefone = $this->request->telefone;
        $contato->email    = $this->request->email;
        $contato->cpf      = $this->request->cpf;
        $contato->nasc     = $this->request->nasc;
        $contato->gen      = $this->request->gen;
            // salva o cpf enviado na variável
        $cpf = $contato->cpf;
            //verifica se o cpf já está cadastrado no banco
        if (($contato->nome == "") || ($contato->telefone == "") || ($contato->email == "") || ($contato->cpf == "") || ($contato->nasc == "") || ($contato->gen == "")) {
            echo('<p style="margin:20px"> <strong>Por favor preencha todos os campos.</strong> </p>');
            echo ('<a style="margin:3px 0px 10px 20px" class="btn btn-danger" href="?controller=ContatosController&method=criar">Voltar</a>');    
        } else if(is_numeric($cpf) == false || strlen($cpf) < 11 || strlen($cpf) > 11) {
            echo('<p style="margin:20px"> <strong>CPF inválido. Por favor utilize apenas números (mínimo de 11 carácteres).</strong> </p>');
            echo ('<a style="margin:3px 0px 10px 20px" class="btn btn-danger" href="?controller=ContatosController&method=criar">Voltar</a>');
        } else if(Contato::findCpf($cpf)) {
            // se o cpf ja estiver cadastrado
            echo('<p style="margin:20px"> <strong> CPF já cadastrado.</strong> </p>');
            echo ('<a style="margin:3px 0px 10px 20px" class="btn btn-danger" href="?controller=ContatosController&method=criar">Voltar</a>');
        } else {
            // se o cpf não estiver cadastrado
            // salva os dados no banco
            if ($contato->save()) {
            return $this->listar();
        }
        }
    }

    /**
     * Atualizar o contato conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $id                = (int) $dados['id'];
        $contato           = Contato::find($id);
        $contato->nome     = $this->request->nome;
        $contato->telefone = $this->request->telefone;
        $contato->email    = $this->request->email;
        $contato->nasc     = $this->request->nasc;
        $contato->gen      = $this->request->gen;
        $contato->save();

        return $this->listar();
    }

    /**
     * Apagar um contato conforme o id informado
     */
    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $contato = Contato::destroy($id);
        return $this->listar();
    }

    // public function excluirView($dados)
    // {
    //   $id      = (int) $dados['id'];
    //   $contato = Contato::destroyView($id);
    //   return $this->listar();
    // }
}