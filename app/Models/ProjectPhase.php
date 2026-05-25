<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ProjectPhase extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'project_id', 'title', 'description',
        'icon', 'status', 'position',
    ];

    protected $casts = [
        'position' => 'integer',
    ];

    public const STATUSES = [
        'completed'   => ['ar' => 'مكتمل',   'en' => 'Completed'],
        'in_progress' => ['ar' => 'جارٍ التنفيذ', 'en' => 'In Progress'],
        'planned'     => ['ar' => 'مخطط',    'en' => 'Planned'],
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getStatusLabel(): string
    {
        $locale = app()->getLocale();
        return self::STATUSES[$this->status][$locale] ?? $this->status;
    }

    public function getStatusColor(): string
    {
        return match ($this->status) {
            'completed'   => '#1A1611', // black / ink
            'in_progress' => '#C8102E', // mi-red
            'planned'     => '#7A6E63', // gray
            default       => '#7A6E63',
        };
    }
}
