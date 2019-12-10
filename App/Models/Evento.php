<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Evento extends Model{
  protected $table = 'evento';
  public $timestamps = false;
  protected $primaryKey = 'id';
  protected $fillable = [
    'titulo',
    'dataInicio',
    'dataFinal',
    'descricao',
    'inscricaoInicio',
    'inscricaoFinal'
  ];
}
