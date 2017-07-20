Ext.define('sisscsj.model.familia.FamiliaDireccion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_familia_direccion',
    fields: [
        // id field
        {
            name: 'id_familia_direccion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_sector',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'direccion_familia_direccion',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_familia_direccion',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_sector',
            type: 'auto'
        }
    ]
});