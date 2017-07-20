Ext.define('sisscsj.model.opciones.ParametrosGenerales', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_parametro_general',
    fields: [
        {
            name: 'id_parametro_general',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_parametro',
            type: 'string',
            useNull: true
        },
        {
            name: 'valor_parametro',
            type: 'string',
            useNull: true
        },
        {
            name: 'configuracion_parametro',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_parametro',
            type: 'string',
            useNull: true
        }
    ]
});
