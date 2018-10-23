<?php

namespace Compressor\Models;

use Illuminate\Database\Eloquent\Model;

class EncodingDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source_url',
        'encoding_qty',
        'duration'
    ];

    /**
     * Get the encoding for the encoding detail.
     */
    public function encoding()
    {
        return $this->belongsTo('Compressor\Models\Encoding');
    }
}
