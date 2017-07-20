Ext.define('sisscsj.store.beneficiario.BeneficiarioHistoriaSocial', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiariohistoriasocial',
    requires: [
        'sisscsj.model.beneficiario.BeneficiarioHistoriaSocial'
    ],
    restPath: 'HistoriaSocial',
    storeId: 'BeneficiarioHistoriaSocial',
    model: 'sisscsj.model.beneficiario.BeneficiarioHistoriaSocial'
});