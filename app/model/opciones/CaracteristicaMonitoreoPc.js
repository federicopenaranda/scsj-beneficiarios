Ext.define('sisscsj.model.opciones.CaracteristicaMonitoreoPc', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_caracteristica_monitoreo_pc',
    fields: [
        {
            name: 'id_caracteristica_monitoreo_pc',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_caracteristica_monitoreo_pc',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_caracteristica_monitoreo_pc',
            type: 'string',
            useNull: true
        }
    ]
});
