Ext.define('sisscsj.store.beneficiario.BeneficiarioFamilia', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiariofamilia',
    requires: [
        'sisscsj.model.beneficiario.BeneficiarioFamilia'
    ],
    restPath: 'BeneficiarioFamilia',
    storeId: 'BeneficiarioFamilia',
    model: 'sisscsj.model.beneficiario.BeneficiarioFamilia'
});