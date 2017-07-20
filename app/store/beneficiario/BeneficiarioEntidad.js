Ext.define('sisscsj.store.beneficiario.BeneficiarioEntidad', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiarioentidad',
    requires: [
        'sisscsj.model.beneficiario.BeneficiarioEntidad'
    ],
    restPath: 'BeneficiarioEntidad',
    storeId: 'BeneficiarioEntidad',
    model: 'sisscsj.model.beneficiario.BeneficiarioEntidad'
});