Ext.define('sisscsj.model.monitoreopc.MonitoreoPc', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_monitoreo_punto_comunitario',
    fields: [
        // id field
        {
            name: 'id_monitoreo_punto_comunitario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario_responsable',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_lugar_actividad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_monitoreo_punto_comunitario',
            type: 'date',
            dateWriteFormat: 'Y-m-d',
            dateFormat: 'Y-m-d'
        },
        {
            name: 'analisis_monitoreo_punto_comunitario',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_lugar_actividad',
            type: 'auto'
        },
        {
            name: 'resultado_monitoreo_pc',
            type: 'auto'
        }
    ]
});