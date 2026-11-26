<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Throwable;

class SiteSetting extends Model
{
    /**
     * Keys editable through the admin panel, mapped to their config fallback.
     *
     * @var array<string, string>
     */
    public const EDITABLE_KEYS = [
        'version' => 'sertao.version',
        'download_windows' => 'sertao.links.download_windows',
        'download_linux' => 'sertao.links.download_linux',
        'itch' => 'sertao.links.itch',
        'github' => 'sertao.links.github',
        'youtube_id' => 'sertao.links.youtube_id',
        'instagram' => 'sertao.links.instagram',
        'youtube' => 'sertao.links.youtube',
        'twitter' => 'sertao.links.twitter',
    ];

    protected const CACHE_KEY = 'site_settings.values';

    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * All editable values: stored database values over config defaults.
     *
     * @return array<string, string>
     */
    public static function values(): array
    {
        $values = [];
        foreach (self::EDITABLE_KEYS as $key => $configKey) {
            $values[$key] = (string) config($configKey, '');
        }

        return array_merge($values, array_intersect_key(self::storedValues(), self::EDITABLE_KEYS));
    }

    public static function value(string $key): string
    {
        return self::values()[$key] ?? '';
    }

    /**
     * @param  array<string, string|null>  $values
     */
    public static function saveMany(array $values): void
    {
        foreach ($values as $key => $value) {
            if (! array_key_exists($key, self::EDITABLE_KEYS)) {
                continue;
            }

            self::updateOrCreate(['key' => $key], ['value' => $value === '' ? null : $value]);
        }

        Cache::forget(self::CACHE_KEY);
    }

    /**
     * @return array<string, string>
     */
    protected static function storedValues(): array
    {
        try {
            return Cache::rememberForever(self::CACHE_KEY, function (): array {
                if (! Schema::hasTable('site_settings')) {
                    return [];
                }

                return self::whereNotNull('value')->pluck('value', 'key')->all();
            });
        } catch (Throwable) {
            return [];
        }
    }
}
