Ext.define('sisscsj.model.opciones.TipoDonante', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_donante',
    fields: [
        {
            name: 'id_tipo_donante',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_donante',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_donante',
            type: 'string',
            useNull: true
        }
    ]
});
