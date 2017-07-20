Ext.define('sisscsj.model.opciones.TipoCocina', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_cocina',
    fields: [
        {
            name: 'id_tipo_cocina',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_cocina',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_cocina',
            type: 'string',
            useNull: true
        }
    ]
});
