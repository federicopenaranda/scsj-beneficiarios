Ext.define('sisscsj.model.opciones.EvalEduNelsonOrtiz', {
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
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'primer_nombre_beneficiario',
            type: 'string',
            useNull: true,
            persist: false
        },
        {
            name: 'apellido_paterno_beneficiario',
            type: 'string',
            useNull: true,
            persist: false
        },
        {
            name: 'codigo_beneficiario',
            type: 'string',
            useNull: true,
            persist: false
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_consulta',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_consulta',
            type: 'string',
            useNull: true,
            persist: false
        },
        // campos simples
        {
            name: 'fecha_nelson_ortiz',
            type: 'date',
            dateWriteFormat: 'Y-m-d'
        },
        {
            name: 'observaciones_nelson_ortiz',
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
        }
    ]
});