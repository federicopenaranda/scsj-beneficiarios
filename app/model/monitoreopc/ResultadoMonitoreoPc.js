Ext.define('sisscsj.model.monitoreopc.ResultadoMonitoreoPc', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_resultado_monitoreo_pc',
    fields: [
        // id field
        {
            name: 'id_resultado_monitoreo_pc',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_monitoreo_punto_comunitario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_ambito_monitoreo_pc',
            type: 'int',
            useNull: true
        },
        {
            name: 'resultado_monitoreo_pc',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_ambito_monitoreo_pc',
            type: 'auto'
        },
        {
            name: 'indicador_ambito_monitoreo_pc',
            type: 'auto'
        },
        {
            name: 'nombre_caracteristica_monitoreo_pc',
            type: 'auto'
        }
    ]
});