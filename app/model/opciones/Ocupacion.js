Ext.define('sisscsj.model.opciones.Ocupacion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_ocupacion',
    fields: [
        {
            name: 'id_ocupacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_ocupacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_ocupacion',
            type: 'string',
            useNull: true
        }
    ]
});
