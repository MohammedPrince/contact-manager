<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;


    protected $table = "contacts";
    protected $casts = [
        'phone' => 'string',
    ];
    public static function create(array $data)
    {
        $c = new Contact;
        $c->name = $data['name'];
        $c->phone = $data['phone'];

        $c->save();

        return $c->id;
    }
}
