<?php

namespace App\Service\ThisPersonDoesNotExist;

class ThisPersonDoesNotExistDownloader
{
    /**
     * @throws \Exception
     */
    public function profileAvatarDownloaderByURL(
        string $resource = 'https://www.thispersondoesnotexist.com/',
        string $filepath = '/public/upload/vendor/image/',
        string $extension = '.jpg',
    ): string {
        $filename = $this->generateUniqueNumber() . $extension;
        $fullPath = $filepath . $filename;

        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $fp = fopen($fullPath, 'w+');
        $ch = curl_init($resource);

        curl_setopt($ch, \CURLOPT_FILE, $fp);
        curl_setopt($ch, \CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, \CURLOPT_TIMEOUT, 1000);
        curl_setopt($ch, \CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        return $filename;
    }

    /**
     * @throws \Exception
     */
    private function generateUniqueNumber(): string
    {
        return str_pad(random_int(0, 999999999), 9, "0", STR_PAD_LEFT);
    }
}
