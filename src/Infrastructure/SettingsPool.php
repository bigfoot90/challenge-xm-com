<?php

namespace Infrastructure;

use Domain\Models\Entity\Setting;
use Infrastructure\Exceptions\SettingNotFoundException;
use Infrastructure\Exceptions\SettingWithoutValueException;
use Infrastructure\Persistence\Mysql\SettingMysqlRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

final class SettingsPool implements \ArrayAccess, ServiceSubscriberInterface
{
    const MAINTENANCE = 'maintenance';

    const DEFAULT_VALUES = [
        self::MAINTENANCE => true,
    ];

    private SettingMysqlRepository $repository;
    private CacheInterface $cache;

    public function __construct(SettingMysqlRepository $repository, CacheInterface $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    private static function getCacheKey(string $name): string
    {
        return 'setting.' . $name;
    }

    public static function getAllNames(): array
    {
        $refl = new \ReflectionClass(static::class);

        return array_filter($refl->getConstants(), 'is_string');
    }

    public function exists($name): bool
    {
        return Setting::isNameValid($name);
    }

    public function get($name)
    {
        if (!$this->exists($name)) {
            throw new SettingNotFoundException($name);
        }

        $cacheKey = self::getCacheKey($name);

        // The callable will only be executed on a cache miss.
        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($name, $cacheKey) {
            //$item->expiresAfter(3600);

            try {
                $item->tag(['settings', $cacheKey]);
            } catch (\Symfony\Component\Cache\Exception\LogicException $e) {
                // The configured cache pool is not taggable!
            }

            if ($setting = $this->repository->get($name)) {
                return $setting->getValue();
            }

            if (array_key_exists($name, static::DEFAULT_VALUES)) {
                return static::DEFAULT_VALUES[$name];
            }

            throw new SettingWithoutValueException($name);
        });
    }

    public function set($name, $value): void
    {
        $this->repository->transactional(function () use ($name, $value) {
            $setting = $this->repository->get($name);

            if ($setting) {
                $setting->setValue($value);
            } else {
                $setting = new Setting($name, $value);
            }

            $this->repository->save($setting);

            $this->cache->delete(self::getCacheKey($name));
        });
    }

    public function delete($name): void
    {
        $this->repository->transactional(function () use ($name) {
            $setting = $this->repository->get($name);

            if ($setting) {
                $this->repository->delete($setting);
            }

            $this->cache->delete(self::getCacheKey($name));
        });
    }

    public function offsetExists($offset): bool
    {
        return $this->exists($offset);
    }

    public function offsetGet($offset)
    {
        $this->get($offset);
    }

    public function offsetSet($offset, $value): void
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        $this->delete($offset);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedServices()
    {
        return [
            // This class should be lazy loaded as it's  required only for a special case as fallback
//            BotApi::class,
        ];
    }
}
