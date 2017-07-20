Ext.define('sisscsj.model.opciones.EntidadSalud', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_entidad_salud',
    fields: [
        {
            name: 'id_entidad_salud',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_entidad_salud',
            type: 'string',
            useNull: true
        },
        {
            name: 'observaciones_entidad_salud',
            type: 'string',
            useNull: true
        }
    ]
});
