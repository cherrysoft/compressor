<?php

namespace Compressor\Library\Services\Contracts;

/**
 * @author Michael Quinn <michael@cherrysoft.com>
 * @copyright 2018
 */
interface TranscoderServiceInterface
{
    public function transcode($url);
}
