<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_visited',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function recordVisit($page)
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();
        $userId = auth()->id();

        // Check if a visit from this IP to this page exists within the last 24 hours
        $existingVisit = self::where('ip_address', $ip)
            ->where('page_visited', $page)
            ->where('created_at', '>=', now()->subDay())
            ->first();

        if (!$existingVisit) {
            return self::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'page_visited' => $page,
                'user_id' => $userId,
            ]);
        }

        return $existingVisit;
    }
}
