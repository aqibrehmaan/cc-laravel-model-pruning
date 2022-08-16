<?php

namespace App\Models;

use App\Models\DeploymentLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deployment extends Model
{
    use HasFactory;
    use Prunable;

    public function prunable(): Builder
    {
        return static::where('created_at', '<', now()->subWeek());
    }

    public function pruning()
    {
        $this->deploymentLogs()->delete();
    }

    public function deploymentLogs()
    {
        return $this->hasMany(DeploymentLog::class);
    }
}
