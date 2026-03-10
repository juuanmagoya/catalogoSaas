<?php

namespace App\Domains\Analytics\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsEvent extends Model
{
    // Tabla que representa este modelo
    protected $table = 'analytics_events';

    protected $fillable = [

        // ID del tenant (negocio dueño del catálogo)
        'tenant_id',

        // Tipo de evento que ocurrió
        // menu_view | product_view | category_view
        'event_type',

        // Tipo de entidad asociada al evento
        // product | category | null
        'entity_type',

        // ID del producto o categoría si aplica
        'entity_id',

        // Fuente de la visita
        // qr | link | direct
        'source',

        // Dirección IP del visitante
        'ip',

        // Información del navegador/dispositivo
        'user_agent',
    ];

    protected $casts = [

        // Para asegurar tipos correctos
        'tenant_id' => 'integer',
        'entity_id' => 'integer',
    ];
}