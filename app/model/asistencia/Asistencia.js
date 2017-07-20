Ext.define('sisscsj.model.asistencia.Asistencia', {
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
            name: 'fecha_asistencia',
            type: 'date',
            dateWriteFormat: 'Y-m-d',
            dateFormat: 'Y-m-d'
        },
        {
            name: 'observaciones_asistencia',
            type: 'string',
            useNull: true
        },
        {
            name: 'beneficiario_asistencia',
            type: 'auto'
        },
        {
            name: 'fecha_creacion_asistencia',
            type: 'auto'
        }
    ]
});