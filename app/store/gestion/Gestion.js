Ext.define('sisscsj.store.gestion.Gestion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.gestion.gestion',
    requires: [
        'sisscsj.model.gestion.Gestion'
    ],
    restPath: 'Gestion',
    storeId: 'Gestion',
    model: 'sisscsj.model.gestion.Gestion'
});

