<?php

namespace ScadaUnity\Money\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
  use HasFactory;

  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'money_transactions';

    /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = ['user', 'team', 'name', 'state', 'type', 'color', 'icon'];


}
