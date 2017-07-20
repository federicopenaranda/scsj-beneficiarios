Ext.define('sisscsj.store.evaluaciones.Enfermeria', {
    extend: 'sisscsj.store.Base',
    alias: 'store.evaluaciones.enfermeria',
    requires: [
        'sisscsj.model.evaluaciones.Enfermeria'
    ],
    restPath: 'EvalEnfermeria',
    storeId: 'Enfermeria',
    model: 'sisscsj.model.evaluaciones.Enfermeria'
});