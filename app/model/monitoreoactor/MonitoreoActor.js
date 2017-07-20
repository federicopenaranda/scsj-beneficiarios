Ext.define('sisscsj.model.monitoreoactor.MonitoreoActor', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_monitoreo_actor',
    fields: [
        // id field
        {
            name: 'id_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_monitoreo_actor',
            type: 'date',
            dateWriteFormat: 'Y-m-d',
            dateFormat: 'Y-m-d'
        },
        {
            name: 'analisis_monitoreo_actor',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_tipo_monitoreo_actor',
            type: 'auto'
        },
        {
            name: 'evaluacion_monitoreo_actor',
            type: 'auto'
        }
    ]
});