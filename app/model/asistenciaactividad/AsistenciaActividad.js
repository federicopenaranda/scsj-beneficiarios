Ext.define('sisscsj.model.asistenciaactividad.AsistenciaActividad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_asistencia',
    fields: [
        // id field
        {
            name: 'id_asistencia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_actividad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_asistencia',
            type: 'date',
            useNull: true
        },
        {
            name: 'observaciones_asistencia',
            type: 'string',
            useNull: true
        }
    ]
});