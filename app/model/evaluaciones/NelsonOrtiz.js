Ext.define('sisscsj.model.evaluaciones.NelsonOrtiz', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_nelson_ortiz',
    fields: [
        // id field
        {
            name: 'id_nelson_ortiz',
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
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_nelson_ortiz',
            type: 'string',
            useNull: true
        },
        {
            name: 'motricidad_gruesa_nelson_ortiz',
            type: 'string',
            useNull: true
        },
        {
            name: 'audicion_lenguaje_nelson_ortiz',
            type: 'string',
            useNull: true
        },
        {
            name: 'motricidad_fina_nelson_ortiz',
            type: 'string',
            useNull: true
        },
        {
            name: 'personal_social_nelson_ortiz',
            type: 'string',
            useNull: true
        },
        {
            name: 'total_nelson_ortiz',
            type: 'string',
            useNull: true
        },
        {
            name: 'observaciones_nelson_ortiz',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_tipo_consulta',
            type: 'auto'
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        }
    ]
});