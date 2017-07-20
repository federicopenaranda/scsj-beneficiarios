Ext.define('sisscsj.store.familia.FamiliaTipoCasa', {
    extend: 'sisscsj.store.Base',
    alias: 'store.familia.familiatipocasa',
    requires: [
        'sisscsj.model.familia.FamiliaTipoCasa'
    ],
    restPath: 'FamiliaTipoCasa',
    storeId: 'FamiliaTipoCasa',
    model: 'sisscsj.model.familia.FamiliaTipoCasa'
});