Ext.define('sisscsj.model.monitoreoactor.EvaluacionMonitoreoActor', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_evaluacion_monitoreo_actor',
    fields: [
        // id field
        {
            name: 'id_evaluacion_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_criterio_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'evaluacion_monitoreo_actor',
            type: 'int',
            useNull: true
        }
    ]
});