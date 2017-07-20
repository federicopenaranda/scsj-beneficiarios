Ext.define('sisscsj.model.opciones.Donante', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_donante',
    fields: [
        {
            name: 'id_donante',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_donante',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_donante',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_donante',
            type: 'string',
            useNull: true
        }
    ]
});
