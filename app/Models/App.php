<?php

namespace App\Models;

use App\Enums\AppType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class App extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'name',
        'description',
        'icon',
        'version',
        'version_type',
        'active',
        'author',
        'is_allowed',
        'config',
        'type',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'active' => 'boolean',
        'is_allowed' => 'boolean',
        'config' => 'array',
        'type' => AppType::class,
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($app) {

            if (empty($app->identifier)){
                if ($app->type === AppType::SYSTEM) {
                    $app->identifier = 'SYS-' . self::formatName($app->name);
                } elseif ($app->type === AppType::THIRD_PARTY) {
                    $app->identifier = 'TPA-' . self::formatName($app->name);
                }
            }


            $app->created_by = auth()->user()->id ?? null;
        });

        static::updating(function ($app) {
            $app->updated_by = auth()->user()->id ?? null;
        });

        static::deleting(function ($app) {
            if ($app->type === AppType::SYSTEM) {
                throw new \Exception("System apps cannot be deleted.");
            }
        });
    }

    protected static function formatName($name)
    {
        return strtoupper(str_replace(' ', '-', $name));
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}
