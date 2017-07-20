Ext.define('sisscsj.model.opciones.CompetenciaMonitoreoActor', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_competencia_monitoreo_actor',
    fields: [
        // id field
        {
            name: 'id_competencia_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'fk_id_tipo_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_competencia_monitoreo_actor',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_competencia_monitoreo_actor',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_competencia_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_monitoreo_actor',
            type: 'auto'
        }
    ]
});