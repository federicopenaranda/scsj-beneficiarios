Ext.define('sisscsj.model.opciones.Diagnostico', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_diagnostico',
    fields: [
        {
            name: 'id_diagnostico',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_diagnostico',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_diagnostico',
            type: 'string',
            useNull: true
        }
    ]
});
