<?php

namespace App\Services;

use App\Models\AuditLog;

class AuditService
{
    public function create(
        string $event,
        string $entityType,
        int $entityId,
        array $metadata = [],
        ?int $userId = null
    ) {
        return AuditLog::create([
            'user_id' => $userId,
            'event' => $event,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'metadata' => $metadata,
        ]);
    }
}