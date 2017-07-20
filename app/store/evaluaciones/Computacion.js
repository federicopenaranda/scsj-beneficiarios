Ext.define('sisscsj.store.evaluaciones.Computacion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.evaluaciones.computacion',
    requires: [
        'sisscsj.model.evaluaciones.Computacion'
    ],
    restPath: 'EvalComputacion',
    storeId: 'Computacion',
    model: 'sisscsj.model.evaluaciones.Computacion'
});