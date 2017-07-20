Ext.define('sisscsj.model.opciones.TipoActividad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_actividad',
    fields: [
        {
            name: 'id_tipo_actividad',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_actividad',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_actividad',
            type: 'string',
            useNull: true
        }
    ]
});
