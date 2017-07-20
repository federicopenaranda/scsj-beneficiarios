Ext.define('sisscsj.model.asistenciaactividad.AsistenciaBeneficiario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_asistencia',
    fields: [
        // id field
        {
            name: 'id_beneficiario_asistencia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_asistencia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_estado_asistencia',
            type: 'int',
            useNull: true
        },
        {
            name: 'codigo_beneficiario',
            type: 'auto'
        },
        {
            name: 'primer_nombre_beneficiario',
            type: 'auto'
        },
        {
            name: 'segundo_nombre_beneficiario',
            type: 'auto'
        },
        {
            name: 'apellido_paterno_beneficiario',
            type: 'auto'
        },
        {
            name: 'apellido_materno_beneficiario',
            type: 'auto'
        }
    ]
});