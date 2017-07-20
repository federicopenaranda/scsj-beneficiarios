Ext.define('sisscsj.model.evaluaciones.Psicologia', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_psicologico',
    fields: [
        // id field
        {
            name: 'id_psicologico',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_tipo_consulta',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_problematica',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_sub_area_referencia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_psicologico',
            type: 'string',
            useNull: true
        },
        {
            name: 'observaciones_psicologico',
            type: 'string',
            useNull: true
        },
        {
            name: 'diagnostico_psicologico',
            type: 'string',
            useNull: true
        },
        {
            name: 'tratamiento_psicologico',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_area_actividad',
            type: 'auto'
        },
        {
            name: 'nombre_tipo_consulta',
            type: 'auto'
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        },
        {
            name: 'nombre_tipo_problematica',
            type: 'auto'
        },
        {
            name: 'nombre_sub_area',
            type: 'auto'
        }
    ]
});