Ext.define('sisscsj.model.opciones.TipoConsulta', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_consulta',
    fields: [
        {
            name: 'id_tipo_consulta',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_consulta',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_consulta',
            type: 'string',
            useNull: true
        }
    ]
});
