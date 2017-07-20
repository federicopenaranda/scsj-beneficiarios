Ext.define('sisscsj.store.opciones.Lugar', {
    extend: 'sisscsj.store.Base',
    alias: 'store.opciones.lugar',
    requires: [
        'sisscsj.model.opciones.Lugar'
    ],
    restPath: 'LugarActividad',
    storeId: 'Lugar',
    model: 'sisscsj.model.opciones.Lugar'
});

