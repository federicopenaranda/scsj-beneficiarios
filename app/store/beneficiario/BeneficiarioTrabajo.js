Ext.define('sisscsj.store.beneficiario.BeneficiarioTrabajo', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiariotrabajo',
    requires: [
        'sisscsj.model.beneficiario.BeneficiarioTrabajo'
    ],
    restPath: 'BeneficiarioTrabajo',
    storeId: 'BeneficiarioTrabajo',
    model: 'sisscsj.model.beneficiario.BeneficiarioTrabajo'
});