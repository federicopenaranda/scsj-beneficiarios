Ext.define('sisscsj.store.familia.FamiliaMiembros', {
    extend: 'sisscsj.store.Base',
    alias: 'store.familia.familiamiembros',
    requires: [
        'sisscsj.model.familia.FamiliaMiembros'
    ],
    //restPath: 'familia/familiaMiembros',
    restPath: 'BeneficiarioFamilia',
    storeId: 'FamiliaMiembros',
    model: 'sisscsj.model.familia.FamiliaMiembros'
});