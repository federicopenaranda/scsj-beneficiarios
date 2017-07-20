Ext.define('sisscsj.store.evaluaciones.Nutricion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.evaluaciones.nutricion',
    requires: [
        'sisscsj.model.evaluaciones.Nutricion'
    ],
    restPath: 'EvalNutricion',
    storeId: 'Nutricion',
    model: 'sisscsj.model.evaluaciones.Nutricion'
});