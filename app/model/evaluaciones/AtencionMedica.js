Ext.define('sisscsj.model.evaluaciones.AtencionMedica', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_atencion_medica',
    fields: [
        // id field
        {
            name: 'id_atencion_medica',
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
            name: 'fk_id_diagnostico',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        // Campos simples
        {
            name: 'fecha_atencion_medica',
            type: 'date',
            useNull: true
        },
        {
            name: 'observaciones_atencion_medica',
            type: 'string',
            useNull: true
        },
        {
            name: 'atencion_medica_enfermedad_comun',
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
            name: 'codigo_beneficiario',
            type: 'auto'
        },
        {
            name: 'nombre_diagnostico',
            type: 'auto'
        }
    ]
});