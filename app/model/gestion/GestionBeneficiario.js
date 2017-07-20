Ext.define('sisscsj.model.gestion.GestionBeneficiario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_gestion_beneficiario',
    fields: [
        {
            name: 'id_gestion_beneficiario',
            type: 'int',
            useNull: true
        },
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
        {
            name: 'estado_gestion_beneficiario',
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
