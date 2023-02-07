<?php

namespace App\Models;

use App\Contracts\ArrayableInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model implements ArrayableInterface
{
    use HasFactory;

    protected $hidden = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'value' => 'double'
    ];

    /**
     * @return array
     */
    public function toRestrictedArray(): array
    {
        $toArray = $this->toArray();

        unset($toArray['id']);
        unset($toArray['created_at']);
        unset($toArray['updated_at']);

        return $toArray;
    }
}
