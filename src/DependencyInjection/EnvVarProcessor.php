<?php

namespace Zgolus\DockerSecretsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

class EnvVarProcessor implements EnvVarProcessorInterface
{

    /**
     * Returns the value of the given variable as managed by the current instance.
     *
     * @param string $prefix The namespace of the variable
     * @param string $name The name of the variable within the namespace
     * @param \Closure $getEnv A closure that allows fetching more env vars
     *
     * @return mixed
     *
     * @throws RuntimeException on error
     */
    public function getEnv($prefix, $name, \Closure $getEnv)
    {
        if (!is_scalar($file = $getEnv($name))) {
            throw new RuntimeException(sprintf('Invalid file name: env var "%s" is non-scalar.', $name));
        }
        if (!file_exists($file)) {
            throw new RuntimeException(sprintf('Env "file:%s" not found: %s does not exist.', $name, $file));
        }

        return trim(file_get_contents($file));
    }

    /**
     * @return string[] The PHP-types managed by getEnv(), keyed by prefixes
     */
    public static function getProvidedTypes()
    {
        return ['dockerSecret' => 'string'];
    }
}