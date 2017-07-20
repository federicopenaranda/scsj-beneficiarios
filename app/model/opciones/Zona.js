Ext.define('sisscsj.model.opciones.Zona', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_zona',
    fields: [
        {
            name: 'id_zona',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_localidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_zona',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_zona',
            type: 'string',
            useNull: true
        }
    ]
});
