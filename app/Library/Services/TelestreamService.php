<?php
namespace Compressor\Library\Services;

use Compressor\Library\Services\Contracts\TranscoderServiceInterface;
use TelestreamCloudFlip\Configuration;
use TelestreamCloudFlip\Api\FlipApi;
use TelestreamCloudFlip\Model\CreateVideoBody;
use GuzzleHttp\Client;

/**
 * @author Michael Quinn <michael@cherrysoft.com>
 * @copyright 2018
 */
class TelestreamService implements TranscoderServiceInterface
{
    protected $api;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey(
            'X-Api-Key', config('services.telestream.api_key')
        );

        $this->api = new FlipApi(new Client(), $config);
    }

    public function transcode($url)
    {
        $createVideoBody = new CreateVideoBody();
        $createVideoBody->setSourceUrl($url);

        return $this->api->createVideo(
            config('services.telestream.factory_id'), $createVideoBody
        );
    }
}
