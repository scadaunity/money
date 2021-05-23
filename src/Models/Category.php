<?php

namespace ScadaUnity\Money\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'money_categories';

    /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = ['user', 'name', 'state', 'type', 'color', 'icon'];

    /**
     * Get the subcategories for the categories.
    */
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('transactions');
    }

    /**
     * Get the transaction for the categories.
    */
    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'category');
    }

}
