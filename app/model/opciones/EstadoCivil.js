Ext.define('sisscsj.model.opciones.EstadoCivil', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_estado_civil',
    fields: [
        {
            name: 'id_estado_civil',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_estado_civil',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_estado_civil',
            type: 'string',
            useNull: true
        }
    ]
});
