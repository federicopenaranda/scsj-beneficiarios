Ext.define('sisscsj.model.opciones.AmbitoMonitoreoPc', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_ambito_monitoreo_pc',
    fields: [
        // id field
        {
            name: 'id_ambito_monitoreo_pc',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'fk_id_caracteristica_monitoreo_pc',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_ambito_monitoreo_pc',
            type: 'string',
            useNull: true
        },
        {
            name: 'indicador_ambito_monitoreo_pc',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_ambito_monitoreo_pc',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_caracteristica_monitoreo_pc',
            type: 'auto'
        }
    ]
});