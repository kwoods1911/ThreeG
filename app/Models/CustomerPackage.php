<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ThreeG_Invoices;

class CustomerPackage extends Model
{
    use HasFactory;

    //KW - here the table name can be changed
    // protected $table = 'customer_packages';
    //KW - here the primary key can be changed
    // public $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // public function invoices(){
    //     return $this->belongsTo(ThreeG_Invoices::class,'packageid');
    // }
}
