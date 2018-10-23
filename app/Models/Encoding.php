<?php

namespace Compressor\Models;

use Illuminate\Database\Eloquent\Model;
use Compressor\Models\EncodingDetail;

class Encoding extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid'];

    public function encode($url)
    {
        $r = new \ReflectionClass(config('services.encoder.default'));
        $encoder = $r->newInstanceArgs();

        $video = $encoder->transcode($url);

        if ('success' == $video['status']) {
            self::create([
                'uuid' => $video['id']
            ])->encodingDetail()->create([
                'source_url'   => $url,
                'duration'     => $video['duration'],
                'encoding_qty' => $video['encodings_count'],
            ]);
        }

        dd($video);
    }

    /**
     * Get the encoding detail for the encoding.
     */
    public function encodingDetail()
    {
        return $this->hasOne('Compressor\Models\EncodingDetail');
    }
}
