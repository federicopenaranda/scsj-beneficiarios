Ext.define('sisscsj.model.opciones.TipoMonitoreoActor', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_monitoreo_actor',
    fields: [
        {
            name: 'id_tipo_monitoreo_actor',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_monitoreo_actor',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_monitoreo_actor',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_tipo_monitoreo_actor',
            type: 'int',
            useNull: true
        }
    ]
});
