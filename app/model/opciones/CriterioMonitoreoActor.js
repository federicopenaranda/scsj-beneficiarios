Ext.define('sisscsj.model.opciones.CriterioMonitoreoActor', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_criterio_monitoreo_actor',
    fields: [
        // id field
        {
            name: 'id_ambito_monitoreo_pc',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'fk_id_competencia_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_criterio_monitoreo_actor',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_criterio_monitoreo_actor',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_criterio_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_competencia_monitoreo_actor',
            type: 'auto'
        }
    ]
});