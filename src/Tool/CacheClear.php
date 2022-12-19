<?php


namespace App\Tool;


use Exception;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class CacheClear
{
    /** @var ContainerInterface */
    protected ContainerInterface $container;

    /** @param ContainerInterface $container */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function cacheClear(): bool
    {
        /** @var FilesystemAdapter $cache */
        $cache = $this->container->get('app.filecache');
        return $cache->clear();
    }

    /**
     * Delete system cache files
     * @return bool
     */
    public function cacheFilesDelete(): bool
    {
        /** @var KernelInterface $kernel */
        $kernel = $this->container->get('kernel');
        $cacheDirPath = $kernel->getCacheDir();
        $warmupDir = $cacheDirPath . '_';
        if (!is_dir($cacheDirPath)) {
            return true;
        }

        if (is_dir($warmupDir)) {
            self::delDir($warmupDir);
        }

        try {
            rename($cacheDirPath, $warmupDir);
            $result = true;
        } catch (Exception $e) {
            $result = false;
        }

        if ($result) {
            $kernel->reboot($cacheDirPath);
        }

        return $result;
    }


    // TODO: избавиться от дополнительной рекурсивной функции
    /**
     * Recursively delete directory
     * @param $dir
     * @return bool
     */
    public static function delDir($dir): bool
    {
        $files = array_diff(scandir($dir), ['.','..']);
        foreach ($files as $file) {
            is_dir("$dir/$file")
                ? self::delDir("$dir/$file")
                : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

}
