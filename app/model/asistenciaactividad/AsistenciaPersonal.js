Ext.define('sisscsj.model.asistenciaactividad.AsistenciaPersonal', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_personal_asistencia',
    fields: [
        // id field
        {
            name: 'id_personal_asistencia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_asistencia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_estado_asistencia',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        },
        {
            name: 'apellido_usuario',
            type: 'auto'
        },
        {
            name: 'login_usuario',
            type: 'auto'
        }
    ]
});