Ext.define('sisscsj.store.resultado.Resultado', {
    extend: 'sisscsj.store.Base',
    alias: 'store.resultado.resultado',
    requires: [
        'sisscsj.model.resultado.Resultado'
    ],
    restPath: 'Resultado',
    storeId: 'Resultado',
    model: 'sisscsj.model.resultado.Resultado'
});