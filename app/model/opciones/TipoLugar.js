Ext.define('sisscsj.model.opciones.TipoLugar', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_lugar',
    fields: [
        {
            name: 'id_tipo_lugar',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_lugar',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_lugar',
            type: 'string',
            useNull: true
        }
    ]
});
