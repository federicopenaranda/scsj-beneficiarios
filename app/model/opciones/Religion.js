Ext.define('sisscsj.model.opciones.Religion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_religion',
    fields: [
        {
            name: 'id_religion',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_religion',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_religion',
            type: 'string',
            useNull: true
        }
    ]
});
