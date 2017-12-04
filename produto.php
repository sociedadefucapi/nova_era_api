<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

include_once 'config/Conexao.php';
include_once '_bean/produto.php';
include_once '_dao/produtoDAO.php';

$request_body = json_decode(file_get_contents('php://input'));

switch($_SERVER["REQUEST_METHOD"]){

    case "GET":
        if(isset($_GET["id"])){
            $produto = new produtoDAO();
            $return      = $produto->consultar($_GET["id"]);
        } else {
            $produto = new produtoDAO();
            $return = $produto->consultar(null);
        }
        print_r(json_encode($return));
        break;

    case "PUT":

        parse_str(file_get_contents("php://input"),$post_vars);
        if(isset($_GET["id"])){
            $id             = $_GET["id"];
            $nome           = trim($post_vars ["nome"]);
            $cod_barra    = trim($post_vars ["cod_barra"]);
            $setor   = trim($post_vars ["setor"]);
            $preco       = trim($post_vars ["preco"]);
            $disponibilidade     = trim($post_vars ["disponibilidade"]);
            $imagem     = trim($post_vars ["imagem"]);

            $produto    = new produto($nome, $cod_barra, $setor, $preco, $disponibilidade, null);
            $produtoDao = new produtoDAO();
            $return         = $produtoDao->alterar($id, $produto);
      } else {
          $return['message'] = "Você deve informar o ID do produto para atualização.";
      }

      echo json_encode($return, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      break;

    case "POST":

        if(isset($request_body)){

            $produto = new produto(
             $request_body->nome,
             $request_body->marca,
             $request_body->codigo,
             $request_body->setor,
             $request_body->preco,
             $request_body->imagem
            );
            
            $produtoDao      = new produtoDAO();
            $return          = $produtoDao->cadastrar($produto);
        } else {
            $return['message'] = 'Nenhuma informação recebida para registro de um novo produto.';
        }
        echo json_encode($return, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        break;
    // Removação de registros
    case "DELETE":
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $produtoDao = new produtoDAO();
            $return         = $produtoDao->deletar($id);

        } else {
            $return['message'] = "Você deve informar o ID do produto para remoção.";
        }
        echo json_encode($return, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        break;
    default:
        $return['message'] = "Método ".$_SERVER["REQUEST_METHOD"]." não autorizado.";
        echo json_encode($return);
        break;
}
