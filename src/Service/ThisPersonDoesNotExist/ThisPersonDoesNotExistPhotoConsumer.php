<?php

namespace App\Service\ThisPersonDoesNotExist;

use Exception;
use const CURLOPT_FILE;
use const CURLOPT_FOLLOWLOCATION;
use const CURLOPT_TIMEOUT;
use const CURLOPT_USERAGENT;
use const CURLOPT_VERBOSE;

class ThisPersonDoesNotExistPhotoConsumer
{
    /**
     * @throws Exception
     */
    public function getExitPersonPhoto(string $name): void
    {
        $requestUrl = 'https://www.thispersondoesnotexist.com/image?'.$name;
        $file = 'public\\upload\\vendor\\image\\'.$name.'.jpg';
        $fp = fopen($file, 'w+');
        $ch = curl_init($requestUrl);

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 6000);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        $raw = curl_exec($ch);
        curl_close($ch);

        fwrite($fp, $raw);
        fclose($fp);
    }
}
