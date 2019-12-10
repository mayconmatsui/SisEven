<?php
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UploadedFileInterface as UploadedFile;
use App\Models\Evento;
use Rakit\Validation\Validator;

class EventoController extends BaseController{
  public function index(Request $request,Response $response){
    $eventos = Evento::orderBy('id','desc')->get();
    echo $this->view->render('admin/evento-listar.html',['eventos'=>$eventos]);
    return $response;
  }
  public function novo(Request $request,Response $response){
    echo $this->view->render('admin/evento-novo.html');
    return $response;
  }
  public function salvar(Request $request,Response $response){
    $dados = $request->getparsedBody();
    $files = $request->getUploadedFiles();
    $capaEvento = $files['capaEvento']->getError() != 0 ? null : $files['capaEvento'];

    $validation = new Validator();
    $validados = $validation->make($_POST + $_FILES, [
      'titulo'              => 'required|min:5',
      'descricao'           => 'required',
      'capaEvento'          => 'required_without:id|uploaded_file:0,1M,png,jpeg',
      'dataInicio'          => 'required|date',
      'dataFinal'           => 'required|date',
      'inscricaoInicio'     => 'required|date',
      'inscricaoFinal'      => 'required|date'
    ]);

    $validados->validate();
    if($validados->fails()){
      $erros = $validados->errors();
      $erros = $erros->firstOfAll();
      if(!isset($dados['id'])){
        echo $this->view->render('admin/evento-novo.html', ['evento' => $dados, 'erros' => $erros]);
        return $response;
      }else{
        echo $this->view->render('admin/evento-editar.html', ['evento' => $dados, 'erros' => $erros]);
        return $response;
      }
    }else{
      $id = $dados['id'] ?? null;
      if ($capaEvento != null) {
        $dados['capaEvento'] = $this->uploadImg('imgs', $capaEvento);
      } else {
        unset($dados['capaEvento']);
      }
      Evento::updateOrCreate(['id' => $id], $dados);
      return $response->withHeader('Location', URL_BASE.'admin/evento')->withStatus(302);
    }
  }
  public function editar(Request $request,Response $response,$args){
    $id = (int) $args['id'];
    $evento = Evento::find($id);
    echo $this->view->render('admin/evento-editar.html',['evento'=>$evento]);
    return $response;
  }
  public function delete(Request $request,Response $response,$args){
    $id = (int) $args['id'];
    Evento::destroy($id);
    return $response->withHeader('Location', URL_BASE.'admin/evento')
    ->withStatus(302);
  }

  private function uploadImg($dir, UploadedFile $img){
    $ext = pathinfo($img->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $ext);

    $img->moveTo($dir . DIRECTORY_SEPARATOR . $filename);

    return $filename;
  }
}
