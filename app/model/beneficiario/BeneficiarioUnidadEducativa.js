Ext.define('sisscsj.model.beneficiario.BeneficiarioUnidadEducativa', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_unidad_educativa',
    fields: [
        // id field
        {
            name: 'id_beneficiario_unidad_educativa',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_unidad_educativa',
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
            name: 'estado_beneficiario_unidad_educativa',
            type: 'int',
            useNull: true
        },
        // Campos decorativos
        {
            name: 'nombre_unidad_educativa',
            type: 'auto'
        }
    ]
});