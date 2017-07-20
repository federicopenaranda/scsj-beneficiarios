Ext.define('sisscsj.model.entidad.EntidadEstadoEntidad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_entidad_estado_entidad',
    fields: [
        // id field
        {
            name: 'id_entidad_estado_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_estado_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'estado_entidad_estado_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'observaciones_entidad_estado_entidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_estado_entidad',
            type: 'auto'
        }
    ]
});