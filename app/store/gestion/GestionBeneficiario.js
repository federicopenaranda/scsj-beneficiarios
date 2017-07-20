Ext.define('sisscsj.store.gestion.GestionBeneficiario', {
    extend: 'sisscsj.store.Base',
    alias: 'store.gestion.gestionbeneficiario',
    requires: [
        'sisscsj.model.gestion.GestionBeneficiario'
    ],
    restPath: 'GestionBeneficiario',
    storeId: 'GestionBeneficiario',
    model: 'sisscsj.model.gestion.GestionBeneficiario'
});

