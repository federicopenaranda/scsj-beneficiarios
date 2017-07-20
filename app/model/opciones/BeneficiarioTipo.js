Ext.define('sisscsj.model.opciones.BeneficiarioTipo', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_tipo',
    fields: [
        {
            name: 'id_beneficiario_tipo',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_beneficiario_tipo',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_beneficiario_tipo',
            type: 'string',
            useNull: true
        }
    ]
});
