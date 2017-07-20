Ext.define('sisscsj.model.beneficiario.BeneficiarioTipoIdentificacion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_tipo_identificacion',
    fields: [
        {
            name: 'id_beneficiario_tipo_identificacion',
            type: 'int',
            useNull: true        
        },
        {
            name: 'fk_id_tipo_identificacion',
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
            name: 'numero_tipo_identificacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'primario_tipo_identificacion',
            type: 'int',
            useNull: true
        }
    ]
});