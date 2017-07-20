Ext.define('sisscsj.model.opciones.TipoIdentificacion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_identificacion',
    fields: [
        {
            name: 'id_tipo_identificacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_identificacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_identificacion',
            type: 'string',
            useNull: true
        }
    ]
});
