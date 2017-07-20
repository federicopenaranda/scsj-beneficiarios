Ext.define('sisscsj.model.opciones.EstadoBeneficiario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_estado_beneficiario',
    fields: [
        {
            name: 'id_estado_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_estado_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_estado_beneficiario',
            type: 'string',
            useNull: true
        }
    ]
});
