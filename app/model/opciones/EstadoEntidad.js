Ext.define('sisscsj.model.opciones.EstadoEntidad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_estado_entidad',
    fields: [
        {
            name: 'id_estado_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_estado_entidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_estado_entidad',
            type: 'string',
            useNull: true
        }
    ]
});
