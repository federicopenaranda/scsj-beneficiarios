Ext.define('sisscsj.model.beneficiario.BeneficiarioHistoriaSocial', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_historia_social',
    fields: [
        // id field
        {
            name: 'id_historia_social',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        
        // campos simples
        {
            name: 'historia_social',
            type: 'string',
            useNull: true
        },
        {
            name: 'dinamica_familiar_historia_social',
            type: 'string',
            useNull: true
        },
        {
            name: 'situacion_actual_historia_social',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_historia_social',
            type: 'int',
            useNull: true
        }
    ]
});