Ext.define('sisscsj.model.opciones.EstadoAsistencia', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_estado_asistencia',
    fields: [
        {
            name: 'id_estado_asistencia',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_estado_asistencia',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_estado_asistencia',
            type: 'string',
            useNull: true
        }
    ]
});
