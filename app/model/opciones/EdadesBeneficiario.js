Ext.define('sisscsj.model.opciones.EdadesBeneficiario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_edades_beneficiario',
    fields: [
        {
            name: 'id_edades_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_edades_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_edades_beneficiario',
            type: 'string',
            useNull: true
        }
    ]
});
