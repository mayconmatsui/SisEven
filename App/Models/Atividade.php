<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Atividade extends Model{
    protected $table = 'atividade';
    public $timestamps = false;

    protected $fillable = [
      'titulo', 'descricao', 'dataAtividade', 'horaInicio', 'horaFinal', 'evento_id'
    ];
}
