Ext.define('sisscsj.model.opciones.Provincia', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_provincia',
    fields: [
        {
            name: 'id_provincia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_departamento',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_provincia',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_provincia',
            type: 'string',
            useNull: true
        }
    ]
});
