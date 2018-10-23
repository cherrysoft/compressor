<?php
namespace Compressor\Library\Services;

use Compressor\Library\Services\Contracts\TranscoderServiceInterface;
use GuzzleHttp\Client;

/**
 * @author Michael Quinn <michael@cherrysoft.com>
 * @copyright 2018
 */
class CoconutService implements TranscoderServiceInterface
{
    protected $config;

    public function __construct()
    {
        $s3 = 's3://accesskey:secretkey@mybucket';

        $this->config = [
            'api_key' => config('services.coconut.api_key'),
            'conf'    => 'coconut.conf',
            'source'  => null,
            'webhook' => 'http://mysite.com/webhook/coconut?videoId=' . $vid,
            'outputs' => [
              'mp4'      => $s3 . '/videos/video_' . $vid . '.mp4',
              'webm'     => $s3 . '/videos/video_' . $vid . '.webm',
              'jpg:300x' => $s3 . '/previews/thumbs_#num#.jpg, number=3'
            ]
        ];
    }

    public function transcode($url)
    {
        $this->config['source'] = $url;

        return Coconut_Job::create($this->config);
    }
}
