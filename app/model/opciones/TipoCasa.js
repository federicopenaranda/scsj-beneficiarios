Ext.define('sisscsj.model.opciones.TipoCasa', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_casa',
    fields: [
        {
            name: 'id_tipo_casa',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_casa',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_casa',
            type: 'string',
            useNull: true
        }
    ]
});
