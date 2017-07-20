Ext.define('sisscsj.model.actividad.ActividadBeneficiario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario',
    fields: [
        // id field
        {
            name: 'id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'codigo_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'primer_nombre_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'segundo_nombre_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'apellido_paterno_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'apellido_materno_beneficiario',
            type: 'string',
            useNull: true
        }
    ]
});