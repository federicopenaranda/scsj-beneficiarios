Ext.define('sisscsj.store.evaluaciones.Pedagogia', {
    extend: 'sisscsj.store.Base',
    alias: 'store.evaluaciones.pedagogia',
    requires: [
        'sisscsj.model.evaluaciones.Pedagogia'
    ],
    restPath: 'EvalPedagogico',
    storeId: 'Pedagogia',
    model: 'sisscsj.model.evaluaciones.Pedagogia'
});