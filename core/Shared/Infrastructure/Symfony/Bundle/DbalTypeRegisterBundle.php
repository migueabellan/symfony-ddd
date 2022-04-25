<?php

namespace Core\Shared\Infrastructure\Symfony\Bundle;

use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class DbalTypeRegisterBundle extends Bundle
{
    // ToDo: replace -> /var/www/web

    private const BASE_PATH = '/var/www/web/core';
    private const BASE_PATH_MAPPINGS = '/var/www/web/core/%s/Infrastructure/Persistence/Doctrine/Mapping';

    public function boot(): void
    {
        $modules = array_diff((array)scandir(self::BASE_PATH), ['..', '.']);

        foreach ($modules as $module) {
            $types = array_filter(
                array_diff((array)scandir(sprintf(self::BASE_PATH_MAPPINGS, $module)), ['..', '.']),
                fn ($el) => str_ends_with((string)$el, 'Type.php')
            );

            foreach ($types as $type) {
                $namespace = str_replace(
                    ['/var/www/web/core', '/', '.php'],
                    ['Core', '\\', ''],
                    sprintf(self::BASE_PATH_MAPPINGS . '/%s', $module, $type)
                );

                Type::addType($namespace::customTypeName(), $namespace);
            }
        }
    }
}
