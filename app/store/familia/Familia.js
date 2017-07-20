Ext.define('sisscsj.store.familia.Familia', {
    extend: 'sisscsj.store.Base',
    alias: 'store.familia.familia',
    requires: [
        'sisscsj.model.familia.Familia'
    ],
    restPath: 'Familia',
    storeId: 'Familia',
    model: 'sisscsj.model.familia.Familia'
});