<?php

namespace Guillaumesouillard\UserTrackerGrpd;

use Composer\Script\Event;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class Installer
{
    public static function postInstall(Event $event)
    {
        static::addMiddlewareToKernel();
    }

    public static function postUpdate(Event $event)
    {
        static::addMiddlewareToKernel();
    }

    protected static function addMiddlewareToKernel()
    {
        $kernelPath = static::getKernelPath();
        $middlewareClass = "\\Guillaumesouillard\\UserTrackerGrpd\\SourceMiddleware::class";

        if ($kernelPath && !static::middlewareExists($kernelPath, $middlewareClass)) {
            $content = file_get_contents($kernelPath);
            $content = static::addMiddlewareToWebGroup($content, $middlewareClass);
            file_put_contents($kernelPath, $content);
            echo "Middleware added to the Kernel.php" . PHP_EOL;
        }
    }

    protected static function addMiddlewareToWebGroup($content, $middlewareClass)
    {
        $webMiddlewarePattern = "/(protected\s+\\\$middlewareGroups\s*=\s*\[\s*'web'\s*=>\s*\[)([^\]]*)\]/ms";
        $replacement = "$1$2        $middlewareClass,\n    ]";
        $newContent = preg_replace($webMiddlewarePattern, $replacement, $content);

        return $newContent ?: $content;
    }


    protected static function getKernelPath()
    {
        $finder = new Finder();
        $finder->files()->in(base_path('app/Http'))->name('Kernel.php');

        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                return $file->getRealPath();
            }
        }

        return null;
    }

    protected static function middlewareExists($kernelPath, $middlewareClass)
    {
        $content = file_get_contents($kernelPath);
        return Str::contains($content, $middlewareClass);
    }
}
