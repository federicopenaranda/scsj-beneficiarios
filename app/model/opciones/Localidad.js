Ext.define('sisscsj.model.opciones.Localidad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_localidad',
    fields: [
        {
            name: 'id_localidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_provincia',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_localidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_localidad',
            type: 'string',
            useNull: true
        }
    ]
});
