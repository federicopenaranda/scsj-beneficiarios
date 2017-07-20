Ext.define('sisscsj.model.opciones.Sector', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_sector',
    fields: [
        {
            name: 'id_sector',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_zona',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_sector',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_sector',
            type: 'string',
            useNull: true
        }
    ]
});
