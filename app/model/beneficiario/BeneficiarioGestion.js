Ext.define('sisscsj.model.beneficiario.BeneficiarioGestion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_gestion_beneficiario',
    fields: [
        // id field
        {
            name: 'id_gestion_beneficiario',
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
            name: 'fk_id_gestion',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'estado_gestion_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_gestion',
            type: 'auto'
        }        
    ]
});