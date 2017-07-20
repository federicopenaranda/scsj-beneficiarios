Ext.define('sisscsj.model.actividad.Actividad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_actividad',
    fields: [
        // id field
        {
            name: 'id_actividad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_gestion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_lugar_actividad',
            type: 'int',
            useNull: true
        },
        {
            name: 'titulo_actividad',
            type: 'string',
            useNull: true
        },
        {
            name: 'fecha_inicio_actividad',
            type: 'date',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'fecha_fin_actividad',
            type: 'date',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'descripcion_actividad',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        },
        {
            name: 'nombre_gestion',
            type: 'auto'
        },
        {
            name: 'nombre_lugar_actividad',
            type: 'auto'
        },
        {
            name: 'actividad_area_actividad',
            type: 'auto'
        },
        {
            name: 'beneficiario_asistencia',
            type: 'auto'
        },
        {
            name: 'personal_asistencia',
            type: 'auto'
        },
        {
            name: 'incluir_entorno_familiar',
            type: 'auto'
        },
        {
            name: 'actividad_tipo_actividad',
            type: 'auto'
        }
    ]
});