Ext.define('sisscsj.model.opciones.ServicioBasico', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_servicio_basico',
    fields: [
        {
            name: 'id_servicio_basico',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_servicio_basico',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_servicio_basico',
            type: 'string',
            useNull: true
        }
    ]
});
