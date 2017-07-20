Ext.define('sisscsj.store.entidad.Entidad', {
    extend: 'sisscsj.store.Base',
    alias: 'store.entidad.entidad',
    requires: [
        'sisscsj.model.entidad.Entidad'
    ],
    restPath: 'Entidad',
    storeId: 'Entidad',
    model: 'sisscsj.model.entidad.Entidad'
});