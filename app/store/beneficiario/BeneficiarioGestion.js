Ext.define('sisscsj.store.beneficiario.BeneficiarioGestion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.beneficiario.beneficiariogestion',
    requires: [
        'sisscsj.model.beneficiario.BeneficiarioGestion'
    ],
    restPath: 'GestionBeneficiario',
    storeId: 'BeneficiarioGestion',
    model: 'sisscsj.model.beneficiario.BeneficiarioGestion'
});