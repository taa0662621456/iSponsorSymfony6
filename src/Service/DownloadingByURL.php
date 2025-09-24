<?php

namespace App\Service;

class DownloadingByURL
{
    public function downloadByURL(string $resource = 'https://www.thispersondoesnotexist.com/image?10823185',
                                  string $filepath = '/upload/vendor/image/', $filename = ''): void
    {
        $fp = fopen($filepath, 'w+');
        $ch = curl_init($resource);

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }

}