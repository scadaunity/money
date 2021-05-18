<?php

namespace ScadaUnity\Money\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectives extends Model
{
  use HasFactory;

  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'money_accounts';

    /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = ['name', 'user', 'opening_balance'];


}
