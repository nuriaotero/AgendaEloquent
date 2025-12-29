<?php
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    protected $table = 'contacts';
    protected $fillable = [
        'name','lastname','address','phone','email','user_id'
    ];
}
