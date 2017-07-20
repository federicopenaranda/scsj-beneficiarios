Ext.define('sisscsj.model.entidad.Entidad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_entidad',
    fields: [
        // id field
        {
            name: 'id_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_entidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'fecha_inicio_actividades_entidad',
            type: 'date',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'fecha_fin_actividades_entidad',
            type: 'date',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'direccion_entidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'observaciones_entidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_tipo_entidad',
            type: 'auto',
            persist: false
        },
        {
            name: 'entidad_estado_entidad',
            type: 'auto',
            persist: false
        }
    ]
});