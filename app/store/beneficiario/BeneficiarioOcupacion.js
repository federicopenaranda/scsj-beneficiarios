Ext.define('sisscsj.store.beneficiario.BeneficiarioOcupacion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiarioocupacion',
    requires: [
        'sisscsj.model.beneficiario.BeneficiarioOcupacion'
    ],
    restPath: 'BeneficiarioOcupacion',
    storeId: 'BeneficiarioOcupacion',
    model: 'sisscsj.model.beneficiario.BeneficiarioOcupacion'
});