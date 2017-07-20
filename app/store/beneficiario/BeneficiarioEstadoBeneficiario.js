Ext.define('sisscsj.store.beneficiario.BeneficiarioEstadoBeneficiario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiarioestadobeneficiario',
    requires: [
        'sisscsj.model.beneficiario.BeneficiarioEstadoBeneficiario'
    ],
    restPath: 'BeneficiarioEstadoBeneficiario',
    storeId: 'BeneficiarioEstadoBeneficiario',
    model: 'sisscsj.model.beneficiario.BeneficiarioEstadoBeneficiario'
});