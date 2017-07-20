Ext.define('sisscsj.store.marcologico.MarcoLogico', {
    extend: 'sisscsj.store.Base',
    alias: 'store.marcologico.marcologico',
    requires: [
        'sisscsj.model.marcologico.MarcoLogico'
    ],
    restPath: 'MarcoLogico',
    storeId: 'MarcoLogico',
    model: 'sisscsj.model.marcologico.MarcoLogico'
});