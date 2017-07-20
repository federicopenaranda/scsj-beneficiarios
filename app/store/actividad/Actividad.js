Ext.define('sisscsj.store.actividad.Actividad', {
    extend: 'sisscsj.store.Base',
    alias: 'store.actividad.actividad',
    requires: [
        'sisscsj.model.actividad.Actividad'
    ],
    restPath: 'Actividad',
    storeId: 'Actividad',
    model: 'sisscsj.model.actividad.Actividad'
});