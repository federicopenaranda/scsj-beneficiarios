Ext.define('sisscsj.model.opciones.Turno', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_turno',
    fields: [
        {
            name: 'id_turno',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_turno',
            type: 'string',
            useNull: true
        }
    ]
});
