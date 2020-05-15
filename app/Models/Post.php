<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paragraphs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Paragraph::class);
    }
}
