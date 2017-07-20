Ext.define('sisscsj.store.beneficiario.BeneficiarioEstadoCivil', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiarioestadocivil',
    requires: [
        'sisscsj.model.beneficiario.BeneficiarioEstadoCivil'
    ],
    restPath: 'BeneficiarioEstadoCivil',
    storeId: 'BeneficiarioEstadoCivil',
    model: 'sisscsj.model.beneficiario.BeneficiarioEstadoCivil'
});