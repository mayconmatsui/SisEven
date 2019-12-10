<?php
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Atividade;
use Rakit\Validation\Validator;

class AtividadeController extends BaseController{
  public function index(Request $request,Response $response,$args){
    $idEvento = (int)$args['id'];
    $atividades = Atividade::where('evento_id',$idEvento)->orderBy('id','desc')->get();
    echo $this->view->render('admin/atividade-listar.html',['atividades'=>$atividades, 'evento_id'=>$idEvento]);
    return $response;
  }
  public function novo(Request $request,Response $response,$args){
    $idEvento = (int)$args['id'];
    echo $this->view->render('admin/atividade-novo.html', ['evento_id'=>$idEvento]);
    return $response;
  }
  public function salvar(Request $request,Response $response){
    $dados = $request->getparsedBody();
    $validation = new Validator();
    $validados = $validation->make($dados, [
      'titulo'              => 'required|min:5',
      'descricao'           => 'required',
      'capaEvento'          => 'required|uploaded_file:0,1M,png,jpeg',
      'dataInicio'          => 'required|date',
      'dataFinal'           => 'required|date',
      'inscricaoInicio'     => 'required|date',
      'inscricaoFinal'      => 'required|date'
    ]);

    $validados->validate();
    if($validados->fails()){
      $erros = $validados->errors();
      $erros = $erros->firstOfAll();

    }else{

    }




    if(isset($dados['id'])){
      $atividade = Atividade::find($dados['id']);
      $atividade->update($dados);
    }else{
      Atividade::create($dados);
    }
    return $response->withHeader('Location', URL_BASE.'admin/atividade/listar/'.$dados['evento_id'])
    ->withStatus(302);
  }
  public function editar(Request $request,Response $response,$args){
    $id = (int) $args['id'];
    $atividade = Atividade::find($id);
    echo $this->view->render('admin/atividade-editar.html',['atividade'=>$atividade]);
    return $response;
  }
  public function delete(Request $request,Response $response,$args){
    $id = (int) $args['id'];
    $atividade = Atividade::find($id);
    $atividade->delete();
    return $response->withHeader('Location', URL_BASE.'admin/atividade/listar/'.$atividade['evento_id'])
    ->withStatus(302);
  }
}
