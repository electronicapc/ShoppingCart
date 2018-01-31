<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
   protected $fillable = [
        'name','precpu','costo','categoria','ReferenciaOEM','Descripcion','DescripcionS','foto','fechaRetiro','ivap','iva','activo','destacado','cantidadex',
    ];
}
