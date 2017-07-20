Ext.define('sisscsj.store.evaluaciones.Psicologia', {
    extend: 'sisscsj.store.Base',
    alias: 'store.evaluaciones.psicologia',
    requires: [
        'sisscsj.model.evaluaciones.Psicologia'
    ],
    restPath: 'EvalPsicologico',
    storeId: 'Psicologia',
    model: 'sisscsj.model.evaluaciones.Psicologia'
});